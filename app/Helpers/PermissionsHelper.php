<?php

namespace App\Helpers;

class PermissionsHelper
{
  public static function highestRoleCompare($user, $target)
  {
    return $user->roles->sortByDesc('priority')->first()->priority > $target->roles->sortByDesc('priority')->first()->priority;
  }
}
