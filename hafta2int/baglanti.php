<?php
// Oturumu başlat
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Veritabanı Bilgileri (Kendi ayarlarınıza göre değiştirin)
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Örnek kullanıcı
define('DB_PASSWORD', 'parolaniz'); // Örnek parola
define('DB_NAME', 'msb_library_db'); // Veritabanı adınız

// MySQLi Bağlantısı
$baglanti = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Bağlantıyı kontrol et
if ($baglanti->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $baglanti->connect_error);
}

// Karakter setini ayarla
$baglanti->set_charset("utf8");
?>