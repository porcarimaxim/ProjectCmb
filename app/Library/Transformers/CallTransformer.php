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
		// TODO update transformer
		return [
			'id' => (int)$call['id'],
			'number' => $call['number']
		];
	}

}