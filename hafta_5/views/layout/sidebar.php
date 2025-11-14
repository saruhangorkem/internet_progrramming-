<?php
// Sidebar durumunu kontrol etmek için JavaScript kullanacağız.
?>
        <button id="sidebar-toggle">
            ☰ Menüyü Daralt
        </button>

        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="public/logo.svg" alt="Logo">
                <h3>Öğrenci<br>Yönetim</h3>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : ''; ?>">
                            <span class="nav-icon">🏠</span>
                            <span>Ana Sayfa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=students" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'students') ? 'active' : ''; ?>">
                            <span class="nav-icon">👥</span>
                            <span>Öğrenci Listesi</span>
                            <?php if (isset($stats['toplam_ogrenci'])): ?>
                                <span class="nav-badge"><?php echo $stats['toplam_ogrenci']; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=students&action=add" class="nav-link <?php echo (isset($_GET['action']) && $_GET['action'] == 'add') ? 'active' : ''; ?>">
                            <span class="nav-icon">➕</span>
                            <span>Öğrenci Ekle</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=grades" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'grades') ? 'active' : ''; ?>">
                            <span class="nav-icon">📝</span>
                            <span>Not Yönetimi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=attendance" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'attendance') ? 'active' : ''; ?>">
                            <span class="nav-icon">📅</span>
                            <span>Devamsızlık</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=departments" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'departments') ? 'active' : ''; ?>">
                            <span class="nav-icon">🏢</span>
                            <span>Bölümler</span>
                            <?php if (isset($stats['toplam_bolum'])): ?>
                                <span class="nav-badge"><?php echo $stats['toplam_bolum']; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=reports" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'reports') ? 'active' : ''; ?>">
                            <span class="nav-icon">📊</span>
                            <span>Raporlar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=settings" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'settings') ? 'active' : ''; ?>">
                            <span class="nav-icon">⚙️</span>
                            <span>Ayarlar</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-stats">
                <h4><?php echo isset($sidebarTitle) ? $sidebarTitle : 'Toplam Öğrenci'; ?></h4>
                <div class="big-number"><?php echo isset($sidebarNumber) ? $sidebarNumber : (isset($stats['toplam_ogrenci']) ? $stats['toplam_ogrenci'] : 0); ?></div>
            </div>
        </aside>
        
        <div class="content-area">

<script>
    // Sidebar Daraltma İşlevi
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
        
        // Buton metnini değiştir
        if (sidebar.classList.contains('collapsed')) {
            this.innerHTML = '▶️ Aç';
            localStorage.setItem('sidebar_state', 'collapsed');
        } else {
            this.innerHTML = '☰ Menüyü Daralt';
            localStorage.setItem('sidebar_state', 'open');
        }
    });

    // Sayfa yüklendiğinde durumu kontrol et
    document.addEventListener('DOMContentLoaded', (event) => {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const state = localStorage.getItem('sidebar_state');
        
        if (state === 'collapsed' && sidebar && toggleBtn) {
            sidebar.classList.add('collapsed');
            toggleBtn.innerHTML = '▶️ Aç';
        }
    });
</script>