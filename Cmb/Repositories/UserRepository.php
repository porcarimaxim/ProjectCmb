<?php namespace Cmb\Repositories;

use App\Http\Requests\Request;
use App\User;

class UserRepository implements UserRepositoryInterface
{

	/**
	 * @return mixed
	 */
	public function getAll()
	{
		return User::all();
	}

	public function find($id)
	{
		return User::findOrFail($id);
	}

	public function store(Request $request)
	{
		return User::create($request->all());
	}

	public function update($id, Request $request)
	{
		return User::updateOrCreate($request->all());
	}
}