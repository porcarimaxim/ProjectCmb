<?php namespace App\Library\Repositories;

use App\Library\Models\UserStatus;
use App\Library\RepositoriesInterface\UserStatusInterface;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Queue;
use App\Commands\SendFirebase;

class UserStatusRepository extends Repository implements UserStatusInterface
{
	public function getModel()
	{
		return new UserStatus;
	}

	public function update(Request $request, $id) {
		/**
		 * @var object $model
		 */
		$model = parent::update($request, $id);

		Queue::push(new SendFirebase(['model' => $model->toArray(), 'type' => 'UserStatus']));

		return $model;
	}
}