<?php
// Database configuration
// Lütfen bu bilgileri kendi veritabanı ayarlarınızla güncelleyin.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library_db');

// Create connection
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        // Üretim ortamında veritabanı hatasını doğrudan göstermek yerine,
        // genel bir hata mesajı göstermek daha güvenlidir.
        error_log("Veritabanı bağlantı hatası: " . $conn->connect_error);
        die("Hizmet şu anda kullanılamıyor. Lütfen daha sonra tekrar deneyin.");
    }
    
    $conn->set_charset("utf8mb4");
    return $conn;
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        // Oturum açılmamışsa, login sayfasına yönlendir.
        header('Location: ../login.php');
        exit();
    }
}

// Redirect if not admin
function requireAdmin() {
    if (!isAdmin()) {
        // Yönetici yetkisi yoksa, login sayfasına yönlendir.
        header('Location: ../login.php');
        exit();
    }
}

/**
 * Giriş verilerini temizler ve SQL enjeksiyonunu önlemek için 
 * (parametre bağlaması kullanılmayan durumlar için) MySQLi escape string uygular.
 * @param string $data Temizlenecek veri.
 * @return string Temizlenmiş veri.
 */
function cleanInput($data) {
    if (is_array($data)) {
        return array_map('cleanInput', $data);
    }
    
    $data = trim($data);
    $data = stripslashes($data);
    // XSS önleme: HTML özel karakterlerini dönüştürür
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); 
    
    // SQL Injection'a karşı son katman (yalnızca parametre bağlama kullanılmadığında önemlidir)
    $conn = getConnection();
    $data = $conn->real_escape_string($data);
    $conn->close();

    return $data;
}
?>