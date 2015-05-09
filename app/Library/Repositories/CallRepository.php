<?php namespace Library\Repositories;

use App\Http\Requests\Request;
use App\Models\Call;

class CallRepository implements CallRepositoryInterface
{

	/**
	 * @return mixed
	 */
	public function getAll()
	{
		return Call::all();
	}

	public function find($id)
	{
		return Call::findOrFail($id);
	}

	public function store(Request $request)
	{
		return Call::create($request->all());
	}

	public function update(Request $request, $id)
	{
		return Call::updateOrCreate($request->all());
	}

	public function destroy($id)
	{
		return Call::destroy($id);
	}
}