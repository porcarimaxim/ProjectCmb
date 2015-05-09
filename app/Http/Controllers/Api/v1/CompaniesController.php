<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CompanyRequest;
use Library\Repositories\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompaniesController extends Controller {

	/**
	 * @var CompanyRepositoryInterface
	 */
	protected $company;

	/**
	 * @param CompanyRepositoryInterface $company
	 */
	public function __construct(CompanyRepositoryInterface $company)
	{
		$this->company = $company;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->company->getAll();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CompanyRequest $request
	 * @return Response
	 */
	public function store(CompanyRequest $request)
	{
		return $this->company->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->company->find($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param CompanyRequest $request
	 * @return Response
	 */
	public function update(CompanyRequest $request, $id)
	{
		return $this->company->update($request, $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->company->destroy($id);
	}

}
