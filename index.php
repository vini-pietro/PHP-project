<?php

require 'vendor/autoload.php';

use Viniciuspietro\Task2\Book;
use Viniciuspietro\Task2\Resource;
use Viniciuspietro\Task2\Library;

// Functions for JSON files
function ensureFileExists($filename) {
    if (!file_exists($filename)) {
        file_put_contents($filename, json_encode([])); // Mandatory: Create a text file
    }
}

function saveToFile($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)); // Mandatory: Write to a text file
}

function loadFromFile($filename) {
    return file_exists($filename) ? json_decode(file_get_contents($filename), true) : []; // Mandatory: Read from a text file
}

// Ensure the existence of JSON files
ensureFileExists('books.json');
ensureFileExists('resources.json');

// Initialize the library
$library = new Library(
    array_map(fn($data) => new Book($data['title'], $data['author'], $data['isbn']), loadFromFile('books.json')), // Mandatory: Use expressions 
    array_map(fn($data) => new Resource($data['type'], $data['quantity']), loadFromFile('resources.json'))
);

// Function to save the library state to JSON files
function saveLibrary(Library $library) {
    saveToFile('books.json', array_map(fn($book) => [
        'title' => $book->getTitle(),
        'author' => $book->getAuthor(),
        'isbn' => $book->getIsbn()
    ], $library->listBooks()));

    saveToFile('resources.json', array_map(fn($resource) => [
        'type' => $resource->getType(),
        'quantity' => $resource->getQuantity()
    ], $library->listResources()));
}
echo " \n";
echo "     ██╗    ██╗███████╗██╗      ██████╗ ██████╗ ███╗   ███╗███████╗\n";
echo "     ██║    ██║██╔════╝██║     ██╔════╝██╔═══██╗████╗ ████║██╔════╝\n";
echo "     ██║ █╗ ██║█████╗  ██║     ██║     ██║   ██║██╔████╔██║█████╗  \n";
echo "     ██║███╗██║██╔══╝  ██║     ██║     ██║   ██║██║╚██╔╝██║██╔══╝  \n";
echo "     ╚███╔███╔╝███████╗███████╗╚██████╗╚██████╔╝██║ ╚═╝ ██║███████╗\n";
echo "      ╚══╝╚══╝ ╚══════╝╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚══════╝\n";
echo " \n";
echo "Enter the corresponding number for the functionality:\n";
echo "1) Generate Book List\n";
echo "2) Generate Resource List\n";
echo "3) Add New Book\n";
echo "4) Delete Book\n";
echo "5) Add New Resource\n";
echo "6) Delete Resource\n";
echo "7) Search Book by ID\n";
echo "8) Sort Books in Ascending Order\n";
echo "9) Sort Books in Descending Order\n";
echo "10) Exit\n";

// Menu and option handling (Mandatory: Present a sequence of execution - menu)
while (true) {
    echo "\nChoose an option: ";
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1': // Generate Book List
            echo "Book List:\n";
            foreach ($library->listBooks() as $book) {
                echo $book->getDescription() . "\n";
            }
            if (empty($library->listBooks())) {
                echo "No books registered.\n";
            }
            break;

        case '2': // Generate Resource List
            echo "Resource List:\n";
            foreach ($library->listResources() as $resource) {
                echo $resource->getDescription() . "\n";
            }
            if (empty($library->listResources())) {
                echo "No resources registered.\n";
            }
            break;

        case '3': // Add New Book
            echo "Enter Book Title: ";
            $title = trim(fgets(STDIN));
            echo "Enter Book Author: ";
            $author = trim(fgets(STDIN));
            echo "Enter Book ISBN: ";
            $isbn = trim(fgets(STDIN));
            $library->addBook(new Book($title, $author, $isbn));
            saveLibrary($library);
            echo "Book added successfully!\n";
            break;

        case '4': // Delete Book
            echo "Enter Book ID to delete: ";
            $id = (int)trim(fgets(STDIN));
            if ($library->removeBookById($id)) {
                saveLibrary($library);
                echo "Book deleted successfully!\n";
            } else {
                echo "Book with ID $id not found.\n";
            }
            break;

        case '5': // Add New Resource
            echo "Enter Resource Type: ";
            $type = trim(fgets(STDIN));
            echo "Enter Resource Quantity: ";
            $quantity = (int)trim(fgets(STDIN));
            $library->addResource(new Resource($type, $quantity));
            saveLibrary($library);
            echo "Resource added successfully!\n";
            break;

        case '6': // Delete Resource
            echo "Enter Resource ID to delete: ";
            $id = (int)trim(fgets(STDIN));
            if ($library->removeResourceById($id)) {
                saveLibrary($library);
                echo "Resource deleted successfully!\n";
            } else {
                echo "Resource with ID $id not found.\n";
            }
            break;

        case '7': // Search Book by ID
            echo "Enter Book ID to search: ";
            $id = (int)trim(fgets(STDIN));
            $found = false;
            foreach ($library->listBooks() as $book) {
                if ($book->getId() === $id) {
                    echo $book->getDescription() . "\n";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                echo "Book with ID $id not found.\n";
            }
            break;

        case '8': // Sort Books in Ascending Order
            $books = $library->listBooks();
            usort($books, fn($a, $b) => strcmp($a->getTitle(), $b->getTitle()));
            echo "Books sorted in ascending order:\n";
            foreach ($books as $book) {
                echo $book->getDescription() . "\n";
            }
            break;

        case '9': // Sort Books in Descending Order
            $books = $library->listBooks();
            usort($books, fn($a, $b) => strcmp($b->getTitle(), $a->getTitle()));
            echo "Books sorted in descending order:\n";
            foreach ($books as $book) {
                echo $book->getDescription() . "\n";
            }
            break;

        case '10': // Exit the program
            echo "Exiting the program.\n";
            exit(0);
            break;

        default:
            echo "Invalid option. Try again.\n";
            break;
    }
}
