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
	 * @var string
	 */
	protected $resourceKey;

	/**
	 * @param Larasponse $response
	 * @param CompanyRepositoryInterface $company
	 */
	public function __construct(Larasponse $response, CompanyRepositoryInterface $company)
	{
		$this->company = $company;

		$this->response = $response;

		// TODO put in extended class
		$this->resourceKey = 'companies';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		return $this->response->paginatedCollection($this->company->paginate(), new CompanyTransformer(), $this->resourceKey);
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

		return $this->response->collection([$company], new CompanyTransformer(), $this->resourceKey);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CompanyRequest $request
	 * @return mixed
	 */
	public function store(CompanyRequest $request)
	{
		return $this->response->collection([$this->company->store($request)], new CompanyTransformer(), $this->resourceKey);
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
		return $this->response->collection([$this->company->update($request, $id)], new CompanyTransformer(), $this->resourceKey);
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
