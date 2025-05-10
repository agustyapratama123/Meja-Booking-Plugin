<?php
defined('ABSPATH') || exit;

// Ambil ID meja dari URL
$meja_id = isset($_GET['meja']) ? intval($_GET['meja']) : '';

// Ambil data session jika sebelumnya sudah diisi
$customer_name = isset($_SESSION['meja_booking']['customer_name']) ? esc_attr($_SESSION['meja_booking']['customer_name']) : '';
?>

<style>
    .meja-booking-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 24px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        font-family: 'Segoe UI', sans-serif;
    }
    .meja-booking-form h2 {
        text-align: center;
        margin-bottom: 24px;
        color: #333;
    }
    .meja-booking-form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #444;
    }
    .meja-booking-form input[type="text"],
    .meja-booking-form input[type="number"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 16px;
    }
    .meja-booking-form input[disabled] {
        background-color: #eee;
        color: #555;
    }
    .meja-booking-form button {
        width: 100%;
        padding: 12px;
        background-color: #FF6B6B;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .meja-booking-form button:hover {
        background-color: #e85c5c;
    }
</style>

<form id="booking-step1-form" class="meja-booking-form" method="post">
    <?php wp_nonce_field('meja_booking_step1', 'meja_booking_nonce'); ?>

    <input type="hidden" name="step" value="menu">

    <h2>Pesan Meja</h2>

    <label for="customer_name">Nama Anda:</label>
    <input type="text" id="customer_name" name="customer_name" required value="<?php echo $customer_name; ?>">

    <label for="meja_display">Nomor Meja:</label>
    <input type="number" id="meja_display" value="<?php echo esc_attr($meja_id); ?>" disabled>
    <input type="hidden" name="meja_id" value="<?php echo esc_attr($meja_id); ?>">

    <button type="submit" name="booking_step1_submit">Lanjut Pilih Menu</button>
</form>
