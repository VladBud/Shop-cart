<?php

use components\Cart;
use components\Product;
use components\Connection;

/**
 * Show exceptions in dev environment
 */
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
include_once 'config.php';

/**
 * dynamic type connection
 */
$storageType = 'components\connections\\' . TYPE_CONNECTION;
$connection = new Connection(new $storageType());

$productModel = new Product($connection);
$products = $productModel->getAllProducts();

$cartModel = new Cart($connection);

if(isset($_POST['title']) && isset($_POST['quantity']) && isset($_POST['price'])) {
    $cartModel->insertIntoCart($_POST['title'], $_POST['quantity'], $_POST['price']);
}

if(isset($_POST['delete'])) {
    $cartModel->removeElement($_POST['title']);
}

if(isset($_POST['deleteAll'])) {
    $cartModel->removeAll();
}

$allCart = $cartModel->selectAllCart();

if(isset($_GET['page']) == 'cart') {
    return require_once 'view/cart.php';
}

return require_once 'view/main.php';