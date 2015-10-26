<?php namespace App\Library\Transformers;

use App\Library\Models\User;
use League\Fractal\TransformerAbstract;
use App\Library\Transformers\UserStatusTransformer;

class UserTransformer extends TransformerAbstract
{
	/**
	 * @param User $user
	 * @return array
	 */
	public function transform(User $user)
	{
		$options = is_array( $user['options'] ) ? $user['options'] : [] ;
		if( ! isset( $options['is_available'] ) ) {
			$options['is_available'] = false;
		}
		return [
			'id' => $user['id'],
			'company_id' => $user['company_id'],
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'updated_at' => $user['updated_at'],
			'created_at' => $user['created_at'],
			'options' => $options
		];
	}
}