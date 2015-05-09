<?php namespace Library\Repositories;

use App\Http\Requests\Request;
use App\Models\User;

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

	public function update(Request $request, $id)
	{
		return User::updateOrCreate($request->all());
	}

	public function destroy($id)
	{
		return User::destroy($id);
	}
}