<?php

namespace App\Policies;

use App\Library\Models\User;

class BasePolicy
{

	public function update(User $user, $resource)
	{
		return $user->company_id === $resource->company_id;
	}

	public function view(User $user, $resource)
	{
		return $user->company_id === $resource->company_id;
	}

	public function delete(User $user, $resource)
	{
		return $user->company_id === $resource->company_id;
	}

	public function store(User $user)
	{
		return true;
	}
}
