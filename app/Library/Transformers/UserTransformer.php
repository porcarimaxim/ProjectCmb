<?php namespace Library\Transformers;

use App\Library\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	/**
	 * @param User $user
	 * @return array
	 */
	public function transform(User $user)
	{
		// TODO update transformer
		return [
			'id' => (int)$user['id'],
			'firstName' => $user['first_name'],
			'lastName' => $user['last_name'],
			'email' => $user['email']
		];
	}

}