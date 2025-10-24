<?php
session_start(); // Oturumu başlat

// Tüm oturum değişkenlerini kaldır
session_unset();

// Oturumu sonlandır
session_destroy();

// Kullanıcıyı tekrar giriş sayfasına yönlendir
header("location: login.html");
exit;
?>