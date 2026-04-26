<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Manajemen Blog (CMS)</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
/* ===== CSS VARIABLES ===== */
:root {
  --primary:   #1a7f5a;
  --primary-lt:#22a574;
  --primary-dk:#135c40;
  --accent:    #f0a500;
  --danger:    #e03e3e;
  --danger-dk: #b52e2e;
  --info:      #2980e4;
  --dark:      #1c2333;
  --dark2:     #253047;
  --card:      #ffffff;
  --bg:        #f3f6fb;
  --border:    #dde3ed;
  --text:      #2c3e50;
  --text-muted:#7f8fa4;
  --sidebar-w: 220px;
  --header-h:  60px;
  --radius:    10px;
  --shadow:    0 4px 20px rgba(0,0,0,.08);
  --shadow-lg: 0 8px 32px rgba(0,0,0,.13);
  --trans:     .22s cubic-bezier(.4,0,.2,1);
  --input-bg:  #ffffff;
  --sidebar-bg:#ffffff;
  --modal-bg:  #ffffff;
  --btn-gray-bg:#eef0f5;
  --btn-gray-text:var(--text-muted);
}

body.dark-theme {
  --primary:   #22a574;
  --primary-lt:#26c489;
  --primary-dk:#1a7f5a;
  --dark:      #0b0f1a;
  --dark2:     #13192b;
  --card:      #1e293b;
  --bg:        #0f172a;
  --border:    #334155;
  --text:      #f1f5f9;
  --text-muted:#94a3b8;
  --input-bg:  #1e293b;
  --sidebar-bg:#1e293b;
  --modal-bg:  #1e293b;
  --btn-gray-bg:#334155;
  --btn-gray-text:#f1f5f9;
  --shadow:    0 4px 20px rgba(0,0,0,.4);
  --shadow-lg: 0 8px 32px rgba(0,0,0,.55);
}

