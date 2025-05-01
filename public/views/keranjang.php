<?php
defined('ABSPATH') || exit;

$booking = $_SESSION['meja_booking'] ?? [];

$customer_name = isset($booking['customer_name']) ? esc_html($booking['customer_name']) : 'Tamu';
$meja_id       = isset($booking['meja_id']) ? intval($booking['meja_id']) : '-';
$menu_ids      = isset($booking['menu_ids']) ? explode(',', $booking['menu_ids']) : [];
?>

<h2>Keranjang Anda</h2>

<p><strong>Nama:</strong> <?php echo $customer_name; ?></p>
<p><strong>No Meja:</strong> <?php echo $meja_id; ?></p>

<?php if (!empty($menu_ids)) : ?>
    <ul>
        <?php foreach ($menu_ids as $id): ?>
            <li>Menu ID: <?php echo intval($id); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Keranjang masih kosong.</p>
<?php endif; ?>

<form method="post">
    <?php wp_nonce_field('meja_booking_checkout', 'meja_booking_nonce'); ?>
    <input type="hidden" name="step" value="checkout">
    <button type="submit" name="checkout_submit">Checkout & Bayar</button>
</form>
