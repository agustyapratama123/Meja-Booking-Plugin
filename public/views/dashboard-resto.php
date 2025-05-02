<?php
defined('ABSPATH') || exit;
?>
<h2>Dashboard Admin Resto</h2>

<p>Selamat datang, <?php echo esc_html(wp_get_current_user()->display_name); ?>!</p>

<ul>
  <li><a href="#">Kelola Menu</a></li>
  <li><a href="#">Lihat Pesanan</a></li>
</ul>

<p><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a></p>
