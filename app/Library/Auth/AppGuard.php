<?php namespace App\Library\Auth;

use App\Library\Models\User;
use App\Library\Repositories\CompanyRepository;
use Illuminate\Auth\Guard;
use Symfony\Component\HttpFoundation\Response;

class AppGuard extends Guard
{

	private function createAnonymousUser($companyId)
	{
		$user = new User();
		$user->id = 'anonymous';
		$user->fist_name = 'anonymous';
		$user->last_name = 'anonymous';
		$user->email = 'anonymous';
		$user->company_id = $companyId;
		return $user;
	}

	public function key($apiKey)
	{
		$companyRepository = new CompanyRepository;
		$company = $companyRepository->getByApiKey($apiKey);

		if ($company) {
			$user = $this->createAnonymousUser($company->id);
			$this->setUser($user);
			return true;
		}
		return false;
	}

	public function onceKey($apiKey)
	{
		if (!$this->key($apiKey)) {
			return new Response('Invalid credentials.', 401, []);
		}
	}

}