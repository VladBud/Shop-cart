<?php


class Product
{
    /** @var ConnectionInterface $connection */
    private $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection->getConnection();
    }

    public function getAllProducts() {
        return $this->connection->getAllProducts();

    }

}