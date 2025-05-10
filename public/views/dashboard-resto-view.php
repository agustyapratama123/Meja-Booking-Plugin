<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin Resto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 240px;
      background-color: #333;
      color: #fff;
      display: flex;
      flex-direction: column;
      padding: 20px 0;
      position: fixed;
      height: 100%;
      transition: all 0.3s ease;
    }

    .sidebar.hidden {
      display: none;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 20px;
    }

    .sidebar a, .sidebar button.submenu-toggle {
      color: #ccc;
      padding: 12px 20px;
      display: block;
      text-align: left;
      text-decoration: none;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }

    .sidebar a:hover, .sidebar button.submenu-toggle:hover {
      background-color: #444;
      color: #fff;
    }

    .submenu {
      display: none;
      background-color: #2a2a2a;
    }

    .submenu a {
      padding-left: 40px;
    }

    .submenu.active {
      display: block;
    }

    .main-content {
      margin-left: 240px;
      padding: 20px;
      flex-grow: 1;
      transition: margin-left 0.3s;
    }

    .main-content.expanded {
      margin-left: 0;
    }

    .header {
      background: #fff;
      padding: 16px;
      border-bottom: 1px solid #ddd;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      margin: 0;
      font-size: 20px;
    }

    .toggle-btn {
      background: transparent;
      border: none;
      color: #333;
      font-size: 18px;
      cursor: pointer;
      margin-right: 12px;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <div class="sidebar" id="sidebar">
    <h2>Resto</h2>
    <a href="#">Dashboard</a>
    <a href="#">Tambah Menu</a>
    <a href="#">Kategori Menu</a>
    <a href="#">Pesanan</a>
    <a href="#">Meja</a>
    <a href="#">Laporan</a>

    <!-- Submenu Pengaturan -->
    <button class="submenu-toggle" onclick="toggleSubmenu()">Pengaturan ▼</button>
    <div class="submenu" id="settingsSubmenu">
      <a href="#">Profil</a>
      <a href="#">Preferensi</a>
      <a href="#" onclick="handleLogout()">Logout</a>
    </div>
  </div>

  <div class="main-content" id="mainContent">
    <div class="header">
      <div>
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h1 style="display:inline-block;">Dashboard</h1>
      </div>
    </div>

    <div class="content">
      <p>Selamat datang di dashboard admin resto.</p>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const main = document.getElementById('mainContent');

      sidebar.classList.toggle('hidden');
      main.classList.toggle('expanded');
    }

    function toggleSubmenu() {
      const submenu = document.getElementById('settingsSubmenu');
      submenu.classList.toggle('active');
    }

    function handleLogout() {
        // Logout pengguna dan arahkan ke halaman login-resto
  window.location.href = '<?php echo wp_logout_url( home_url( '/login-resto/' ) ); ?>';

    }
  </script>
</body>
</html>
