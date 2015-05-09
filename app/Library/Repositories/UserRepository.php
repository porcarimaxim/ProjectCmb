<?php namespace App\Library\Repositories;

use App\Library\Models\User;
use App\Library\RepositoriesInterface\UserInterface;

class UserRepository extends Repository implements UserInterface
{
	public function getModel()
	{
		return new User;
	}
}