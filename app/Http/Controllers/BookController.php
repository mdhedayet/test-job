<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Book\BookService;
use App\Services\User\AuthService;

class BookController extends Controller
{
    protected $bookService;
    protected $authService;

    // Injecting BookService and AuthService into the controller
    public function __construct(BookService $bookService, AuthService $authService) {
        $this->bookService = $bookService; 
        $this->authService = $authService;
    }

    // Display a list of books
    public function index(Request $request) {
        // Validate request data (page and limit)
        $data = $request->validate([
            'page' => 'nullable',
            'limit' => 'nullable',
        ]);

        // Get authenticated user
        $user = $this->authService->authUser();

        // Get all books with optional pagination
        $books = $this->bookService->getAllBooks($data);

        // Render the Inertia view with books and user data
        return Inertia::render('Books/Index', ['books' => $books, 'user' => $user]);
    }

    // Show the form for creating a new book
    public function create() {
        return Inertia::render('Books/Create');
    }

    // Store a newly created book in storage
    public function store(Request $request) {
        // Validate request data (title and optional image)
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable',
        ]);

        // Create a new book using BookService
        $this->bookService->createBook($data);

        // Redirect to the books index page
        return redirect()->route('books.index');
    }

    // Show the form for editing the specified book
    public function edit($id) {
        // Get the book by ID using BookService
        $book = $this->bookService->getBookById($id);

        // Render the Inertia view with the book data
        return Inertia::render('Books/Edit', ['book' => $book]);
    }

    // Update the specified book in storage
    public function update(Request $request, $id) {
        // Validate request data (title and optional image)
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable',
        ]);

        // Update the book using BookService
        $book = $this->bookService->updateBook($id, $data);

        // Redirect to the books index page
        return redirect()->route('books.index');
    }

    // Remove the specified book from storage
    public function destroy($id) {
        // Delete the book using BookService
        $this->bookService->deleteBook($id);

        // Redirect to the books index page
        return redirect()->route('books.index');
    }
}
