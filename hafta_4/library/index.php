<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Library | Ana Sayfa</title>
  <link rel="stylesheet" href="css/genel.css">
  <link rel="shortcut icon" type="image/png" href="favicon.ico">
  <style>
    /* Sadece bu sayfaya özel ufak görsel iyileştirmeler */
    .logo h1 {
        /* Turuncu vurgu için genel.css'deki değişkeni kullan */
        color: var(--secondary-accent); 
    }
  </style>
</head>

<body>
  <header class="navbar">
    <div class="logo">
      <img src="media/logo.png" alt="MSB Library Logo">
      <h1>The Library</h1>
    </div>
    <nav>
      <ul class="nav-links">
        <li><a href="index.php" class="active">Ana Sayfa</a></li>
        <li><a href="html/hakkimizda.html">Hakkımızda</a></li>
        <li><a href="html/misyon-vizyon.html">Misyon & Vizyon</a></li>
        <li><a href="html/iletisim.html">İletişim</a></li>
        <li><a href="login.php" class="btn small" style="box-shadow: none;">Giriş Yap</a></li>
      </ul>
    </nav>
  </header>

  <main class="hero-section">
    <div class="hero-content">
      <h2>The Library'ye Hoş Geldiniz</h2>
      <p>Bilgiye ulaşmanın en modern ve kolay yolu. Binlerce kitap, makale ve dijital kaynağa anında erişim sağlayın.</p>
      <a href="login.php" class="btn">Hemen Giriş Yapın</a>
    </div>
  </main>

  <section class="features">
    <div class="feature-card">
      <h3>🚀 Geniş Kaynak Arşivi</h3>
      <p>Fiziksel ve dijital binlerce kitap, makale ve e-kitapla sürekli büyüyen bir bilgi kaynağına erişin.</p>
    </div>
    <div class="feature-card">
      <h3>💻 7/24 Online Erişim</h3>
      <p>İstediğiniz her yerden, istediğiniz cihazdan kütüphanemize güvenle bağlanın ve kaynakları görüntüleyin.</p>
    </div>
    <div class="feature-card">
      <h3>✨ Modern Arayüz</h3>
      <p>Kullanıcı dostu, mobil uyumlu ve şık bir tasarımla aradığınızı kolayca bulun ve zahmetsizce gezinin.</p>
    </div>
  </section>

  <footer>
    <p>© 2025 The Library | İstanbul Medeniyet Üniversitesi</p>
  </footer>
</body>
</html>