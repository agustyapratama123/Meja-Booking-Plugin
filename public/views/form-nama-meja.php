<?php
defined('ABSPATH') || exit;

// Ambil ID meja dari URL
$meja_id = isset($_GET['meja']) ? intval($_GET['meja']) : '';

// Ambil data session jika sebelumnya sudah diisi
$customer_name = isset($_SESSION['meja_booking']['customer_name']) ? esc_attr($_SESSION['meja_booking']['customer_name']) : '';
?>

<h2>Pesan Meja</h2>

<form id="booking-step1-form" method="post">
    <?php wp_nonce_field('meja_booking_step1', 'meja_booking_nonce'); ?>

    <input type="hidden" name="step" value="menu">

    <p>
        <label for="customer_name">Nama Anda:</label><br>
        <input type="text" id="customer_name" name="customer_name" required value="<?php echo $customer_name; ?>">
    </p>

    <p>
        <label for="meja_display">Nomor Meja:</label><br>
        <input type="number" id="meja_display" value="<?php echo esc_attr($meja_id); ?>" disabled>
        <input type="hidden" name="meja_id" value="<?php echo esc_attr($meja_id); ?>">
    </p>

    <p>
        <button type="submit" name="booking_step1_submit">Lanjut Pilih Menu</button>
    </p>
</form>
