<?php

namespace App\Http\Controllers\Widget;

use App\Library\Repositories\CompanyRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WidgetController extends Controller
{
	public function __construct()
	{
		$this->middleware('api.key');
		$this->middleware('auth.basic.once');
		$this->middleware('auth');
	}

	public function setup( CompanyRepository $companyRepository )
	{
		$companyId = Auth::user()->company_id;
		$company = $companyRepository->find( $companyId );
		$firebaseAccount = $company->firebaseAccounts()->first();

		return [
			'firebase' => [
				"account" => $firebaseAccount->account,
				"root" => $company->firebase_key
			]
		];
	}
}
