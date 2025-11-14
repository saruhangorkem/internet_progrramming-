<?php
// Oturumu başlat (veya mevcut oturuma devam et)
session_start();

// Tüm oturum değişkenlerini sıfırla (session array'i boşaltılır)
$_SESSION = array();

// Eğer oturum çerezleri kullanılıyorsa, sunucudaki oturum çerezini sil.
// Bu, oturumu sonlandırmanın en güvenli yoludur.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// "Beni hatırla" (remember me) çerezlerini sil
// Çerezleri silmek için sürelerini geçmiş bir tarihe ayarlıyoruz.
if (isset($_COOKIE['library_user'])) {
    setcookie('library_user', '', time() - 3600, '/');
}
if (isset($_COOKIE['library_role'])) {
    setcookie('library_role', '', time() - 3600, '/');
}

// Oturumu tamamen sonlandır (sunucudaki oturum dosyasını siler)
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header('Location: ../login.php');
exit();
?>