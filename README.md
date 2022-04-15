

## Rubik's Cube rotation api

Installation and Run

- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

Request

default host: localhost:8000

- @get {host}/api/cube/
- @get {host}/api/cube/initial
- @post {host}/api/cube/rotate

Rotation request data example

{
    
    "side": "U",
    "direction": "horizontal",
}


Run Unit Test

- php artisan test
