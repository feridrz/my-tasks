<?php

require __DIR__ . '/vendor/autoload.php';


$db = new PDO('mysql:host=localhost;dbname=shop', 'root', '123');

$order = new App\Order($db);

$item1 = new App\Item(1, 'Item Name 1', 15.00); // Create a new item
$item2 = new App\Item(2, 'Item Name 2', 20.00); // Create another item

$order->addItem($item1); // add first item
$order->addItem($item2); // add second Item

echo "Items count: " . $order->getItemsCount() . "\n";

echo "Total sum: " . $order->calculateTotalSum() . "\n";

$order->printOrder();

$order->deleteItem($item1);

echo "Items count after deletion: " . $order->getItemsCount() . "\n";

$order->save();
$order->load(3);
$order->update();
$order->delete();

