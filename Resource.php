<?php

namespace Viniciuspietro\Task2;

class Resource {
    private static $nextId = 1;
    private $id;
    private $type;
    private $quantity;

    public function __construct($type, $quantity) {
        $this->id = self::$nextId++;
        $this->type = $type;
        $this->quantity = $quantity;
    }

    public static function getNextId() {
        return self::$nextId;
    }

    public static function setNextId($id) {
        self::$nextId = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    // Method expected by the test
    public function getResourceDetails() {
        return "Resource ID: {$this->id}, Type: {$this->type}, Quantity: {$this->quantity}";
    }

    public function getDescription() {
        return $this->getResourceDetails(); // Compatible with the Describable interface

    }
}
