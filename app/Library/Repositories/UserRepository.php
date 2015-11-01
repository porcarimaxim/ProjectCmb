<?php namespace App\Library\Repositories;

use App\Http\Requests\Request;
use App\Jobs\SendFirebase;
use App\Library\Models\User;
use App\Library\RepositoriesInterface\UserInterface;
use Illuminate\Support\Facades\Queue;

class UserRepository extends Repository implements UserInterface
{
	public function getModel()
	{
		return new User;
	}

	public function update(Request $request, $id)
	{
		$user = parent::update($request, $id);
		$user = $this->setOptions($user, $request->get('options'));

		Queue::push(new SendFirebase(['model' => $user, 'type' => 'User']));

		return $user;
	}

	/**
	 * @param User $user
	 * @param array $options
	 * @return User
	 */
	public function setOptions(User $user, $options)
	{
		if ($options) {
			$optionsData = $user->options;
			foreach ($options as $key => $value) {
				if (in_array($key, $user->castAttr)) {
					$optionsData[$key] = $value;
				}
			}
			$user->options = $optionsData;
			$user->save();
			return $user;
		}
		return $user;
	}

	public function getAvailableUsers()
	{
		return $this->getModel()->whereRaw("options->>'is_available' = 'true'")->count();
	}
}