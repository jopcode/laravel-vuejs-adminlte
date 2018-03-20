# Laravel, Vuejs & AdminLTE

Boilerplate for Laravel, Vuejs & AdminLTE

The main goal for this project was to create a single page application (SPA) for the administration area with Vuejs and AdminLTE.

If you have a better idea for the setup please let me know :)

## Features
- Implemented OAuth2 with token refresh
- Simple project structure divided for admin and front
- AdminLTE split to partials and converted to Vuejs components
- Simple edit profile page with profile picture upload

## Setup
- Clonde or download this repository `git clone https://github.com/vstruhar/laravel-vuejs-adminlte.git`
- cd into the project folder and run `composer install`
- Run `php artisan key:generate`
- Copy .env.example and save it as .env, or just run `cp .env.example .env`
- Change your database credentials
- Now run `php artisan migrate`
- Then run `php artisan passport:install` to setup Passport (OAuth2)
- Run `php artisan storage:link` to create a symbolic link from the public folder to resources where the profile pictures are uploaded.
- Run seeder to create admin user with roles and permissions `php artisan db:seed --class=InitSetupSeeder`
- Next run `npm install` to install Laravel mix and all npm dependencies
- Now open `/resources/assets/js/admin/env.js` and change `client_secret` to value that is stored in oauth_clients table in the secret column under the ID 2
- And now run `npm run dev` to build Vuejs app or `npm run hot` to use hot reload
- Goto /admin and login with `admin@mail.com / password`
