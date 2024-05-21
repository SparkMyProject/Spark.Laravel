<?php

namespace App\Actions\Fortify;

use App\Models\Authentication\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:20', 'unique:users'],
//            'display_name' => [string', 'max:30'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

      if (!isset($input['password']) || empty($input['password'])) {
        throw new \Exception('Password is required');
      }

//      return User::create([
//        'username' => $input['username'],
//        'display_name' => $input['username'],
//        'password' => Hash::make($input['password']),
//      ])->assignRole('User');
      $user = User::make([
        'username' => $input['username'],
        'display_name' => $input['username']]);
      $user->password = Hash::make($input['password']);
      $user->save();
      $user->assignRole('User');
      return $user;

    }
}
