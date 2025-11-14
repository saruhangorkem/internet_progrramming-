<?php
require_once 'php/db.php';
requireLogin();

// Make sure user has 'user' role (not admin)
if ($_SESSION['role'] !== 'user') {
    header('Location: admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kullanıcı Paneli | The Library</title>
<link rel="stylesheet" href="css/genel.css">
<style>
/* GENEL.CSS'İ EZEN ÖZELLEŞTİRMELER (Lacivert-Turuncu Tema ve Düzen) */
/* CSS değişkenlerini buradan almıyoruz, genel.css'den alıyoruz. */

body {
    /* Genel CSS'teki gradyan ve fontlar kullanıldı */
    overflow: auto; /* Genel CSS'deki overflow:hidden'ı iptal et */
}

.main-wrapper {
    display: flex;
    flex: 1;
    overflow: hidden;
    min-height: 0;
}

.sidebar {
    width: 300px;
    min-width: 300px;
    /* Kırmızı yerine Mavi/Siyah gradyan */
    background: linear-gradient(180deg, var(--bg-dark), var(--primary-dark));
    display: flex;
    flex-direction: column;
    padding: 24px;
    color: #fff;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.5);
    overflow-y: auto;
}

.logo {
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 20px;
    padding-bottom: 20px;
}

.nav-link {
    /* Genel CSS'deki nav-link stilleri geçerli kalır, burayı sadece düzen için ekledik */
    margin-bottom: 8px;
}

.menu-top {
  flex: 1; /* Menü öğelerinin üstte kalmasını sağlar */
}

.logout-btn {
    margin-top: auto; /* Butonun her zaman en altta kalmasını sağlar */
    background: var(--secondary-accent); /* Turuncu renkli çıkış butonu */
    color: #333;
    padding: 16px;
    border-radius: 12px;
    text-align: center;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    border: none;
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

.logout-btn:hover {
    background: #ffdd88;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(255, 193, 7, 0.5);
    color: #000;
}

main {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    min-width: 0;
    /* Koyu lacivert tonlu arka plan */
    background: linear-gradient(135deg, #1e1e1e 0%, var(--primary-dark) 100%);
}

header {
    /* Başlık çubuğuna lacivert tonlu gradyan */
    background: linear-gradient(135deg, var(--card-bg), #003366);
    padding: 28px 40px;
    border-radius: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    border: 1px solid var(--border-color);
}

header h2 {
    color: var(--text-light); /* Turuncu vurgu kullanmak isterseniz: var(--secondary-accent) */
    font-size: 2.2rem;
    font-weight: 600;
}

.card {
    /* Kartları biraz daha nötr ve yeni temaya uyumlu yap */
    background: linear-gradient(135deg, var(--card-bg), var(--card-bg-alt));
    border: 1px solid var(--border-color);
}

.card h3 {
    border-bottom: 3px solid var(--primary); /* Mavi çizgi */
    padding-bottom: 18px;
    margin-bottom: 28px;
    font-size: 2rem;
    font-weight: 700;
    color: var(--secondary-accent); /* Başlıkları turuncu yap */
}

/* Input stilleri genel.css'den alınır. */

.book {
    background: linear-gradient(135deg, #3a3a3a, #454545);
    padding: 28px 32px;
    border-radius: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.book:hover {
    /* Hover efekti mavi tonlu yap */
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 123, 255, 0.4);
    border-color: var(--primary);
}

/* Empty State & Footer stilleri genel.css'den alınır. */
</style>
</head>
<body>

 <div class="main-wrapper">
 <aside class="sidebar">
    <div class="logo">
        <img src="media/logo.png" alt="The Library Logo" onerror="this.style.display='none'">
        <h1>The Library</h1>
    </div>
    <div class="menu-top">
        <a href="#" class="nav-link active" data-section="books">📘 Kitaplarım</a>
        <a href="#" class="nav-link" data-section="add">🔍 Kütüphanede Kitap Ara</a> 
        <a href="index.php" class="nav-link">🏠 Ana Sayfa</a>
    </div>
    <button class="logout-btn" id="logoutBtn">Çıkış Yap</button>
</aside>

<main>
  <header>
    <h2>Hoşgeldin, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
  </header>

  <section id="books" class="content-section active">
    <div class="card">
      <h3 style="color:var(--secondary-accent);">Kitaplarım</h3>
      <input type="text" id="search" placeholder="🔍 Kitaplarımda ara...">
      <div class="list" id="bookList"></div>
    </div>
  </section>

   <section id="add" class="content-section">
     <div class="card">
       <h3 style="color:var(--secondary-accent);">Kütüphaneden Kitap Ekle</h3>
       <p style="color: #bbb; margin-bottom: 20px;">Merkezi kütüphanede arama yapın ve kitapları listenize ekleyin.</p>
       <input type="text" id="librarySearch" placeholder="🔍 Kütüphanede kitap ara (başlık, yazar, kategori)...">
       <div class="list" id="libraryResults"></div>
     </div>
   </section>

 </main>
 </div>

 <footer>© 2025 The Library | Medeniyet Üniversitesi</footer>

<script>
const $ = (s) => document.querySelector(s);

// Sidebar navigation
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    document.querySelectorAll('.nav-link').forEach(a => a.classList.remove('active'));
    link.classList.add('active');
    document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
    const section = link.dataset.section;
    if (section) {
      document.getElementById(section).classList.add('active');
    }
  });
});

// Logout
$('#logoutBtn').onclick = () => {
  window.location = 'php/logout.php';
};

// Load my books
async function loadMyBooks(filter = '') {
  try {
    const res = await fetch('php/user_api.php?action=get_my_books');
    const data = await res.json();
    if (data.success) {
      renderMyBooks(data.data, filter);
    }
  } catch (err) {
    console.error('Error loading books:', err);
  }
}

function renderMyBooks(books, filter = '') {
  const list = $('#bookList');
  list.innerHTML = '';

  const q = filter.toLowerCase();
  const filtered = filter ? books.filter(b =>
    b.title.toLowerCase().includes(q) || b.author.toLowerCase().includes(q)
  ) : books;

  if (!filtered.length) {
    list.innerHTML = '<div class="empty-state"><div class="empty-state-icon">📖</div><h4>Henüz Kitap Eklemediniz</h4><p>"Kütüphanede Kitap Ara" sekmesinden kütüphaneden kitap ekleyebilirsiniz.</p></div>';
    return;
  }

  filtered.forEach(b => {
    const div = document.createElement('div');
    div.className = 'book';
    div.innerHTML = `
      <div class="book-info">
        <h4>${escapeHtml(b.title)}</h4>
        <div class='meta'>${escapeHtml(b.author)}${b.year ? ' • ' + b.year : ''}${b.category ? ' • ' + b.category : ''}</div>
      </div>
      <button class='btn' onclick="alert('Kitap okuma özelliği demo içindir.')">Oku</button>
    `;
    list.appendChild(div);
  });
}

// Search library
let myBookIds = new Set();

async function loadMyBookIds() {
  try {
    const res = await fetch('php/user_api.php?action=check_my_books');
    const data = await res.json();
    if (data.success) {
      myBookIds = new Set(data.data);
    }
  } catch (err) {
    console.error('Error loading book IDs:', err);
  }
}

async function searchLibrary(query) {
  const results = $('#libraryResults');
  results.innerHTML = '';

  if (!query || query.trim().length < 2) {
    results.innerHTML = '<div class="empty-state"><div class="empty-state-icon">🔍</div><h4>Arama Başlatın</h4><p>Arama yapmak için en az 2 karakter girin...</p></div>';
    return;
  }

  try {
    const res = await fetch(`php/user_api.php?action=search_library&query=${encodeURIComponent(query)}`);
    const data = await res.json();
    
    if (!data.success || !data.data.length) {
      results.innerHTML = '<div class="empty-state"><div class="empty-state-icon">📭</div><h4>Sonuç Bulunamadı</h4><p>Arama kriterlerinize uygun kitap bulunamadı.</p></div>';
      return;
    }

    data.data.forEach(b => {
      const alreadyAdded = myBookIds.has(b.id);
      const div = document.createElement('div');
      div.className = 'book';
      div.innerHTML = `
        <div class="book-info">
          <h4>${escapeHtml(b.title)}</h4>
          <div class='meta'>${escapeHtml(b.author)}${b.year ? ' • ' + b.year : ''}${b.category ? ' • ' + b.category : ''}</div>
        </div>
        ${alreadyAdded
          ? '<span style="color:#4CAF50;font-weight:bold;font-size:1.1rem;">✓ Listenizde</span>'
          : `<button class='btn' data-id='${b.id}' onclick='addToMyBooks(${b.id})'>+ Ekle</button>`
        }
      `;
      results.appendChild(div);
    });
  } catch (err) {
    console.error('Search error:', err);
  }
}

async function addToMyBooks(bookId) {
  try {
    const formData = new FormData();
    formData.append('book_id', bookId);
    
    const res = await fetch('php/user_api.php?action=add_to_my_books', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    
    alert(data.message);
    if (data.success) {
      myBookIds.add(bookId);
      searchLibrary($('#librarySearch').value);
      loadMyBooks();
    }
  } catch (err) {
    alert('Hata oluştu: ' + err.message);
  }
}

function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

$('#search').addEventListener('input', (e) => {
  loadMyBooks(e.target.value);
});

$('#librarySearch').addEventListener('input', (e) => {
  searchLibrary(e.target.value);
});

// Initialize
loadMyBookIds().then(() => {
  loadMyBooks();
  searchLibrary('');
});
</script>
</body>
</html>