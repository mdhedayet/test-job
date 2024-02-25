<?php
// app/Http/Controllers/Auth/ConfirmablePasswordController.php
namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use App\Services\User\PasswordConfirmationService;

class ConfirmablePasswordController extends Controller
{
    protected $passwordConfirmationService;

    public function __construct(PasswordConfirmationService $passwordConfirmationService) {
        $this->passwordConfirmationService = $passwordConfirmationService;
    }

    /**
     * Show the confirm password view.
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        $password = $request->password;

        if (! $this->passwordConfirmationService->confirmPassword($user, $password)) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
