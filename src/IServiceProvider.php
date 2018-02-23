<?php
namespace steamegg\Slim\ServiceProvider;

interface IServiceProvider {
	static function register($container);
	static function boot($container);
}
