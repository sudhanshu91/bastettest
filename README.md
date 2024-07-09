>> Acme Widget Co - Basket Implementation

This repository contains a PHP implementation for the Acme Widget Co's new sales system. The basket system handles the product catalogue, delivery charge rules, and special offers as described in the project requirements.

>>How It Works

The main class, `Basket`, is initialized with the product catalogue, delivery charge rules, and special offers. The class provides two main methods:

- `add($productCode)`: Adds a product to the basket using its product code.
- `total()`: Calculates the total cost of the basket, including delivery charges and applying any special offers.

>> Product Catalogue

The product catalogue is passed as an associative array with product codes as keys and prices as values.

>> Delivery Charges

Delivery charges are passed as an associative array with the upper limit of the order amount as keys and the corresponding delivery charge as values.

>> Special Offers

Special offers are passed as an associative array with product codes as keys and offer details as values. The current implementation supports the "buy one get one half price" offer.

>> Assumptions

- Only the "buy one get one half price" offer is implemented.
- Delivery charges are based on the total order amount before applying delivery charges.
- The product catalogue, delivery charges, and offers are passed correctly formatted to the `Basket` class.

>> Example Usage

```php
$basket = new Basket($catalogue, $deliveryCharges, $offers);
$basket->add('B01');
$basket->add('G01');
echo "Total: $" . $basket->total(); 
