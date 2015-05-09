<?php namespace Library\Repositories;

use App\Library\Models\Call;

class CallRepository extends Repository implements CallRepositoryInterface
{
	public function __construct()
	{
		$this->model = new Call;
	}
}