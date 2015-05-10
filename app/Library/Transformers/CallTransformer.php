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
			'id' => (int)$call['id'],
			'company_id' => (int)$call['company_id'],
			'user_id' => (int)$call['user_id'],
			'number' => $call['number'],
			'timer' => (int)$call['timer'],
			'description' => (int)$call['description'],
			'status' => (int)$call['status'],
			'updated_at' => $call['updated_at'],
			'created_at' => $call['created_at']
		];
	}

}