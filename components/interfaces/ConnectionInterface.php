<?php

namespace components\interfaces;

interface ConnectionInterface {
    public function getAllProducts();

    public function connect();

    public function insertIntoCart($productName, $quantity, $price);

    public function checkInCart($productName);

    public function selectAllCart();

    public function removeAll();

    public function removeElement($productName);
}
