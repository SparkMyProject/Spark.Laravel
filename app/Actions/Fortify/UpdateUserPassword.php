<?php

namespace App\Actions\Fortify;

use App\Models\Authentication\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        $validator = Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ]);
        $validator->validateWithBag('updatePassword');

        $validated = $validator->validated();

        $filtered = array_filter($validated);
        $user->forceFill([
            'password' => Hash::make($filtered['password']),
        ])->save();
    }
}