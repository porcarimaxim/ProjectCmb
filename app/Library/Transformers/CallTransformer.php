<?php namespace App\Library\Transformers;

use App\Library\Models\Call;
use League\Fractal\TransformerAbstract;

class CallTransformer extends TransformerAbstract
{
	/**
	 * @param Call $call
	 * @return array
	 */
	public function transform(Call $call)
	{
		return [
			'id' => $call['id'],
			'company_id' => $call['company_id'],
			'user_id' => $call['user_id'],
			'number' => $call['number'],
			'timer' => $call['timer'],
			'description' => $call['description'],
			'status' => $call['status'],
			'updated_at' => $call['updated_at'],
			'created_at' => $call['created_at'],

			'user' => $call->user
		];
	}

}