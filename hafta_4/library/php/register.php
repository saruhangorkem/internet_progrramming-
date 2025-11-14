<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Geçersiz istek metodu.']);
    exit();
}

// Kullanıcı girdilerini al ve sadece trimle
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';

// 1. Validation
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Kullanıcı adı ve şifre gereklidir.']);
    exit();
}

if ($password !== $password2) {
    echo json_encode(['success' => false, 'message' => 'Şifreler eşleşmiyor.']);
    exit();
}

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Şifre en az 6 karakter olmalıdır.']);
    exit();
}

$conn = getConnection();

// 2. Kullanıcı adının zaten var olup olmadığını kontrol et
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'message' => 'Bu kullanıcı adı zaten kayıtlı.']);
    exit();
}
$stmt->close();

// 3. Şifreyi hash'le ve kullanıcıyı kaydet
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => true, 'message' => '✅ Kayıt başarılı. Artık giriş yapabilirsiniz.']);
} else {
    // Genişletilmiş hata yakalama (örneğin UNIQUE kısıtlama hatası)
    if ($conn->errno == 1062) {
        $message = 'Bu kullanıcı adı zaten kullanılıyor (DB Hata).';
    } else {
        $message = 'Kayıt sırasında bir hata oluştu.';
    }
    
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'message' => $message]);
}
?>