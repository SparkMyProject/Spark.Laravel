<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\HorizonServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    Barryvdh\Debugbar\ServiceProvider::class,
    SocialiteProviders\Manager\ServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];
