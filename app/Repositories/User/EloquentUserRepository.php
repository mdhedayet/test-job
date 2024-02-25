<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

class EloquentUserRepository implements UserRepositoryInterface {

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    public function updateUser($user, $data) {
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
    }

    public function deleteUser($user) {
        $user->delete();
    }

    public function authenticate($credentials) {
        return Auth::attempt($credentials);
    }

    public function validatePassword($email, $password) {
        return Auth::guard('web')->validate([
            'email' => $email,
            'password' => $password,
        ]);
    }


    public function hasVerifiedEmail($user) {
        return $user->hasVerifiedEmail();
    }

    public function sendEmailVerificationNotification($user) {
        $user->sendEmailVerificationNotification();
    }


    public function resetPassword($email, $password, $token) {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return Password::INVALID_USER;
        }

        $user->forceFill([
            'password' => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        return Password::PASSWORD_RESET;
    }


    public function updatePassword($user, $newPassword) {
        $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }

    public function validateCurrentPassword($user, $currentPassword) {
        return Hash::check($currentPassword, $user->password);
    }

    public function sendPasswordResetLink($email) {
        return Password::sendResetLink(['email' => $email]);
    }


    public function markEmailAsVerified($user) {
        return $user->markEmailAsVerified();
    }
}
