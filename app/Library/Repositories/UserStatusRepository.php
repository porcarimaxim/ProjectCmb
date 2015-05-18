<?php namespace App\Library\Repositories;

use App\Library\Models\UserStatus;
use App\Library\RepositoriesInterface\UserStatusInterface;

class UserStatusRepository extends Repository implements UserStatusInterface
{
	public function getModel()
	{
		return new UserStatus;
	}
}