<?php

return [
  App\Providers\AppServiceProvider::class,
  App\Providers\AuthServiceProvider::class,
  App\Providers\EventServiceProvider::class,
  App\Providers\FortifyServiceProvider::class,
  App\Providers\JetstreamServiceProvider::class,
  App\Providers\MenuServiceProvider::class,
  App\Providers\RouteServiceProvider::class,
  SocialiteProviders\Manager\ServiceProvider::class,
  Spatie\Permission\PermissionServiceProvider::class,
  Barryvdh\Debugbar\ServiceProvider::class,
];
