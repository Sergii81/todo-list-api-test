 - laravel 10.10
 - php 8.1
## Installation

- git clone https://github.com/Sergii81/todo-list-api-test.git
- composer install
- set db credentials in .env
  - DB_CONNECTION=mysql
  - DB_HOST=host.docker.internal
  - DB_PORT=3306
  - DB_DATABASE=db_base_name
  - DB_USERNAME=db_user_name
  - DB_PASSWORD=db_password
- docker-compose up -d
- sudo chmod -R 777 storage
- docker-compose exec sh
    - php artisan migrate
    - php artisan db:seed
- api url http://localhost:8989/api/v1/


## Documentation

- http://localhost:8989/api/documentation

## How to use

1. POST http://localhost:8989/api/v1/login

       {
           "email" : "test1@example.com",
           "password" : "password"
       }
   - response

         {
             "status": true,
             "message": "User Logged In Successfully",
             "token": "1|CdFUyTDmUkUvX2sHyhVP1CBMacse12cgsGUoSVpY7e7ff088"
         }

2. Set Authorization
   
            Authorization: Bearer 1|CdFUyTDmUkUvX2sHyhVP1CBMacse12cgsGUoSVpY7e7ff088
