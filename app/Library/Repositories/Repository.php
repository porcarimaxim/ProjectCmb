<?php namespace App\Library\Repositories;

use App\Commands\SendPusher;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Queue;

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
		$model = $this->getModel()->create($request->all());
		Queue::push(new SendPusher(['model' => $model->toArray(), 'action_type' => 'store']));

		return $model;
	}

	public function update(Request $request, $id)
	{
		$model = $this->getModel()->updateOrCreate(['id' => $id], $request->all());
		Queue::push(new SendPusher(['model' => $model->toArray(), 'action_type' => 'update']));

		return $model;
	}

	public function destroy($id)
	{
		if ($result = $this->getModel()->destroy($id))
			Queue::push(new SendPusher(['model' => ['id' => $id], 'action_type' => 'destroy']));

		return $result;
	}

	public function paginate()
	{
		return $this->getModel()->paginate();
	}
}