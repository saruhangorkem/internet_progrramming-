<?php
session_start();
include("db.php");

$kullanici_adi = $_POST['kullanici_adi'];
$sifre = md5($_POST['sifre']); // Şifre hashli

$sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='$kullanici_adi' AND sifre='$sifre'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['kullanici_adi'] = $row['kullanici_adi'];
    $_SESSION['rol'] = $row['rol'];

    if ($row['rol'] == 'admin') {
        header("Location: ../admin.html");
    } else {
        header("Location: ../kullanici.html");
    }
    exit;
} else {
    echo "<script>alert('Kullanıcı adı veya şifre yanlış!'); window.location.href='../login.html';</script>";
}
?>
