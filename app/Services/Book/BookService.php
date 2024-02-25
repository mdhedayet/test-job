<?php

namespace App\Services\Book;

use App\Repositories\Book\BookRepositoryInterface;

class BookService {
    protected $bookRepository;

    // Injecting BookRepositoryInterface into the service
    public function __construct(BookRepositoryInterface $bookRepository) {
        $this->bookRepository = $bookRepository;
    }

    // Get all books with optional pagination
    public function getAllBooks(array $data) {
        return $this->bookRepository->getAllBooks($data);
    }

    // Get a specific book by ID
    public function getBookById($id) {
        return $this->bookRepository->getBookById($id);
    }

    // Create a new book
    public function createBook(array $data) {
        return $this->bookRepository->createBook($data);
    }

    // Update an existing book by ID
    public function updateBook($id, array $data) {
        return $this->bookRepository->updateBook($id, $data);
    }

    // Delete a book by ID
    public function deleteBook($id) {
        return $this->bookRepository->deleteBook($id);
    }
}
