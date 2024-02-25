<?php
// app/Repositories/UserRepositoryInterface.php
namespace App\Repositories\User;

interface UserRepositoryInterface {
    public function create(array $data);
    public function updateUser($user, $data);
    public function deleteUser($user);
    public function authenticate($credentials);
    public function validatePassword($email, $password);
    public function hasVerifiedEmail($user);
    public function sendEmailVerificationNotification($user);
    public function resetPassword($email, $password, $token);
    public function updatePassword($user, $newPassword);
    public function validateCurrentPassword($user, $currentPassword);
    public function sendPasswordResetLink($email);
    public function markEmailAsVerified($user);
}
