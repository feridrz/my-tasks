<?php

namespace App;

use PDO;

class Order {
    private $items;
    private $orderId;
    private $db;

    public function __construct(PDO $db, $orderId = null) {
        $this->items = array();
        $this->orderId = $orderId;
        $this->db = $db;
    }

    public function calculateTotalSum() {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->price;
        }
        return $sum;
    }

    public function getItems() {
        return $this->items;
    }

    public function getItemsCount() {
        return count($this->items);
    }

    public function addItem(Item $item) {
        array_push($this->items, $item);
    }

    public function deleteItem(Item $item) {
        $key = array_search($item, $this->items);
        if ($key !== false){
            unset($this->items[$key]);
        }
    }

    public function printOrder() {
        foreach($this->items as $item) {
            echo "Item ID: $item->id, Item Name: $item->name, Item Price: $item->price\n";
        }
    }

    public function showOrder() {
        echo "Order ID: " . $this->orderId . "\n";
        $this->printOrder();
    }

    public function save() {
        if (!empty($this->items)) {
            $stmt = $this->db->prepare("INSERT INTO orders (items) VALUES (?)");
            $stmt->execute([serialize($this->items)]);
            $this->orderId = $this->db->lastInsertId();
        }
    }

    public function load($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();

        if ($order) {
            $this->orderId = $order['id'];
            $this->items = unserialize($order['items']);
        }
    }

    public function update() {
        if ($this->orderId !== null && !empty($this->items)) {
            $stmt = $this->db->prepare("UPDATE orders SET items = ? WHERE id = ?");
            $stmt->execute([serialize($this->items), $this->orderId]);
        }
    }

    public function delete() {
        if ($this->orderId !== null) {
            $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
            $stmt->execute([$this->orderId]);
            $this->orderId = null;
            $this->items = array();
        }
    }
}

?>
