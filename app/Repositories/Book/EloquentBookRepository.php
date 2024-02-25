<?php

namespace App\Repositories\Book;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class EloquentBookRepository implements BookRepositoryInterface {
    protected $model;

    // Injecting the Book model into the repository
    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    // Get all books with optional pagination
    public function getAllBooks(array $data) {
        $page = 1;
        $perPage = 10;

        // Checking for page and limit parameters in the data array
        if (isset($data['page'])) {
            $page = $data['page'];
        }

        if (isset($data['limit'])) {
            $perPage = $data['limit'];
        }

        // Retrieving paginated books from the database
        return $this->model->skip(($page - 1) * $perPage)->latest()->paginate($perPage);
    }

    // Get a specific book by ID
    public function getBookById($id) {
        return $this->model->findOrFail($id);
    }

    // Create a new book
    public function createBook(array $data) {

        // Handling image upload to S3 if provided
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('books', 's3'); 
            $data['image'] = $imagePath;
        }

        // Creating a new book record
        return $this->model->create($data);
    }

    // Update an existing book by ID
    public function updateBook($id, array $data) {

        // Retrieving the book by ID
        $book = $this->getBookById($id);

        // Handling image update to S3 if provided
        if (isset($data['image']) && $data['image']->isValid()) {
            // Deleting the previous image from S3 if it exists
            if ($book->image) {
                Storage::disk('s3')->delete($book->image);
            }

            // Storing the new image to S3
            $newImagePath = $data['image']->store('books', 's3'); 
            $data['image'] = $newImagePath;
        }

        // Updating the book record
        $book->update($data);
        return $book;
    }

    // Delete a book by ID
    public function deleteBook($id) {

        // Retrieving the book by ID
        $book = $this->getBookById($id);

        // Deleting the image from S3 if it exists
        if ($book->image) {
            Storage::disk('s3')->delete($book->image);
        }

        // Deleting the book record
        $book->delete();
        return $book;
    }
}
