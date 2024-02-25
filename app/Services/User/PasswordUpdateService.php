<?php
// app/Services/PasswordUpdateService.php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class PasswordUpdateService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function updatePassword($user, $newPassword) {
        $this->userRepository->updatePassword($user, $newPassword);
    }

    public function validateCurrentPassword($user, $currentPassword) {
        return $this->userRepository->validateCurrentPassword($user, $currentPassword);
    }
}
