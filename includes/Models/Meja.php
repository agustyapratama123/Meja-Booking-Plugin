<?php

class Meja {

    private $meja_table;
    private $menu_table;
    private $order_table;

    public function __construct() {
        $this->meja_table  = new Meja_Table();
        $this->menu_table  = new Menu_Table();
        $this->order_table = new Order_Table();
    }

    /**
     * Membuat pemesanan baru
     */
    public function buatPesanan($meja_id, $menu_items = [], $customer_name = '') {
        $meja = $this->meja_table->get($meja_id);

        if (!$meja) {
            return new WP_Error('meja_tidak_ada', 'Meja tidak ditemukan.');
        }

        if ($meja->status !== 'available') {
            return new WP_Error('meja_tidak_tersedia', 'Meja sudah dipesan.');
        }

        $order_data = [
            'meja_id' => $meja_id,
            'customer_name' => $customer_name,
            'menu_items' => maybe_serialize($menu_items),
            'status' => 'pending',
            'created_at' => current_time('mysql')
        ];

        $order_id = $this->order_table->insert($order_data);

        if (!$order_id) {
            return new WP_Error('gagal_order', 'Gagal membuat pesanan.');
        }

        $this->meja_table->update($meja_id, [
            'status' => 'booked'
        ]);

        return $order_id;
    }

    /**
     * Menyelesaikan pemesanan
     */
    public function selesaikanPesanan($order_id) {
        $order = $this->order_table->get($order_id);

        if (!$order) {
            return new WP_Error('order_tidak_ada', 'Order tidak ditemukan.');
        }

        $this->order_table->update($order_id, [
            'status' => 'completed'
        ]);

        $this->meja_table->update($order->meja_id, [
            'status' => 'available'
        ]);

        return true;
    }

    /**
     * Mendapatkan semua pesanan
     */
    public function semuaPesanan() {
        return $this->order_table->get_all();
    }
}
