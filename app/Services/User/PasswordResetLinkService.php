<?php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class PasswordResetLinkService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function sendPasswordResetLink($email) {
        return $this->userRepository->sendPasswordResetLink($email);
    }
}