<?php

namespace App\Repositories\Reader;

use App\Models\Reader;

class EloquentReaderRepository implements ReaderRepositoryInterface {
    protected $model;

    // Injecting the Reader model into the repository
    public function __construct(Reader $model)
    {
        $this->model = $model;
    }

    // Get all readers with optional pagination
    public function getAllReaders(array $data) {
        $page = 1;
        $perPage = 10;

        // Checking for page and limit parameters in the data array
        if (isset($data['page'])) {
            $page = $data['page'];
        }

        if (isset($data['limit'])) {
            $perPage = $data['limit'];
        }

        // Retrieving paginated readers from the database
        return $this->model->skip(($page - 1) * $perPage)->latest()->paginate($perPage);
    }

    // Get a specific reader by ID
    public function getReaderById($id) {
        return $this->model->findOrFail($id);
    }

    // Create a new reader
    public function createReader(array $data) {
        return $this->model->create($data);
    }

    // Update an existing reader by ID
    public function updateReader($id, array $data) {
        // Retrieving the reader by ID
        $reader = $this->getReaderById($id);

        // Updating the reader record
        $reader->update($data);

        return $reader;
    }

    // Delete a reader by ID
    public function deleteReader($id) {
        // Retrieving the reader by ID
        $reader = $this->getReaderById($id);

        // Deleting the reader record
        $reader->delete();

        return $reader;
    }
}
