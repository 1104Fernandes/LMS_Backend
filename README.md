# IT Awareness Backend 

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

This Application is developed for the HMDISS. Is has been developed with PHP and the Framework Laravel/Lumen. The application provides a RESTfull API based on Lumen. 

## Installation
### Requiments
- PHP
- Composer
- Artisan

Go the the root folder and type following command:
```sh
composer install
cd public
php -S localhost:4000
``` 

## Structure
The Application uses the Controller/Modell Schema. Each table has a Model implemented which represetents the table. Each model have also a controller class. The task of a controller class is to deliver data. Each controller method has a own route.

### Path of Controller, Models, Routes
#### Controller
``` 
/app/Http/Controller
```

#### Models
``` 
/app/Models
```

#### Routes
``` 
/routes/web.php
```

## Usage of RESTfull service

### User
<ins>Register</ins><br>
To register a User. You have to make a post to /auth/regsister
```json
    "nickname":"foo",
    "password":"foo2",
    "difficult_id":"2"
``` 

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
