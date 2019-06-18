<?php


class Connection
{
    private $connection;

    public function __construct(ConnectionInterface $connection) {
        $this->connection = $connection;
    }

    public function getConnection() {
        return $this->connection;
    }
}