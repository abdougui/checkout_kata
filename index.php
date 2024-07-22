<?php
require_once("src/Item.php");
require_once("src/Checkout.php");

// those are pricing rules migh be changed
// below thi week’s prices:
$pricingRules = [
    'A' => new Item('A', 50),
    'B' => new Item('B', 75, ['type' => 'multipriced', 'n' => 2, 'price' => 125]),
    'C' => new Item('C', 25, ['type' => 'buy_n_get_1_free', 'n' => 3]),
    'D' => new Item('D', 150, ['type' => 'meal_deal']),
    'E' => new Item('E', 200, ['type' => 'meal_deal']),
];

$checkout = new Checkout($pricingRules);

//here you can test checkout by scanning Items
// for example I want to scan A : $checkout->scan('A');
$checkout->scan('A');
$checkout->scan('B');
$checkout->scan('B');
$checkout->scan('C');
$checkout->scan('C');
$checkout->scan('C');
$checkout->scan('C'); // This one should be free

$checkout->scan('D');
$checkout->scan('E');// These two should be priced as a meal deal

echo "Total: £" . $checkout->total();
