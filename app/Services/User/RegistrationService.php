<?php
// app/Services/RegistrationService.php
namespace App\Services\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Repositories\User\UserRepositoryInterface;

class RegistrationService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data) {
        $user = $this->userRepository->create($data);

        event(new Registered($user));

        Auth::login($user);
    }
}
