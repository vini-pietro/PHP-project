<?php

namespace Viniciuspietro\Task2;

// Creating a class named Library, we use the concept of object aggregation

class Library {
    private $books = [];      //book list
    private $resources = [];  //Resource list

    public function __construct(array $books = [], array $resources = []) {
        $this->books = $books;
        $this->resources = $resources;
    }

    // Aggregates a book
    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    //Remove a book from ID
    public function removeBookById(int $id): bool {
        foreach ($this->books as $key => $book) {
            if ($book->getId() === $id) {
                unset($this->books[$key]);
                return true;
            }
        }
        return false;
    }

    // book list
    public function listBooks(): array {
        return $this->books;
    }

    // Aggregates a resource
    public function addResource(Resource $resource) {
        $this->resources[] = $resource;
    }

    // Remove a resouce by using ID
    public function removeResourceById(int $id): bool {
        foreach ($this->resources as $key => $resource) {
            if ($resource->getId() === $id) {
                unset($this->resources[$key]);
                return true;
            }
        }
        return false;
    }

    // Resource list
    public function listResources(): array {
        return $this->resources;
    }
}
