<?php

abstract class Product
{
    protected string $sku;

    protected string $name;

    protected $price;

    protected PDO $conn;

    public function __construct()
    {
        $this->conn = (Database::getInstance())->connect();
    }

    abstract function getType();

    /**
     * save the product to DB
     * @return bool
     */
    abstract function create(): bool;

    public function getTableName(): string
    {
        return "Products";
    }

    public function getPrimaryKey(): string
    {
        return "sku";
    }


    public function getSku(): string
    {
        return $this->sku;
    }


    public function setSku($sku)
    {
        $this->sku = Sanitizer::sanitize($sku);
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = Sanitizer::sanitize($name);
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = Sanitizer::sanitize($price);
    }

    public function toArray(): array
    {
        return [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
        ];
    }

    /**
     * read all products from DB
     * @return false|PDOStatement
     */
    public function read()
    {
        $query = 'SELECT * from ' . $this->getTableName();

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    /**
     * delete a product by sku
     * @return bool
     */
    public function delete(): bool
    {
        $query = 'DELETE FROM ' . $this->getTableName() . ' WHERE ' . $this->getPrimaryKey() . ' = :sku';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':sku', $this->sku);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


}