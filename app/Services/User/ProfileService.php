<?php 
// app/Services/ProfileService.php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class ProfileService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function updateUserProfile($user, $data) {
        $this->userRepository->updateUser($user, $data);
    }

    public function deleteUserAccount($user) {
        $this->userRepository->deleteUser($user);
    }
}
