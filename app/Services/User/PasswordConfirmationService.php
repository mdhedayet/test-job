<?php
// app/Services/PasswordConfirmationService.php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class PasswordConfirmationService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function confirmPassword($user, $password) {
        return $this->userRepository->validatePassword($user->email, $password);
    }
}
