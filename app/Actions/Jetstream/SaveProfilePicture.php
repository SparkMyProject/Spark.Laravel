<?php

namespace App\Actions\Jetstream;

use App\Models\Authentication\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class SaveProfilePicture implements DeletesUsers
{
  /**
   * Delete the given user.
   */
  public function save(User $user): void
  {

  }
}
