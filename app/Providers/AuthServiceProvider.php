<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any application authentication / authorization services.
	 *
	 * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
	 * @return void
	 */
	public function boot(GateContract $gate)
	{
		parent::registerPolicies($gate);

		// basic permissions
		$gate->define('view', 'App\Policies\BasePolicy@view');
		$gate->define('update', 'App\Policies\BasePolicy@update');
		$gate->define('delete', 'App\Policies\BasePolicy@delete');
		$gate->define('store', 'App\Policies\BasePolicy@store');
	}
}
