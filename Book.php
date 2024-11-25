<?php

namespace Viniciuspietro\Task2;

class Book {
    private static $nextId = 1;
    private $id;
    private $title;
    private $author;
    private $isbn;

    public function __construct($title, $author, $isbn) {
        $this->id = self::$nextId++;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
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

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    // Method expected by the test
    public function getDetails() {
        return "Book ID: {$this->id}, Title: {$this->title}, Author: {$this->author}, ISBN: {$this->isbn}";
    }

    public function getDescription() {
        return $this->getDetails(); // Compatible with the Describable interface
    }
}
