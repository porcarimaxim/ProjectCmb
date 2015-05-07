<?php namespace Cmb\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider{

	public function register()
	{

		$this->app->bind(
			'Cmb\Repositories\UserRepositoryInterface',
			'Cmb\Repositories\UserRepository'
		);

	}
}