<?php namespace Library\Repositories;

use App\Http\Requests\Request;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{

	/**
	 * @return mixed
	 */
	public function getAll()
	{
		return Company::all();
	}

	public function find($id)
	{
		return Company::findOrFail($id);
	}

	public function store(Request $request)
	{
		return Company::create($request->all());
	}

	public function update(Request $request, $id)
	{
		return Company::updateOrCreate($request->all());
	}

	public function destroy($id)
	{
		return Company::destroy($id);
	}
}