<?php
// app/Repositories/BookRepositoryInterface.php
namespace App\Repositories\Book;

use App\Models\Book;

interface BookRepositoryInterface {
    public function getAllBooks(array $data);
    public function getBookById($id);
    public function createBook(array $data);
    public function updateBook($id, array $data);
    public function deleteBook($id);
}
