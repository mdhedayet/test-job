<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\User\AuthService;
use App\Services\Reader\ReaderService;

class ReaderController extends Controller
{
    protected $readerService;
    protected $authService;

    // Injecting ReaderService and AuthService into the controller
    public function __construct(ReaderService $readerService, AuthService $authService) {
        $this->readerService = $readerService;
        $this->authService = $authService;
    }

    // Display a list of readers
    public function index(Request $request) {
        // Validate request data (page and limit)
        $data = $request->validate([
            'page' => 'nullable',
            'limit' => 'nullable',
        ]);

        // Get authenticated user
        $user = $this->authService->authUser();

        // Get all readers with optional pagination
        $readers = $this->readerService->getAllReaders($data);

        // Render the Inertia view with readers and user data
        return Inertia::render('Readers/Index', ['readers' => $readers, 'user' => $user]);
    }

    // Show the form for creating a new reader
    public function create() {
        return Inertia::render('Readers/Create');
    }

    // Store a newly created reader in storage
    public function store(Request $request) {
        // Validate request data (name)
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        // Create a new reader using ReaderService
        $this->readerService->createReader($data);

        // Redirect to the readers index page
        return redirect()->route('readers.index');
    }

    // Show the form for editing the specified reader
    public function edit($id) {
        // Get the reader by ID using ReaderService
        $reader = $this->readerService->getReaderById($id);

        // Render the Inertia view with the reader data
        return Inertia::render('Readers/Edit', ['reader' => $reader]);
    }

    // Update the specified reader in storage
    public function update(Request $request, $id) {
        // Validate request data (name)
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        // Update the reader using ReaderService
        $this->readerService->updateReader($id, $data);

        // Redirect to the readers index page
        return redirect()->route('readers.index');
    }

    // Remove the specified reader from storage
    public function destroy($id) {
        // Delete the reader using ReaderService
        $this->readerService->deleteReader($id);

        // Redirect to the readers index page
        return redirect()->route('readers.index');
    }
}
