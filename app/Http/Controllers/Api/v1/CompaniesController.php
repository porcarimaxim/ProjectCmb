<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\CompanyRequest;
use Library\Repositories\CompanyRepositoryInterface;
use Library\Transformers\CompanyTransformer;
use Sorskod\Larasponse\Larasponse;

class CompaniesController extends ApiController {

	/**
	 * @var CompanyRepositoryInterface
	 */
	protected $company;

	/**
	 * @var Larasponse
	 */
	protected $response;

	/**
	 * @param Larasponse $response
	 * @param CompanyRepositoryInterface $company
	 */
	public function __construct(Larasponse $response, CompanyRepositoryInterface $company)
	{
		$this->setResourceKey('companies');

		$this->company = $company;

		$this->response = $response;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		$companies = $this->company->paginate();
		return $this->response->paginatedCollection($companies, new CompanyTransformer(), $this->getResourceKey());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function show($id)
	{
		$company = $this->company->find($id);
		if (!$company) {
			return $this->respondNotFound();
		}

		return $this->response->collection([$company], new CompanyTransformer(), $this->getResourceKey());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CompanyRequest $request
	 * @return mixed
	 */
	public function store(CompanyRequest $request)
	{
		$company = $this->company->store($request);
		return $this->response->collection([$company], new CompanyTransformer(), $this->getResourceKey());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param CompanyRequest $request
	 * @return mixed
	 */
	public function update(CompanyRequest $request, $id)
	{
		$company = $this->company->update($request, $id);
		return $this->response->collection([$company], new CompanyTransformer(), $this->getResourceKey());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function destroy($id)
	{
		// TODO implement destroy response
		return $this->company->destroy($id);
	}

}
