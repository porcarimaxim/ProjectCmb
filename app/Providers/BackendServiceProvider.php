<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider{

	public function register()
	{

		$this->app->bind(
			'App\Library\RepositoriesInterface\UserInterface',
			'App\Library\Repositories\UserRepository'
		);

		$this->app->bind(
			'App\Library\RepositoriesInterface\CompanyInterface',
			'App\Library\Repositories\CompanyRepository'
		);

		$this->app->bind(
			'App\Library\RepositoriesInterface\CallInterface',
			'App\Library\Repositories\CallRepository'
		);

	}
}