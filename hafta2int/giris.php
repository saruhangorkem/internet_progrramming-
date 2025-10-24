<?php
require_once 'baglanti.php'; // Veritabanı bağlantısı ve session_start() burada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kulad = $baglanti->real_escape_string(trim($_POST['kullanici_adi']));
    $sifre = trim($_POST['sifre']);

    // Kullanıcıyı veritabanında ara
    $sql = "SELECT kulad, sifre, rol FROM kullanicilar WHERE kulad = ?";
    
    if ($stmt = $baglanti->prepare($sql)) {
        $stmt->bind_param("s", $param_kulad);
        $param_kulad = $kulad;
        
        if ($stmt->execute()) {
            $stmt->store_result();
            
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($db_kulad, $db_sifre, $db_rol);
                if ($stmt->fetch()) {
                    // **Gerçek uygulamada: if (password_verify($sifre, $db_sifre))**
                    // Ödev için basit şifre kontrolü (UYGULAMAYIN, SADECE ÖRNEK İÇİN)
                    if ($sifre == $db_sifre) { 
                        // Oturum değişkenlerini ata
                        $_SESSION['giris_yapildi'] = TRUE;
                        $_SESSION['kullanici_adi'] = $db_kulad;
                        $_SESSION['rol'] = $db_rol;
                        
                        // Role göre yönlendirme yap
                        switch ($db_rol) {
                            case 'admin':
                                header("location: ../admin/panel.php");
                                break;
                            case 'personel':
                                header("location: ../personel/anasayfa.php");
                                break;
                            case 'uye':
                                header("location: ../uye/anasayfa.php");
                                break;
                            default:
                                // Tanımsız rol
                                header("location: ../login.html?hata=rol");
                        }
                        exit;
                    } else {
                        // Şifre hatalı
                        header("location: ../login.html?hata=sifre");
                    }
                }
            } else {
                // Kullanıcı adı hatalı
                header("location: ../login.html?hata=kulad");
            }
        }
        $stmt->close();
    }
    $baglanti->close();
}
?>