<?php namespace App\Library\Repositories;

use App\Http\Requests\Request;

abstract class Repository
{
	protected $model;


	/**
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	abstract function getModel();

	public function getAll()
	{
		return $this->getModel()->all();
	}

	public function find($id)
	{
		return $this->getModel()->find($id);
	}

	public function store(Request $request)
	{
		return $this->getModel()->create($request->all());
	}

	public function update(Request $request, $id)
	{
		return $this->getModel()->updateOrCreate(['id' => $id], $request->all());
	}

	public function destroy($id)
	{
		return $this->getModel()->destroy($id);
	}

	public function paginate()
	{
		return $this->getModel()->paginate();
	}
}