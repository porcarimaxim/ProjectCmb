<?php namespace App\Library\RepositoriesInterface;

use App\Library\Models\User;

interface UserInterface extends ApiInterface
{
	public function setOptions(User $user, $options);
}