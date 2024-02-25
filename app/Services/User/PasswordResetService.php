<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class PasswordResetService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function resetPassword($email, $password, $token) {
        return $this->userRepository->resetPassword($email, $password, $token);
    }
}
