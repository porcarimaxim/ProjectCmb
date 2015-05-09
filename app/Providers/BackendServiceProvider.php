<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider{

	public function register()
	{

		$this->app->bind(
			'Library\Repositories\UserRepositoryInterface',
			'Library\Repositories\UserRepository'
		);

		$this->app->bind(
			'Library\Repositories\CompanyRepositoryInterface',
			'Library\Repositories\CompanyRepository'
		);

		$this->app->bind(
			'Library\Repositories\CallRepositoryInterface',
			'Library\Repositories\CallRepository'
		);

	}
}