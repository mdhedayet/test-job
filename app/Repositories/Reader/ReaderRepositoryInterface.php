<?php
// app/Repositories/ReaderRepositoryInterface.php
namespace App\Repositories\Reader;

interface ReaderRepositoryInterface {
    public function getAllReaders(array $data);
    public function getReaderById($id);
    public function createReader(array $data);
    public function updateReader($id, array $data);
    public function deleteReader($id);
}
