<?php
// app/Services/AuthService.php
namespace App\Services\User;

use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;

class AuthService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function authenticateUser($credentials) {
        return $this->userRepository->authenticate($credentials);
    }

    public function logout() {
        Auth::guard('web')->logout();
    }

    public function AuthUser(){
       return Auth::user();
    }
}
