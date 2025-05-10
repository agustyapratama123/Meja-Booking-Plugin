<?php
defined('ABSPATH') || exit;

// Ambil data sebelumnya dari session jika tersedia
$booking   = $_SESSION['meja_booking'] ?? [];
$menu_ids  = isset($booking['menu_ids']) ? esc_attr($booking['menu_ids']) : '';
?>

<style>
   .menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 16px;
    margin: 20px 0;
}

.menu-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 12px;
    text-align: center;
    box-shadow: 0 1px 5px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.menu-card:hover {
    transform: scale(1.03);
}

.menu-card img {
    width: 100%;
    aspect-ratio: 1; /* Menjaga rasio gambar 1:1 */
    object-fit: cover;
    border-radius: 8px;
}

.menu-card h4 {
    margin: 10px 0 4px;
    font-size: 16px;
    color: #333;
}

.menu-card p {
    margin: 0;
    font-size: 14px;
    color: #666;
}

.menu-card button {
    margin-top: 8px;
    padding: 6px 12px;
    background-color: #FF6B6B;
    border: none;
    color: white;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
}

.menu-card button:hover {
    background-color: #e85c5c;
}

.hidden-input {
    display: none;
}

.submit-button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    border: none;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
}

.submit-button:hover {
    background-color: #449d48;
}

</style>

<h2>Pilih Menu Berdasarkan Kategori</h2>

<form method="post">
    <?php wp_nonce_field('meja_booking_menu', 'meja_booking_nonce'); ?>
    <input type="hidden" name="step" value="cart">
    <input type="hidden" id="menu_ids" name="menu_ids" value="<?php echo $menu_ids; ?>">

    <div>
        <label for="category">Pilih Kategori:</label>
        <select id="category" name="category" onchange="filterMenuByCategory(this.value)">
            <option value="all">Semua</option>
            <option value="Makanan">Makanan</option>
            <option value="Minuman">Minuman</option>
        </select>
    </div>

    <div class="menu-grid" id="menuGrid">
        <?php
        // Dummy menu (di dunia nyata, ambil dari DB)
        $dummy_menus = [
            ['id' => 1, 'name' => 'Nasi Goreng', 'price' => '20.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Nasi-Goreng-Tom-Yum.jpg', 'category' => 'Makanan'],
            ['id' => 2, 'name' => 'Es Teh Manis', 'price' => '5.000', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBahwbNgaH9kayWO641G-_QZWbR45dw1y75Q&s', 'category' => 'Minuman'],
            ['id' => 3, 'name' => 'Ayam Bakar', 'price' => '25.000', 'image' => 'https://www.kelasgarasi.com/wp-content/uploads/2024/10/ayam-bakar-indonesia.jpg', 'category' => 'Makanan'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
            ['id' => 4, 'name' => 'Jus Alpukat', 'price' => '12.000', 'image' => 'https://dcostseafood.id/wp-content/uploads/2021/12/Jus-Alpukat.jpg', 'category' => 'Minuman'],
        ];

        // Tampilkan semua menu
        foreach ($dummy_menus as $menu) {
            echo '<div class="menu-card" data-id="' . esc_attr($menu['id']) . '" data-category="' . esc_attr($menu['category']) . '">';
            echo '<img src="' . esc_url($menu['image']) . '" alt="' . esc_attr($menu['name']) . '">';
            echo '<h4>' . esc_html($menu['name']) . '</h4>';
            echo '<p>Rp ' . esc_html($menu['price']) . '</p>';
            echo '<button type="button" onclick="toggleMenuSelection(' . esc_js($menu['id']) . ')">Tambah</button>';
            echo '</div>';
        }
        ?>
    </div>

    <button type="submit" name="booking_step2_submit" class="submit-button">Lanjut ke Keranjang</button>
</form>


<script>
    function filterMenuByCategory(category) {
        const menuCards = document.querySelectorAll('.menu-card');

        menuCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');

            if (category === 'all' || category === cardCategory) {
                card.style.display = 'block'; // Tampilkan jika sesuai kategori
            } else {
                card.style.display = 'none'; // Sembunyikan jika tidak sesuai kategori
            }
        });
    }
</script>

