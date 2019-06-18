<?php

/**
 * Show exceptions in dev environment
 */
ini_set('display_errors',1);
error_reporting(E_ALL);

include_once 'config.php';
require_once 'components/interfaces/ConnectionInterface.php';
require_once 'components/Product.php';
require_once 'components/Cart.php';
require_once 'components/Connection.php';
require_once 'components/connections/Sqlite.php';

$connection = new Connection(new Sqlite());

$productModel = new Product($connection);
$products = $productModel->getAllProducts();

$cartModel = new Cart($connection);

if(isset($_POST['title']) && isset($_POST['quantity']) && isset($_POST['price'])) {
    $cartModel->insertIntoCart($_POST['title'], $_POST['quantity'], $_POST['price']);
}

$allCart = $cartModel->selectAllCart();


if (isset($_GET['page']) == 'cart') {
    return require_once 'view/cart.php';
}

return require_once 'view/main.php';