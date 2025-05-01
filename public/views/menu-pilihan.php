<?php
defined('ABSPATH') || exit;

// Ambil data sebelumnya dari session jika tersedia
$booking   = $_SESSION['meja_booking'] ?? [];
$menu_ids  = isset($booking['menu_ids']) ? esc_attr($booking['menu_ids']) : '';
?>

<h2>Pilih Menu</h2>

<form method="post">
    <?php wp_nonce_field('meja_booking_menu', 'meja_booking_nonce'); ?>
    <input type="hidden" name="step" value="cart">

    <p>
        <label for="menu_ids">Pilih Makanan/Minuman (contoh: 1,2,3):</label><br>
        <input type="text" id="menu_ids" name="menu_ids" value="<?php echo $menu_ids; ?>" pattern="^(\d+,?)+$" required>
    </p>

    <button type="submit" name="booking_step2_submit">Lanjut ke Keranjang</button>
</form>
