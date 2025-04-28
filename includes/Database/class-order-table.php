<?php

class Order_Table {

	private $table_name;

	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'meja_orders';
	}

	public function insert($data) {
		global $wpdb;
		$wpdb->insert($this->table_name, $data);
		return $wpdb->insert_id;
	}

	public function update($id, $data) {
		global $wpdb;
		return $wpdb->update($this->table_name, $data, [ 'id' => $id ]);
	}

	public function delete($id) {
		global $wpdb;
		return $wpdb->delete($this->table_name, [ 'id' => $id ]);
	}

	public function get($id) {
		global $wpdb;
		return $wpdb->get_row($wpdb->prepare(
			"SELECT * FROM $this->table_name WHERE id = %d", $id
		));
	}

	public function get_all() {
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM $this->table_name ORDER BY id DESC");
	}
}
