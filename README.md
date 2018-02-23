# Slim-ServiceProvider

## Requirements

* PHP > 5.5.0

## Installation

Library is not registered in packagist yet.

> Add github repositories to composer.json

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/steamegg/Slim-ServiceProvider.git"}
    ],
    "require": {
        "steamegg/Slim-ServiceProvider": "dev-develop"
    }
}
```

## How to use

> Register middleware, slimApp/src/middleware.php
```php
use steamegg\Slim\ServiceProvider\ServiceProviderMiddleware;

$app->add(ServiceProviderMiddleware::class);
```

> Create service provider class
```php
use steamegg\Slim\ServiceProvider\IServiceProvider;

class DatabaseProvider implements IServiceProvider {
	static function register($container){
		$container["database"] = function($c){
			return mysqli_connect("localhost");
		}
	}
	
	static function boot($container){}
}
```

> Register service providers, slimApp/src/dependencies.php
```php
use steamegg\Slim\ServiceProvider\ServiceProviderMiddleware;

$container[ServiceProviderMiddleware::KEY_SERVICE_PROVIDER] = function(){
	return [
		DatabaseProvider::class
	];
};
```