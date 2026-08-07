<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidatorContract;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('alert', $this->registrationAlert($validator));
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('games.search', absolute: false))
            ->with('alert', [
                'type' => 'information',
                'message' => 'Account created successfully!',
            ]);
    }

    /**
     * Build the alert payload for a failed registration.
     *
     * @return array{type: string, message: string}
     */
    private function registrationAlert(ValidatorContract $validator): array
    {
        $failed = $validator->failed();

        if ($this->hasFailedRule($failed, 'Confirmed')) {
            return ['type' => 'alert', 'message' => "Password Confirmation fields didn't match\nPlease try again!"];
        }

        if ($this->hasFailedRule($failed, 'Required')) {
            return ['type' => 'alert', 'message' => 'Please complete all required fields !'];
        }

        if ($this->hasFailedRule($failed, 'Unique')) {
            return ['type' => 'alert', 'message' => 'An account with this email address already exists !'];
        }

        return ['type' => 'alert', 'message' => "Failed to create an account.\nPlease try again!"];
    }

    /**
     * Determine whether any field failed a given validation rule.
     *
     * @param  array<string, array<string, mixed>>  $failed
     */
    private function hasFailedRule(array $failed, string $rule): bool
    {
        foreach ($failed as $rules) {
            if (array_key_exists($rule, $rules)) {
                return true;
            }
        }

        return false;
    }
}
