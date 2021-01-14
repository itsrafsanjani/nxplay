## NXPlay

NXPlay is an open source streaming entertainment service created with Laravel.

## Packages Used
- 1. `laravel/ui`
- 2. `laravel/socialite`
- 3. `google/apiclient`
- 4. `tymon/jwt-auth`
- 5. `tymon/jwt-auth`
- 6. `barryvdh/laravel-debugbar`

## Installation Instructions

- Clone the repo.
- Run `cd nxplay`
- Run `composer install`
- Run `php -r "file_exists('.env') || copy('.env.example', '.env');"`
- Run `php artisan key:generate --ansi`
- Run `mysql -uroot`
- Run `create database nxplay;`
- Edit `.env` file
- Run `php artisan migrate --seed`
- Run `npm install && npm run dev`

## Contributing

Thank you for considering contributing to the NXPlay!

## Contribution Guideline

- Fork the repo.
- Clone the repo.
- Run `git checkout dev`
- Create a new local branch
- Work on your local branch
- Push to remote
- When work tested, done or ready, push to remote
- Merge to dev

## License

The NXPlay is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
