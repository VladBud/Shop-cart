<?php

namespace components\connections;

use components\interfaces\ConnectionInterface;
use components\RedisWrapper;

class Redis implements ConnectionInterface
{
    public function getAllProducts() {
        // TODO: Implement getAllProducts() method.
    }

    public function connect() {
        // TODO: Implement connect() method.
    }

    public function insertIntoCart($productName, $quantity, $price)
    {
        $inRedis = RedisWrapper::getDecoded('cart') ?? [];

        if($this->checkInCart($productName)) {
            foreach ($inRedis as $index => $item) {
                if($item['product'] == $productName) {
                    $inRedis[$index]['quantity'] += $quantity;
                }
            }
        } else {
            array_push($inRedis, [
                'product' => $productName,
                'quantity' => $quantity,
                'price' => $price
            ]);
        }

        RedisWrapper::set('cart', $inRedis);
    }

    public function checkInCart($productName)
    {
        $inRedis = RedisWrapper::getDecoded('cart') ?? [];

        foreach ($inRedis as $item) {
            if($item['product'] == $productName) {
                return true;
            }
        }

        return false;
    }

    public function selectAllCart()
    {
        $result = [];
        $count = 0;

        $inRedis = RedisWrapper::getDecoded('cart') ?? [];

        foreach ($inRedis as $row) {
            $result[$count]['product'] = $row['product'];
            $result[$count]['quantity'] = $row['quantity'];
            $result[$count]['price'] = $row['price'];

            $count++;
        }

        return $result;
    }

    public function removeElement($productName)
    {
        $inRedis = RedisWrapper::getDecoded('cart') ?? [];

        foreach ($inRedis as $index => $item) {
            if($item['product'] == $productName) {
                unset($inRedis[$index]);
            }
        }

        RedisWrapper::set('cart', $inRedis);
    }

    public function removeAll()
    {
        RedisWrapper::delete('cart');
    }
}