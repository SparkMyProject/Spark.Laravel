<?php

if (!function_exists('test')) {
  function test(): string
  {
    return 'hello';
  }
}

if (!function_exists('backpack_authentication_secondary_enabled')) {
  function backpack_authentication_secondary_enabled(): bool
  {
    return config('backpack.base.authentication_secondary_enabled', false);
  }
}

if (! function_exists('backpack_authentication_secondary_column')) {
  function backpack_authentication_secondary_column()
  {
    return config('backpack.base.authentication_secondary_column', 'email');
  }
}

if (! function_exists('backpack_authentication_validation')) {
  function backpack_authentication_validation()
  {
    return config('backpack.base.authentication_validation');
  }
}

if (! function_exists('backpack_authentication_secondary_validation')) {
  function backpack_authentication_secondary_validation()
  {
    return config('backpack.base.authentication_secondary_validation');
  }
}
