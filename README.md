# Restaurant Butler API

The application runs on top of Laravel 9, PHP 8.2 and MySql 8.0.

### Running the API locally with Sail and Docker (macOS and Linux)

Make sure [Docker Desktop](https://www.docker.com/products/docker-desktop/) is installed and clone the project to your local machine. Once you have it, navigate to the project directory, run composer and start [Laravel Sail](https://laravel.com/docs/10.x/sail).

```
git clone git@github.com:foodics/restaurant-butler-api.git foodics-restaurant-butler-api

cd foodics-restaurant-butler-api

cp .env.example .env

composer install

./vendor/bin/sail up
```

At this point you should have a running API and be able to start developing.

The first time the MySQL container starts, it will create two databases. One is called `tenant` and is there to support your local development. The other two are dedicated testing databases named `admin_testing`, `tenant_testing` and will ensure that your tests do not interfere with your development data.

Please refer to [Laravel Sail](https://laravel.com/docs/10.x/sail) documentation to learn more about how to interact with the application artisan commands, database, tests, etc. 
