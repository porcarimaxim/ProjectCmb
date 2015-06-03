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
			'id' => $userStatus['id'],
			'is_available' => $userStatus['is_available']
		];
	}
}