<?php

// app/Http/Controllers/Auth/EmailVerificationNotificationController.php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Services\User\EmailVerificationService;

class EmailVerificationNotificationController extends Controller
{
    protected $emailVerificationService;

    public function __construct(EmailVerificationService $emailVerificationService) {
        $this->emailVerificationService = $emailVerificationService;
    }

    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $this->emailVerificationService->sendVerificationNotification($user);

        return $user->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : back()->with('status', 'verification-link-sent');
    }
}
