<?php

namespace App\Actions\Fortify;

use App\Models\Authentication\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
  /**
   * Validate and update the given user's profile information.
   *
   * @param array<string, mixed> $input
   */
  public function update(User $user, array $input): void
  {
    $validator = Validator::make($input, [
      'display_name' => ['nullable', 'string', 'max:30'],
      'first_name' => ['nullable', 'string', 'max:128'],
      'last_name' => ['nullable', 'string', 'max:128'],
      'status' => ['nullable', 'string', 'max:30'],
      'timezone' => ['nullable', 'string', Rule::in(['EST', 'UTC', 'AEST', 'CST', 'PST'])],
      'email' => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
    ]);


    $validator->validateWithBag('updateProfileInformation');

    $validated = $validator->validated();

    if (isset($input['photo'])) {
      $user->updateProfilePhoto($input['photo']);
    }

    // TODO: Implement updateProfilePhoto method and check the Livevwire component
    $filtered = array_filter($validated);


    if ($input['email'] !== $user->email &&
      $user instanceof MustVerifyEmail) {
      $this->updateVerifiedUser($user, $input);
    } else {
      $user->forceFill($filtered);
    }
  }

  /**
   * Update the given verified user's profile information.
   *
   * @param array<string, string> $input
   */
  protected function updateVerifiedUser(User $user, array $input): void
  {
    $user->forceFill([
      'name' => $input['name'],
      'email' => $input['email'],
      'email_verified_at' => null,
    ])->save();

    $user->sendEmailVerificationNotification();
  }
}
