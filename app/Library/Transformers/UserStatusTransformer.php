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
		return $userStatus;
	}
}