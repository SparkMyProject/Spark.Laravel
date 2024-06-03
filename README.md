<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<a href="https://wakatime.com/badge/user/6036bffc-0f57-4851-9af7-e93443368bc2/project/474936ec-85a8-45f9-9132-8c253a1f48ff"><img src="https://wakatime.com/badge/user/6036bffc-0f57-4851-9af7-e93443368bc2/project/474936ec-85a8-45f9-9132-8c253a1f48ff.svg" alt="wakatime"></a>
</p>

## About Spark.Laravel
Spark.Laravel is a Laravel boilerplate that provides many features for your next project.

## Features
- Newest Laravel version, 11.x
- Scaffolding with Laravel Jetstream
- Built-in authentication system with 2-factor authentication
- Discord OAuth2 integration
- User roles and permissions from Spatie/Laravel-Permission
- User profile management
- User avatar upload and Discord avatar sync
- Custom Fortify and Jetstream routes
- Built-in administrative user management
- Built-in administrative role management
- Built-in administrative permission management
- Laravel Pulse integration


## Creating/Updating Themes
To update a theme and allow users to select them, do the following:
- Create the files "theme-[NAME].scss" and "theme-[NAME]-dark.scss" in the resources/assets/vendor/scss directory
- Do NOT include the dark version when listing the themes. The light/dark mode system is separate.
- Update the "theme-customizer.js" file in the resources/assets/vendor/js directory to include the new theme (around line 1214)
- Update the "helpers.php" file in the app/Helpers directory to include the new theme (line 51)
- Update the "scriptsIncludes.blade.php" in the resources/views/layouts/sections directory to include the new theme (line 34). The theme names must have "theme-" removed 
  from the name. For example, "theme-default" is "default".

- For organizational purposes, comment in the new options in the "custom.php" file in the config folder.
## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
