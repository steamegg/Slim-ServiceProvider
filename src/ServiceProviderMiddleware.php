<?php
namespace steamegg\Slim\ServiceProvider;

class ServiceProviderMiddleware {
	const KEY_SERVICE_PROVIDER = "ServiceProviders";
	
	protected $container;
	
	function __construct($container){
		$this->container = $container;
	}
	
	function __invoke($request, $response, callable $next){
		$this->registerProviders();
		
		$this->bootProviders();
		
		return $next($request, $response);
	}
	
	protected function registerProviders(){
		foreach($this->container->get(self::KEY_SERVICE_PROVIDER) as $serviceProvider)
		{
			$serviceProvider::register($this->container);
		}
	}
	
	protected function bootProviders(){
		foreach($this->container->get(self::KEY_SERVICE_PROVIDER) as $serviceProvider)
		{
			$serviceProvider::boot($this->container);
		}
	}
}
