<?php


class Cart
{
    private $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection->getConnection();
    }

    public function insertIntoCart($productName, $quantity, $price) {
        return $this->connection->insertIntoCart($productName, $quantity, $price);
    }

    public function checkInCart($productName) {
        return $this->connection->checkInCart($productName);
    }

    public function selectAllCart() {
        return $this->connection->selectAllCart();
    }
}