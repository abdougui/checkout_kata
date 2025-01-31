# Supermarket Checkout System

This project is a test implementation of a supermarket checkout system, developed by Abdellah Guidir for Fluro company. The goal is to calculate the total price of items in a shopping cart, applying various promotions and special offers.

## Features

- **Scan Items**: Add items to the shopping cart.
- **Promotions**: Apply different types of promotions such as multipriced offers, buy n get 1 free offers, and meal deals.
- **Dynamic Pricing Rules**: Set and update pricing rules dynamically.

## Pricing Rules

The pricing rules for this test are as follows:

- **A**: 50 pence each.
- **B**: 75 pence each or 2 for £1.25.
- **C**: 25 pence each, buy 3 get 1 free.
- **D**: 150 pence each.
- **E**: 200 pence each.
- **D and E**: Special offer where buying one of each costs £3.

## How to Run

1. **Clone the Repository**: 
   ```bash
   git clone https://github.com/abdougui/checkout_kata.git
   ```
   ```
   go to index.php 
   ```
   to scan an item add ```$checkout->scan('Item Name');``` before echo ```"Total: £" . $checkout->total();```