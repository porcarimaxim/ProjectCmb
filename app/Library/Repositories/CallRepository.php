<?php namespace App\Library\Repositories;

use App\Library\Models\Call;
use App\Library\RepositoriesInterface\CallInterface;

class CallRepository extends Repository implements CallInterface
{
	public function getModel()
	{
		return new Call;
	}
}