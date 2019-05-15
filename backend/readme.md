# Backend Setup

``` 
cd backend
```

## Install Steps

##### Install dependencies :

``` 
composer install
```
#### Copy .env.example to .env
``` 
cp .env.example .env
```
##### Generate app key: 
```
php artisan key:generate 
```
##### Generate jwt secret: 
``` 
php artisan jwt:secret
```

##Project launch

#### Create database with utf8_general_ci encoding :
``` 
CREATE DATABASE web-coding CHARACTER SET utf8 COLLATE utf8_general_ci;
```

#### Run Migrations :

``` 
php artisan migrate
```
#### Run Seeders:

``` 
php artisan db:seed
```
## Used technologies
- [Laravel 5.8+](https://laravel.com/docs/5.8)

## Used packages: 
- [jwt-auth 1.0](https://github.com/tymondesigns/jwt-auth)


