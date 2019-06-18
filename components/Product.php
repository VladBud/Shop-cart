<?php

namespace components;

use components\connections\Sqlite;

class Product
{
    /** @var ConnectionInterface $connection */
    private $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection->getConnection();
    }

    public function getAllProducts() {
        $dbStorage = new Sqlite();

        return $dbStorage->getAllProducts();
    }

}