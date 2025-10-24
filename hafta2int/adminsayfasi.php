<?php
require_once '../backend/baglanti.php';

// Oturum kontrolü ve Admin rolü kontrolü
if (!isset($_SESSION['giris_yapildi']) || $_SESSION['rol'] !== 'admin') {
    // Giriş yapılmamış veya rolü admin değilse login sayfasına yönlendir
    header("location: ../login.html");
    exit;
}

$kullanici_adi = $_SESSION['kullanici_adi']; // Oturumdan kullanıcı adını al
?>
<html>
<head><title>Admin Paneli - MSB Library</title><link rel="stylesheet" href="../css/genel.css"></head>
<body class="body"><center><div id="container">
  <div id="content">
    <h1>Admin Paneli</h1>
    <p>Hoş Geldiniz, <strong><?php echo htmlspecialchars($kullanici_adi); ?> (Admin)</strong>!</p>
    <p>Bu alanda tüm kütüphane yönetim işlemlerini gerçekleştirebilirsiniz.</p>
    <a href="../logout.php">Çıkış Yap</a>
  </div>
  <div id="footer">© 2025 MSB Library</div>
</div></center></body></html>