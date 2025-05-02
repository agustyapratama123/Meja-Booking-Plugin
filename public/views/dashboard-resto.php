<?php defined('ABSPATH') || exit; ?>

<style>
  .resto-dashboard-container {
    display: flex;
    min-height: 100vh;
    font-family: Arial, sans-serif;
  }
  .resto-sidebar {
    width: 220px;
    background: #333;
    color: #fff;
    padding: 1em;
  }
  .resto-sidebar h3 {
    color: #fff;
    margin-bottom: 1em;
  }
  .resto-sidebar a {
    display: block;
    color: #ccc;
    padding: 0.5em 0;
    text-decoration: none;
  }
  .resto-sidebar a:hover {
    color: #fff;
  }
  .resto-main {
    flex: 1;
    padding: 2em;
    background: #f7f7f7;
  }
</style>

<div class="resto-dashboard-container">
  <div class="resto-sidebar">
    <h3>Resto Panel</h3>
    <a href="?page=dashboard">Dashboard</a>
    <a href="?page=menu">Kelola Menu</a>
    <a href="?page=orders">Pesanan</a>
    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a>
  </div>

  <div class="resto-main">
    <?php
      $page = $_GET['page'] ?? 'dashboard';

      switch ($page) {
        case 'menu':
          echo '<h2>Kelola Menu</h2>';
          echo '<p>List menu atau form tambah menu di sini.</p>';
          break;
        case 'orders':
          echo '<h2>Pesanan Masuk</h2>';
          echo '<p>Daftar pesanan user akan ditampilkan di sini.</p>';
          break;
        default:
          echo '<h2>Selamat Datang, ' . esc_html(wp_get_current_user()->display_name) . '!</h2>';
          echo '<p>Silakan pilih menu dari sidebar.</p>';
      }
    ?>
  </div>
</div>