/* ===== RESET ===== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
  transition: background var(--trans), color var(--trans);
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }

/* ===== HEADER ===== */
.header {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  height: var(--header-h);
  background: linear-gradient(135deg, var(--dark) 0%, var(--dark2) 100%);
  display: flex; align-items: center; padding: 0 20px;
  box-shadow: 0 2px 16px rgba(0,0,0,.25);
}
.header-logo {
  display: flex; align-items: center; gap: 10px;
  min-width: 0; flex: 1;
}
.header-logo .logo-icon {
  width: 36px; height: 36px;
  background: linear-gradient(135deg, var(--primary-lt), var(--primary));
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; color: #fff;
  box-shadow: 0 2px 8px rgba(26,127,90,.4);
  animation: logoPulse 3s ease-in-out infinite;
}
@keyframes logoPulse {
  0%,100% { box-shadow: 0 2px 8px rgba(26,127,90,.4); }
  50%      { box-shadow: 0 2px 18px rgba(26,127,90,.7); }
}
.logo-text { min-width: 0; overflow: hidden; }
.header-logo .logo-text h1 {
  font-size: 15px; font-weight: 700; color: #fff; letter-spacing: .3px;
  line-height: 1.2;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.header-logo .logo-text p {
  font-size: 11px; color: rgba(255,255,255,.5); letter-spacing: .5px;
}
.hamburger {
  display: none;
  background: none; border: none;
  cursor: pointer;
  flex-direction: column; gap: 5px;
  padding: 4px;
  flex-shrink: 0;
}
.hamburger span {
  display: block; width: 24px; height: 2px;
  background: rgba(255,255,255,.8);
  border-radius: 2px;
  transition: var(--trans);
}
.hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.hamburger.open span:nth-child(2) { opacity: 0; }
.hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ===== LAYOUT ===== */
.layout {
  display: flex;
  padding-top: var(--header-h);
  min-height: 100vh;
}

/* ===== SIDEBAR ===== */
.sidebar {
  width: var(--sidebar-w);
  min-height: calc(100vh - var(--header-h));
  background: var(--sidebar-bg);
  border-right: 1px solid var(--border);
  position: fixed; top: var(--header-h); left: 0; bottom: 0;
  z-index: 90;
  overflow-y: auto;
  transition: transform var(--trans);
  padding: 20px 0;
}
.sidebar-label {
  font-size: 10px; font-weight: 700;
  color: var(--text-muted);
  letter-spacing: 1.2px; text-transform: uppercase;
  padding: 0 18px 10px;
}
.nav-item {
  display: flex; align-items: center; gap: 10px;
  padding: 11px 18px;
  cursor: pointer;
  border-radius: 0;
  color: var(--text-muted);
  font-size: 13.5px; font-weight: 500;
  transition: var(--trans);
  position: relative;
  text-decoration: none;
  border: none; background: none; width: 100%; text-align: left;
  user-select: none;
}
.nav-item::before {
  content: '';
  position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px;
  background: var(--primary);
  border-radius: 0 3px 3px 0;
  opacity: 0;
  transform: scaleY(0);
  transition: var(--trans);
}
.nav-item:hover { background: rgba(26,127,90,.1); color: var(--primary); }
.nav-item.active {
  background: linear-gradient(90deg, rgba(26,127,90,.15) 0%, rgba(26,127,90,.05) 100%);
  color: var(--primary); font-weight: 600;
}
.nav-item.active::before { opacity: 1; transform: scaleY(1); }

body.dark-theme .nav-item:hover { background: rgba(34,165,116,.15); }
body.dark-theme .nav-item.active { background: linear-gradient(90deg, rgba(34,165,116,.2) 0%, rgba(34,165,116,.05) 100%); }
.nav-icon { font-size: 16px; width: 20px; text-align: center; flex-shrink: 0; }
.sidebar-overlay {
  display: none;
  position: fixed; inset: 0; z-index: 85;
  background: rgba(0,0,0,.4);
  backdrop-filter: blur(2px);
}
.sidebar-overlay.show { display: block; }

/* ===== MAIN CONTENT ===== */
.main {
  flex: 1;
  margin-left: var(--sidebar-w);
  padding: 28px;
  min-height: calc(100vh - var(--header-h));
}

/* ===== SECTION ===== */
.section { display: none; animation: fadeInUp .3s ease; }
.section.active { display: block; }
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(14px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ===== SECTION HEADER ===== */
.section-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 20px; flex-wrap: wrap; gap: 12px;
}
.section-title { font-size: 18px; font-weight: 700; color: var(--text); }

/* ===== CARD ===== */
.card {
  background: var(--card);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  overflow: hidden;
}

/* ===== TABLE ===== */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead tr { border-bottom: 2px solid var(--border); }
th {
  padding: 13px 14px;
  font-size: 11px; font-weight: 700; letter-spacing: .8px;
  text-transform: uppercase; color: var(--text-muted);
  text-align: left; white-space: nowrap;
}
td {
  padding: 13px 14px;
  font-size: 13.5px; color: var(--text);
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
tbody tr {
  transition: background var(--trans);
}
tbody tr:hover { background: rgba(26,127,90,.03); }
tbody tr:last-child td { border-bottom: none; }

/* ===== TABLE IMAGE ===== */
.tbl-img {
  width: 48px; height: 48px;
  border-radius: 8px;
  object-fit: cover;
  border: 2px solid var(--border);
  background: var(--bg);
  display: flex; align-items: center; justify-content: center;
  font-size: 10px; font-weight: 700; color: var(--text-muted);
  font-family: 'DM Mono', monospace;
}
.tbl-img img { width: 100%; height: 100%; object-fit: cover; border-radius: 6px; }

/* ===== BADGE ===== */
.badge {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 11.5px; font-weight: 600;
  background: rgba(41,128,228,.12);
  color: var(--info);
}

/* ===== BUTTONS ===== */
.btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 16px;
  border-radius: 7px;
  font-size: 13px; font-weight: 600;
  cursor: pointer; border: none;
  transition: var(--trans);
  white-space: nowrap;
  text-decoration: none;
  font-family: inherit;
  position: relative; overflow: hidden;
}
.btn::after {
  content: '';
  position: absolute; inset: 0;
  background: rgba(255,255,255,.2);
  opacity: 0;
  transition: opacity .15s;
}
.btn:hover::after { opacity: 1; }
.btn:active { transform: scale(.97); }

.btn-primary {
  background: linear-gradient(135deg, var(--primary-lt), var(--primary));
  color: #fff;
  box-shadow: 0 2px 10px rgba(26,127,90,.3);
}
.btn-primary:hover { box-shadow: 0 4px 16px rgba(26,127,90,.45); }

.btn-info {
  background: linear-gradient(135deg, #3b9ae1, var(--info));
  color: #fff;
  box-shadow: 0 2px 8px rgba(41,128,228,.25);
}
.btn-danger {
  background: linear-gradient(135deg, #e85858, var(--danger));
  color: #fff;
  box-shadow: 0 2px 8px rgba(224,62,62,.25);
}
.btn-gray {
  background: var(--btn-gray-bg); color: var(--btn-gray-text);
}
.btn-gray:hover { opacity: .9; }

.btn-sm { padding: 5px 12px; font-size: 12px; border-radius: 6px; }

/* ===== PASSWORD DISPLAY ===== */
.pwd-mono {
  font-family: 'DM Mono', monospace;
  font-size: 12px; color: var(--text-muted);
}

/* ===== MODAL ===== */
.modal-overlay {
  position: fixed; inset: 0; z-index: 200;
  background: rgba(15,20,35,.55);
  backdrop-filter: blur(4px);
  display: flex; align-items: center; justify-content: center;
  padding: 16px;
  opacity: 0; pointer-events: none;
  transition: opacity .25s;
}
.modal-overlay.show { opacity: 1; pointer-events: all; }
.modal {
  background: var(--modal-bg);
  border-radius: 14px;
  width: 100%; max-width: 520px;
  max-height: 90vh; overflow-y: auto;
  box-shadow: 0 20px 60px rgba(0,0,0,.2);
  transform: translateY(18px) scale(.97);
  transition: transform .28s cubic-bezier(.34,1.56,.64,1), opacity .25s;
  opacity: 0;
}
.modal-overlay.show .modal { transform: translateY(0) scale(1); opacity: 1; }
.modal-header {
  padding: 22px 24px 16px;
  border-bottom: 1px solid var(--border);
}
.modal-title { font-size: 17px; font-weight: 700; color: var(--text); }
.modal-body { padding: 20px 24px; }
.modal-footer {
  padding: 16px 24px;
  border-top: 1px solid var(--border);
  display: flex; justify-content: flex-end; gap: 10px;
}

/* Confirm modal */
.confirm-modal {
  max-width: 380px;
  text-align: center;
}
.confirm-icon {
  width: 64px; height: 64px;
  background: rgba(224,62,62,.1);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 28px;
  margin: 0 auto 14px;
  animation: iconBounce .4s cubic-bezier(.34,1.56,.64,1) .1s both;
}
@keyframes iconBounce {
  from { transform: scale(0); opacity: 0; }
  to   { transform: scale(1); opacity: 1; }
}
.confirm-title { font-size: 17px; font-weight: 700; margin-bottom: 6px; }
.confirm-text  { font-size: 13px; color: var(--text-muted); margin-bottom: 4px; }

/* ===== FORM ===== */
.form-row { display: flex; gap: 14px; }
.form-row .form-group { flex: 1; min-width: 0; }
.form-group { margin-bottom: 16px; }
.form-group label {
  display: block;
  font-size: 12.5px; font-weight: 600;
  color: var(--text); margin-bottom: 6px;
}
.form-control {
  width: 100%;
  padding: 9px 12px;
  border: 1.5px solid var(--border);
  border-radius: 7px;
  font-size: 13.5px;
  font-family: inherit;
  color: var(--text);
  background: var(--input-bg);
  transition: border-color var(--trans), box-shadow var(--trans), background var(--trans);
  outline: none;
}
.form-control:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(26,127,90,.12);
}
textarea.form-control { resize: vertical; min-height: 100px; }
select.form-control { cursor: pointer; }
.form-file {
  width: 100%;
  padding: 8px 12px;
  border: 1.5px dashed var(--border);
  border-radius: 7px;
  font-size: 13px; font-family: inherit;
  cursor: pointer;
  transition: border-color var(--trans);
  background: var(--bg);
}
.form-file:hover { border-color: var(--primary); }

/* ===== TOAST ===== */
#toast-container {
  position: fixed; bottom: 24px; right: 24px; z-index: 500;
  display: flex; flex-direction: column; gap: 10px;
}
.toast {
  min-width: 260px; max-width: 340px;
  padding: 13px 18px;
  border-radius: 10px;
  font-size: 13.5px; font-weight: 500;
  display: flex; align-items: center; gap: 10px;
  box-shadow: 0 6px 24px rgba(0,0,0,.15);
  animation: toastIn .3s cubic-bezier(.34,1.56,.64,1);
  backdrop-filter: blur(4px);
}
@keyframes toastIn {
  from { transform: translateX(60px); opacity: 0; }
  to   { transform: translateX(0);    opacity: 1; }
}
.toast.fadeout { animation: toastOut .3s ease forwards; }
@keyframes toastOut {
  to { transform: translateX(60px); opacity: 0; }
}
.toast-success { background: #eafaf2; color: #166b45; border: 1px solid #a3d9c0; }
.toast-error   { background: #fdf0f0; color: #8b2020; border: 1px solid #f0b0b0; }
.toast-icon    { font-size: 17px; flex-shrink: 0; }

body.dark-theme .toast-success { background: #064e3b; color: #34d399; border-color: #065f46; }
body.dark-theme .toast-error   { background: #7f1d1d; color: #f87171; border-color: #991b1b; }

/* ===== LOADING ===== */
.loading {
  display: flex; align-items: center; justify-content: center;
  padding: 40px; color: var(--text-muted); font-size: 14px; gap: 10px;
}
.spinner {
  width: 20px; height: 20px;
  border: 2.5px solid var(--border);
  border-top-color: var(--primary);
  border-radius: 50%;
  animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ===== EMPTY STATE ===== */
.empty-state {
  padding: 52px 20px;
  text-align: center;
  color: var(--text-muted);
}
.empty-state .empty-icon { font-size: 42px; margin-bottom: 12px; opacity: .5; }
.empty-state p { font-size: 14px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  :root { --sidebar-w: 240px; }
  .sidebar {
    transform: translateX(-100%);
  }
  .sidebar.open { transform: translateX(0); }
  .hamburger { display: flex; }
  .main { margin-left: 0; padding: 18px 14px; }
  .form-row { flex-direction: column; gap: 0; }
  .section-header { flex-direction: column; align-items: flex-start; }
  th, td { font-size: 12.5px; padding: 10px 10px; }
  .btn-sm { padding: 5px 9px; font-size: 11.5px; }
}
@media (max-width: 480px) {
  .modal { border-radius: 10px; }
  .modal-body { padding: 16px; }
  .modal-footer { padding: 12px 16px; }
  .main { padding: 14px 10px; }
}

/* ===== ANIMATIONS ===== */
.row-enter {
  animation: rowEnter .35s ease;
}
@keyframes rowEnter {
  from { opacity: 0; transform: translateX(-10px); }
  to   { opacity: 1; transform: translateX(0); }
}

/* Shimmer skeleton */
.skeleton {
  background: linear-gradient(90deg, #f0f3f8 25%, #e4e8f0 50%, #f0f3f8 75%);
  background-size: 200% 100%;
  animation: shimmer 1.4s infinite;
  border-radius: 6px;
}
@keyframes shimmer {
  0%   { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

body.dark-theme .skeleton {
  background: linear-gradient(90deg, #1e293b 25%, #334155 50%, #1e293b 75%);
  background-size: 200% 100%;
}
/* ===== THEME TOGGLE ===== */
.theme-toggle {
  margin-left: auto; margin-right: 12px;
  width: 38px; height: 38px;
  border-radius: 50%;
  border: none; background: rgba(255,255,255,.1);
  color: #fff; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; transition: var(--trans);
  flex-shrink: 0;
}
.theme-toggle:hover { background: rgba(255,255,255,.2); transform: rotate(15deg); }
.theme-toggle .sun-icon { display: none; }
.dark-theme .theme-toggle .moon-icon { display: none; }
.dark-theme .theme-toggle .sun-icon { display: block; }

@media (max-width: 768px) {
  .theme-toggle { margin-right: 8px; }
  .header { padding: 0 12px; }
  .header-logo .logo-text p { display: none; }
  .header-logo .logo-text h1 { font-size: 13.5px; }
}
</style>
</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="header-logo">
    <div class="logo-icon">📝</div>
    <div class="logo-text">
      <h1>Sistem Manajemen Blog (CMS)</h1>
      <p>Blog Keren</p>
    </div>
  </div>
  <button class="theme-toggle" id="themeToggle" aria-label="Toggle Dark Mode">
    <span class="moon-icon">🌙</span>
    <span class="sun-icon">☀️</span>
  </button>
  <button class="hamburger" id="hamburger" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</header>

<!-- LAYOUT -->
<div class="layout">

  <!-- SIDEBAR OVERLAY -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- SIDEBAR -->
  <nav class="sidebar" id="sidebar">
    <p class="sidebar-label">Menu Utama</p>
    <button class="nav-item active" data-section="penulis">
      <span class="nav-icon">👤</span> Kelola Penulis
    </button>
    <button class="nav-item" data-section="artikel">
      <span class="nav-icon">📄</span> Kelola Artikel
    </button>
    <button class="nav-item" data-section="kategori">
      <span class="nav-icon">🗂️</span> Kelola Kategori
    </button>
  </nav>

  <!-- MAIN -->
  <main class="main">

    <!-- ===== PENULIS ===== -->
    <section class="section active" id="section-penulis">
      <div class="section-header">
        <h2 class="section-title">Data Penulis</h2>
        <button class="btn btn-primary" onclick="openModalTambahPenulis()">
          ＋ Tambah Penulis
        </button>
      </div>
      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody-penulis">
              <tr><td colspan="5"><div class="loading"><div class="spinner"></div> Memuat data…</div></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- ===== ARTIKEL ===== -->
    <section class="section" id="section-artikel">
      <div class="section-header">
        <h2 class="section-title">Data Artikel</h2>
        <button class="btn btn-primary" onclick="openModalTambahArtikel()">
          ＋ Tambah Artikel
        </button>
      </div>
      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody-artikel">
              <tr><td colspan="6"><div class="loading"><div class="spinner"></div> Memuat data…</div></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- ===== KATEGORI ===== -->
    <section class="section" id="section-kategori">
      <div class="section-header">
        <h2 class="section-title">Data Kategori Artikel</h2>
        <button class="btn btn-primary" onclick="openModalTambahKategori()">
          ＋ Tambah Kategori
        </button>
      </div>
      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody-kategori">
              <tr><td colspan="3"><div class="loading"><div class="spinner"></div> Memuat data…</div></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

  </main>
</div><!-- end layout -->

<!-- ============================= MODALS ============================= -->

<!-- Modal Tambah Penulis -->
<div class="modal-overlay" id="modal-tambah-penulis">
  <div class="modal">
    <div class="modal-header"><h3 class="modal-title">Tambah Penulis</h3></div>
    <form id="form-tambah-penulis" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group">
            <label>Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" placeholder="Ahmad" required>
          </div>
          <div class="form-group">
            <label>Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" placeholder="Fauzi" required>
          </div>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="user_name" class="form-control" placeholder="ahmad_f" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Foto Profil</label>
          <input type="file" name="foto" class="form-file" accept="image/*">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" onclick="closeModal('modal-tambah-penulis')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Penulis -->
<div class="modal-overlay" id="modal-edit-penulis">
  <div class="modal">
    <div class="modal-header"><h3 class="modal-title">Edit Penulis</h3></div>
    <form id="form-edit-penulis" enctype="multipart/form-data">
      <input type="hidden" name="id" id="edit-penulis-id">
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group">
            <label>Nama Depan</label>
            <input type="text" name="nama_depan" id="edit-penulis-nama-depan" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nama Belakang</label>
            <input type="text" name="nama_belakang" id="edit-penulis-nama-belakang" class="form-control" required>
          </div>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="user_name" id="edit-penulis-username" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Password Baru <small style="font-weight:400;color:var(--text-muted)">(kosongkan jika tidak diganti)</small></label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <label>Foto Profil <small style="font-weight:400;color:var(--text-muted)">(kosongkan jika tidak diganti)</small></label>
          <input type="file" name="foto" class="form-file" accept="image/*">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" onclick="closeModal('modal-edit-penulis')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Tambah Artikel -->
<div class="modal-overlay" id="modal-tambah-artikel">
  <div class="modal">
    <div class="modal-header"><h3 class="modal-title">Tambah Artikel</h3></div>
    <form id="form-tambah-artikel" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <label>Judul</label>
          <input type="text" name="judul" class="form-control" placeholder="Judul artikel..." required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Penulis</label>
            <select name="id_penulis" class="form-control" id="select-penulis-tambah" required></select>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" id="select-kategori-tambah" required></select>
          </div>
        </div>
        <div class="form-group">
          <label>Isi Artikel</label>
          <textarea name="isi" class="form-control" placeholder="Tulis isi artikel di sini..." required></textarea>
        </div>
        <div class="form-group">
          <label>Gambar</label>
          <input type="file" name="gambar" class="form-file" accept="image/*" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" onclick="closeModal('modal-tambah-artikel')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Artikel -->
<div class="modal-overlay" id="modal-edit-artikel">
  <div class="modal">
    <div class="modal-header"><h3 class="modal-title">Edit Artikel</h3></div>
    <form id="form-edit-artikel" enctype="multipart/form-data">
      <input type="hidden" name="id" id="edit-artikel-id">
      <div class="modal-body">
        <div class="form-group">
          <label>Judul</label>
          <input type="text" name="judul" id="edit-artikel-judul" class="form-control" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Penulis</label>
            <select name="id_penulis" class="form-control" id="select-penulis-edit" required></select>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" id="select-kategori-edit" required></select>
          </div>
        </div>
        <div class="form-group">
          <label>Isi Artikel</label>
          <textarea name="isi" id="edit-artikel-isi" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label>Gambar <small style="font-weight:400;color:var(--text-muted)">(kosongkan jika tidak diganti)</small></label>
          <input type="file" name="gambar" class="form-file" accept="image/*">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" onclick="closeModal('modal-edit-artikel')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal-overlay" id="modal-tambah-kategori">
  <div class="modal">
    <div class="modal-header"><h3 class="modal-title">Tambah Kategori</h3></div>
    <form id="form-tambah-kategori">
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori..." required>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea name="keterangan" class="form-control" placeholder="Deskripsi kategori..."></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" onclick="closeModal('modal-tambah-kategori')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal-overlay" id="modal-edit-kategori">
  <div class="modal">
    <div class="modal-header"><h3 class="modal-title">Edit Kategori</h3></div>
    <form id="form-edit-kategori">
      <input type="hidden" name="id" id="edit-kategori-id">
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" name="nama_kategori" id="edit-kategori-nama" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea name="keterangan" id="edit-kategori-keterangan" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" onclick="closeModal('modal-edit-kategori')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal-overlay" id="modal-hapus">
  <div class="modal confirm-modal">
    <div class="modal-body" style="padding:30px 24px 10px">
      <div class="confirm-icon">🗑️</div>
      <p class="confirm-title">Hapus data ini?</p>
      <p class="confirm-text">Data yang dihapus tidak dapat dikembalikan.</p>
    </div>
    <div class="modal-footer" style="justify-content:center">
      <button class="btn btn-gray" onclick="closeModal('modal-hapus')">Batal</button>
      <button class="btn btn-danger" id="btn-konfirmasi-hapus">Ya, Hapus</button>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div id="toast-container"></div>

<!-- ============================= JAVASCRIPT ============================= -->
<script>
'use strict';

/* -------- THEME -------- */
const themeToggle = document.getElementById('themeToggle');
const currentTheme = localStorage.getItem('theme');

if (currentTheme === 'dark') {
  document.body.classList.add('dark-theme');
}

themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
  let theme = 'light';
  if (document.body.classList.contains('dark-theme')) {
    theme = 'dark';
  }
  localStorage.setItem('theme', theme);
});

/* -------- NAVIGATION -------- */
const navItems  = document.querySelectorAll('.nav-item[data-section]');
const sections  = document.querySelectorAll('.section');
const sidebar   = document.getElementById('sidebar');
const hamburger = document.getElementById('hamburger');
const overlay   = document.getElementById('sidebarOverlay');

navItems.forEach(btn => {
  btn.addEventListener('click', () => {
    const target = btn.dataset.section;
    navItems.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    sections.forEach(s => s.classList.remove('active'));
    document.getElementById('section-' + target).classList.add('active');
    closeSidebar();
    if (target === 'penulis')  loadPenulis();
    if (target === 'artikel')  loadArtikel();
    if (target === 'kategori') loadKategori();
  });
});

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('open');
  sidebar.classList.toggle('open');
  overlay.classList.toggle('show');
});
overlay.addEventListener('click', closeSidebar);
function closeSidebar() {
  hamburger.classList.remove('open');
  sidebar.classList.remove('open');
  overlay.classList.remove('show');
}

/* -------- MODAL -------- */
function openModal(id) {
  const el = document.getElementById(id);
  el.classList.add('show');
  document.body.style.overflow = 'hidden';
}
function closeModal(id) {
  const el = document.getElementById(id);
  el.classList.remove('show');
  document.body.style.overflow = '';
}
document.querySelectorAll('.modal-overlay').forEach(ov => {
  ov.addEventListener('click', e => { if (e.target === ov) closeModal(ov.id); });
});
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.show').forEach(m => closeModal(m.id));
});

/* -------- TOAST -------- */
function showToast(msg, type = 'success') {
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  toast.className = `toast toast-${type}`;
  toast.innerHTML = `<span class="toast-icon">${type === 'success' ? '✅' : '❌'}</span><span>${msg}</span>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.classList.add('fadeout');
    setTimeout(() => toast.remove(), 350);
  }, 3000);
}

/* -------- HELPER: safe escape -------- */
function esc(str) {
  const d = document.createElement('div');
  d.textContent = str || '';
  return d.innerHTML;
}

/* -------- IMG THUMB -------- */
function imgThumb(src, folder) {
  if (!src) return `<div class="tbl-img">—</div>`;
  const ext = src.split('.').pop().toUpperCase();
  return `<div class="tbl-img" title="${esc(src)}">
    <img src="${folder}/${esc(src)}" alt="img" onerror="this.parentElement.innerHTML='<span>${ext}</span>'">
  </div>`;
}

/* ======================== PENULIS ======================== */
function loadPenulis() {
  const tbody = document.getElementById('tbody-penulis');
  tbody.innerHTML = `<tr><td colspan="5"><div class="loading"><div class="spinner"></div> Memuat data…</div></td></tr>`;
  fetch('ambil_penulis.php')
    .then(r => r.json())
    .then(res => {
      if (res.status !== 'success' || !res.data.length) {
        tbody.innerHTML = `<tr><td colspan="5"><div class="empty-state"><div class="empty-icon">👤</div><p>Belum ada data penulis.</p></div></td></tr>`;
        return;
      }
      tbody.innerHTML = res.data.map((p, i) => `
        <tr class="row-enter" style="animation-delay:${i * .04}s">
          <td>${imgThumb(p.foto, 'uploads_penulis')}</td>
          <td><strong>${esc(p.nama_depan)} ${esc(p.nama_belakang)}</strong></td>
          <td><span class="badge">${esc(p.user_name)}</span></td>
          <td><span class="pwd-mono">${esc(p.password.substring(0, 12))}…</span></td>
          <td>
            <button class="btn btn-info btn-sm" onclick="openEditPenulis(${p.id})">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="konfirmasiHapus('penulis', ${p.id})" style="margin-left:4px">Hapus</button>
          </td>
        </tr>`).join('');
    })
    .catch(() => {
      tbody.innerHTML = `<tr><td colspan="5"><div class="loading">❌ Gagal memuat data.</div></td></tr>`;
    });
}

function openModalTambahPenulis() {
  document.getElementById('form-tambah-penulis').reset();
  openModal('modal-tambah-penulis');
}

document.getElementById('form-tambah-penulis').addEventListener('submit', function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch('simpan_penulis.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      if (res.status === 'success') { closeModal('modal-tambah-penulis'); loadPenulis(); }
    });
});

function openEditPenulis(id) {
  fetch('ambil_satu_penulis.php?id=' + id)
    .then(r => r.json())
    .then(res => {
      if (res.status !== 'success') { showToast(res.message, 'error'); return; }
      const d = res.data;
      document.getElementById('edit-penulis-id').value           = d.id;
      document.getElementById('edit-penulis-nama-depan').value   = d.nama_depan;
      document.getElementById('edit-penulis-nama-belakang').value = d.nama_belakang;
      document.getElementById('edit-penulis-username').value     = d.user_name;
      document.querySelector('#form-edit-penulis input[name="password"]').value = '';
      openModal('modal-edit-penulis');
    });
}

document.getElementById('form-edit-penulis').addEventListener('submit', function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch('update_penulis.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      if (res.status === 'success') { closeModal('modal-edit-penulis'); loadPenulis(); }
    });
});

/* ======================== KATEGORI ======================== */
function loadKategori(returnData = false) {
  const tbody = document.getElementById('tbody-kategori');
  if (!returnData) {
    tbody.innerHTML = `<tr><td colspan="3"><div class="loading"><div class="spinner"></div> Memuat data…</div></td></tr>`;
  }
  return fetch('ambil_kategori.php')
    .then(r => r.json())
    .then(res => {
      if (!returnData) {
        if (res.status !== 'success' || !res.data.length) {
          tbody.innerHTML = `<tr><td colspan="3"><div class="empty-state"><div class="empty-icon">🗂️</div><p>Belum ada data kategori.</p></div></td></tr>`;
        } else {
          tbody.innerHTML = res.data.map((k, i) => `
            <tr class="row-enter" style="animation-delay:${i * .04}s">
              <td><span class="badge">${esc(k.nama_kategori)}</span></td>
              <td>${esc(k.keterangan) || '<span style="color:var(--text-muted)">—</span>'}</td>
              <td>
                <button class="btn btn-info btn-sm" onclick="openEditKategori(${k.id})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="konfirmasiHapus('kategori', ${k.id})" style="margin-left:4px">Hapus</button>
              </td>
            </tr>`).join('');
        }
      }
      return res;
    });
}

function openModalTambahKategori() {
  document.getElementById('form-tambah-kategori').reset();
  openModal('modal-tambah-kategori');
}

document.getElementById('form-tambah-kategori').addEventListener('submit', function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch('simpan_kategori.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      if (res.status === 'success') { closeModal('modal-tambah-kategori'); loadKategori(); }
    });
});

function openEditKategori(id) {
  fetch('ambil_satu_kategori.php?id=' + id)
    .then(r => r.json())
    .then(res => {
      if (res.status !== 'success') { showToast(res.message, 'error'); return; }
      const d = res.data;
      document.getElementById('edit-kategori-id').value          = d.id;
      document.getElementById('edit-kategori-nama').value        = d.nama_kategori;
      document.getElementById('edit-kategori-keterangan').value  = d.keterangan || '';
      openModal('modal-edit-kategori');
    });
}

document.getElementById('form-edit-kategori').addEventListener('submit', function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch('update_kategori.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      if (res.status === 'success') { closeModal('modal-edit-kategori'); loadKategori(); }
    });
});

/* ======================== ARTIKEL ======================== */
function loadArtikel() {
  const tbody = document.getElementById('tbody-artikel');
  tbody.innerHTML = `<tr><td colspan="6"><div class="loading"><div class="spinner"></div> Memuat data…</div></td></tr>`;
  fetch('ambil_artikel.php')
    .then(r => r.json())
    .then(res => {
      if (res.status !== 'success' || !res.data.length) {
        tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-icon">📄</div><p>Belum ada data artikel.</p></div></td></tr>`;
        return;
      }
      tbody.innerHTML = res.data.map((a, i) => `
        <tr class="row-enter" style="animation-delay:${i * .04}s">
          <td>${imgThumb(a.gambar, 'uploads_artikel')}</td>
          <td><strong>${esc(a.judul)}</strong></td>
          <td><span class="badge">${esc(a.nama_kategori)}</span></td>
          <td>${esc(a.nama_penulis)}</td>
          <td style="font-size:12px;color:var(--text-muted)">${esc(a.hari_tanggal)}</td>
          <td>
            <button class="btn btn-info btn-sm" onclick="openEditArtikel(${a.id})">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="konfirmasiHapus('artikel', ${a.id})" style="margin-left:4px">Hapus</button>
          </td>
        </tr>`).join('');
    })
    .catch(() => {
      tbody.innerHTML = `<tr><td colspan="6"><div class="loading">❌ Gagal memuat data.</div></td></tr>`;
    });
}

async function populateDropdowns(penulisSelectId, kategoriSelectId, selectedPenulis = '', selectedKategori = '') {
  const [resPenulis, resKategori] = await Promise.all([
    fetch('ambil_penulis.php').then(r => r.json()),
    fetch('ambil_kategori.php').then(r => r.json())
  ]);

  const selP = document.getElementById(penulisSelectId);
  const selK = document.getElementById(kategoriSelectId);

  selP.innerHTML = resPenulis.data.map(p =>
    `<option value="${p.id}" ${p.id == selectedPenulis ? 'selected' : ''}>${esc(p.nama_depan)} ${esc(p.nama_belakang)}</option>`
  ).join('');

  selK.innerHTML = resKategori.data.map(k =>
    `<option value="${k.id}" ${k.id == selectedKategori ? 'selected' : ''}>${esc(k.nama_kategori)}</option>`
  ).join('');
}

async function openModalTambahArtikel() {
  document.getElementById('form-tambah-artikel').reset();
  await populateDropdowns('select-penulis-tambah', 'select-kategori-tambah');
  openModal('modal-tambah-artikel');
}

document.getElementById('form-tambah-artikel').addEventListener('submit', function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch('simpan_artikel.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      if (res.status === 'success') { closeModal('modal-tambah-artikel'); loadArtikel(); }
    });
});

