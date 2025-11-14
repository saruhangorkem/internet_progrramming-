<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Geçersiz istek metodu.']);
    exit();
}

// Kullanıcı girdilerini al
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']) && $_POST['remember'] === '1';

// Validation
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Kullanıcı adı ve şifre gereklidir.']);
    exit();
}

$conn = getConnection();

// **ÖNEMLİ:** Kullanıcı adını cleanInput() ile temizlerken, cleanInput'un içinde 
// yeni bir DB bağlantısı açılıp kapandığı için performansı düşürmemek adına, 
// burada sadece trimleme yapıp MySQLi'nin bind_param'ına güveniyoruz. 
// (db.php'deki cleanInput metodu değiştirildiği için, buradaki kullanımı optimize ediyoruz.)

$clean_username = trim($username);

// 1. Yönetici olarak giriş yapmayı dene
$stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
$stmt->bind_param("s", $clean_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
        // BAŞARILI YÖNETİCİ GİRİŞİ
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['role'] = 'admin';
        
        if ($remember) {
            // Güvenlik: remember cookie'leri daha karmaşık token'lar içermeliydi, 
            // ancak mevcut yapıyı koruyarak sadece rol ve kullanıcı adını kaydediyoruz.
            setcookie('library_user', $admin['username'], time() + (86400 * 30), "/");
            setcookie('library_role', 'admin', time() + (86400 * 30), "/");
        }
        
        $stmt->close();
        $conn->close();
        echo json_encode(['success' => true, 'role' => 'admin', 'redirect' => 'admin.php']);
        exit();
    }
}
$stmt->close();

// 2. Normal kullanıcı olarak giriş yapmayı dene
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $clean_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // BAŞARILI KULLANICI GİRİŞİ
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = 'user';
        
        if ($remember) {
            setcookie('library_user', $user['username'], time() + (86400 * 30), "/");
            setcookie('library_role', 'user', time() + (86400 * 30), "/");
        }
        
        $stmt->close();
        $conn->close();
        echo json_encode(['success' => true, 'role' => 'user', 'redirect' => 'kullanici.php']);
        exit();
    }
}

$stmt->close();
$conn->close();

// Giriş başarısız
echo json_encode(['success' => false, 'message' => 'Kullanıcı adı veya şifre hatalı.']);
?>