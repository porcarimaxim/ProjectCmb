<?php namespace Library\Repositories;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
	protected $model;

	/**
	 * @throws \Exception
	 */
	public function __construct()
	{
		parent::__construct();

		if (!$this->model instanceof Model) {
			throw new \Exception("Model is not valid");
		}
	}

	public function getAll()
	{
		return $this->model->all();
	}

	public function find($id)
	{
		return $this->model->find($id);
	}

	public function store(Request $request)
	{
		return $this->model->create($request->all());
	}

	public function update(Request $request, $id)
	{
		return $this->model->updateOrCreate(['id' => $id], $request->all());
	}

	public function destroy($id)
	{
		return $this->model->destroy($id);
	}

	public function paginate()
	{
		return $this->model->paginate();
	}
}