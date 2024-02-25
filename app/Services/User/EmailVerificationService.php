<?php
// app/Services/EmailVerificationService.php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class EmailVerificationService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function sendVerificationNotification($user) {
        if ($this->userRepository->hasVerifiedEmail($user)) {
            return;
        }

        $this->userRepository->sendEmailVerificationNotification($user);
    }


    public function hasVerifiedEmail($user) {
        return $this->userRepository->hasVerifiedEmail($user);
    }


    public function markEmailAsVerified($user) {
        return $this->userRepository->markEmailAsVerified($user);
    }
}
