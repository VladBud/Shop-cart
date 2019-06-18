<?php

namespace components\connections;

use PDO;
use components\interfaces\ConnectionInterface;

class Sqlite implements ConnectionInterface
{
    /**
     * @return array
     */
    public function getAllProducts() {
        $dbh = $this->connect();

        $query =  "SELECT * FROM products ";

        $result = [];
        $count = 0;

        foreach ($dbh->query($query) as $row) {
            $result[$count]['name'] = $row['name'];
            $result[$count]['price'] = $row['price'];
            $result[$count]['img'] = $row['img'];

            $count++;
        }

        return $result;
    }

    /**
     * @param $productName
     * @param $quantity
     * @param $price
     */
    public function insertIntoCart($productName, $quantity, $price) {

        $dbh = $this->connect();

        if($this->checkInCart($productName)) {
            $stmt = $dbh->prepare("UPDATE cart SET quantity = quantity + :quantity WHERE product = :product");
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':product', $productName);
            $stmt->execute();
        } else {
            $stmt = $dbh->prepare("INSERT INTO cart(product, quantity, price) VALUES (:product, :quantity, :price)");

            $stmt->bindParam(':product', $productName);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);

            $stmt->execute();
        }
    }

    /**
     * @param $productName
     * @return bool
     */
    public function checkInCart($productName) {
        $dbh = $this->connect();

        $stmt = $dbh->prepare("SELECT count(*) FROM cart WHERE product = :product");

        $stmt->bindParam(':product', $productName);

        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();

        return $number_of_rows == 0 ? false : true;
    }

    /**
     * @return array
     */
    public function selectAllCart() {
        $dbh = $this->connect();

        $query =  "SELECT * FROM cart ";

        $result = [];
        $count = 0;

        foreach ($dbh->query($query) as $row) {
            $result[$count]['product'] = $row['product'];
            $result[$count]['quantity'] = $row['quantity'];
            $result[$count]['price'] = $row['price'];

            $count++;
        }

        return $result;
    }

    /**
     * @return PDO
     */
    public function connect() {
        return new PDO('sqlite:/' . DATABASE_PATH);
    }

    public function removeAll()
    {
        $dbh = $this->connect();

        $stmt = $dbh->prepare("DELETE FROM cart");
        $stmt->execute();

    }

    public function removeElement($productName)
    {
        $dbh = $this->connect();

        $stmt = $dbh->prepare("DELETE FROM cart WHERE product = :product");
        $stmt->bindParam(':product', $productName);
        $stmt->execute();
    }
}