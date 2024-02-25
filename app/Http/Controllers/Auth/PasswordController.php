<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Services\User\PasswordUpdateService;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    protected $passwordUpdateService;

    public function __construct(PasswordUpdateService $passwordUpdateService) {
        $this->passwordUpdateService = $passwordUpdateService;
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();

        if ($this->passwordUpdateService->validateCurrentPassword($user, $validated['current_password'])) {
            $this->passwordUpdateService->updatePassword($user, $validated['password']);
            return back();
        }

        throw ValidationException::withMessages([
            'current_password' => [trans('auth.password')],
        ]);
    }
}