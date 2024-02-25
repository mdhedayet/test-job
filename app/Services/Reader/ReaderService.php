<?php

namespace App\Services\Reader;

use App\Repositories\Reader\ReaderRepositoryInterface;

class ReaderService {
    protected $readerRepository;

    // Injecting ReaderRepositoryInterface into the service
    public function __construct(ReaderRepositoryInterface $readerRepository) {
        $this->readerRepository = $readerRepository;
    }

    // Get all readers with optional pagination
    public function getAllReaders(array $data) {
        return $this->readerRepository->getAllReaders($data);
    }

    // Get a specific reader by ID
    public function getReaderById($id) {
        return $this->readerRepository->getReaderById($id);
    }

    // Create a new reader
    public function createReader(array $data) {
        return $this->readerRepository->createReader($data);
    }

    // Update an existing reader by ID
    public function updateReader($id, array $data) {
        return $this->readerRepository->updateReader($id, $data);
    }

    // Delete a reader by ID
    public function deleteReader($id) {
        return $this->readerRepository->deleteReader($id);
    }
}
