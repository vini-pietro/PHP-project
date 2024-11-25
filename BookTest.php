<?php

use PHPUnit\Framework\TestCase;
use Viniciuspietro\Task2\Book;

class BookTest extends TestCase {
    protected function setUp(): void {
       // Resets the ID counter before each test
        Book::setNextId(1);
    }

    public function testBookCreation() {
        $book = new Book("Test Book", "Test Author", "1234567890");
        $this->assertEquals("Test Book", $book->getTitle());
        $this->assertEquals("Test Author", $book->getAuthor());
        $this->assertEquals("1234567890", $book->getIsbn());
    }

    public function testBookDetails() {
        $book = new Book("Test Book", "Test Author", "1234567890");
        $expectedDetails = "Book ID: 1, Title: Test Book, Author: Test Author, ISBN: 1234567890";
        $this->assertEquals($expectedDetails, $book->getDetails());
    }
}
