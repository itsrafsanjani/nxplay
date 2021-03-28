# NXPlay

NXPlay is an open source streaming entertainment service created with Laravel.
> Don't forget to give a star! ⭐

### Packages Used

1. `laravel/ui`
2. `laravel/socialite`
3. `tymon/jwt-auth`
4. `barryvdh/laravel-debugbar`
5. `barryvdh/laravel-ide-helper`
6. `beyondcode/laravel-query-detector`
7. `pusher/pusher-php-server`
8. `laravel-notification-channels/pusher-push-notifications`

### Installation Instructions

- Clone the repo.

```shell
    cd nxplay
    
    composer install
    
    cp .env.example .env / php -r "file_exists('.env') || copy('.env.example', '.env');"
    
    php artisan key:generate --ansi
    
    mysql -uroot
    
    create database nxplay;
```    

- edit `.env` file

```shell
    php artisan migrate --seed
    
    npm install && npm run dev
```

### Contributing

Thank you for considering contributing to the NXPlay!

### Contribution Guideline

- Fork the repo.
- Clone the repo.
- Run `git checkout dev`
- Create a new local branch
- Work on your local branch
- Push to remote
- When work tested, done or ready, push to remote
- Merge to dev

### License

The NXPlay is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
