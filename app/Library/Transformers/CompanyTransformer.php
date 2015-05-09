<?php namespace App\Library\Transformers;

use App\Library\Models\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
{
	/**
	 * @param Company $company
	 * @return array
	 */
	public function transform(Company $company)
	{
		return [
			'id' => (int)$company['id'],
			'name' => $company['name']
		];
	}

}