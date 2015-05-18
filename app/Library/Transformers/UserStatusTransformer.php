<?php namespace App\Library\Transformers;

use App\Library\Models\UserStatus;
use League\Fractal\TransformerAbstract;

class UserStatusTransformer extends TransformerAbstract
{
	/**
	 * @param UserStatus $userStatus
	 * @return array
	 */
	public function transform(UserStatus $userStatus)
	{
		return [
			'id' => (int)$userStatus['id'],
			'company_id' => (int)$userStatus['company_id'],
			'user_id' => (int)$userStatus['user_id'],
			'is_available' => (bool)$userStatus['is_available']
		];
	}

}