async function openEditArtikel(id) {
  const res = await fetch('ambil_satu_artikel.php?id=' + id).then(r => r.json());
  if (res.status !== 'success') { showToast(res.message, 'error'); return; }
  const d = res.data;
  document.getElementById('edit-artikel-id').value    = d.id;
  document.getElementById('edit-artikel-judul').value = d.judul;
  document.getElementById('edit-artikel-isi').value   = d.isi;
  await populateDropdowns('select-penulis-edit', 'select-kategori-edit', d.id_penulis, d.id_kategori);
  openModal('modal-edit-artikel');
}

document.getElementById('form-edit-artikel').addEventListener('submit', function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch('update_artikel.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      if (res.status === 'success') { closeModal('modal-edit-artikel'); loadArtikel(); }
    });
});

/* ======================== HAPUS ======================== */
let hapusType = '', hapusId = 0;

function konfirmasiHapus(type, id) {
  hapusType = type;
  hapusId   = id;
  openModal('modal-hapus');
}

document.getElementById('btn-konfirmasi-hapus').addEventListener('click', () => {
  const urlMap = { penulis: 'hapus_penulis.php', artikel: 'hapus_artikel.php', kategori: 'hapus_kategori.php' };
  const fd = new FormData();
  fd.append('id', hapusId);
  fetch(urlMap[hapusType], { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      showToast(res.message, res.status);
      closeModal('modal-hapus');
      if (res.status === 'success') {
        if (hapusType === 'penulis')  loadPenulis();
        if (hapusType === 'artikel')  loadArtikel();
        if (hapusType === 'kategori') loadKategori();
      }
    });
});

/* ======================== INIT ======================== */
loadPenulis();
</script>
</body>
</html>
