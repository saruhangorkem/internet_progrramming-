<?php
include("db.php");

$kullanici_adi = $_POST['kullanici_adi'];
$sifre = md5($_POST['sifre']);
$rol = $_POST['rol'];

$sql = "INSERT INTO kullanicilar (kullanici_adi, sifre, rol) VALUES ('$kullanici_adi', '$sifre', '$rol')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Kayıt başarılı!'); window.location.href='../login.html';</script>";
} else {
    echo "<script>alert('Hata: Kullanıcı adı mevcut.'); window.location.href='../register.html';</script>";
}
?>
