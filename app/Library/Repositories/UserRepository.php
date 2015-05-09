<?php namespace Library\Repositories;

use App\Library\Models\User;

class UserRepository extends Repository implements UserRepositoryInterface
{
	public function __construct()
	{
		$this->model = new User;
	}
}