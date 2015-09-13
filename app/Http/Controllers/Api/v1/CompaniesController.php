<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\CompanyRequest;
use App\Library\RepositoriesInterface\CompanyInterface;
use App\Library\Transformers\CompanyTransformer;
use Sorskod\Larasponse\Larasponse;

class CompaniesController extends ApiController {

	/**
	 * @var CompanyInterface
	 */
	protected $company;

	/**
	 * @var Larasponse
	 */
	protected $fractal;

	/**
	 * @param Larasponse $fractal
	 * @param CompanyInterface $company
	 */
	public function __construct(Larasponse $fractal, CompanyInterface $company)
	{
		parent::__construct();

		$this->setResourceKey('companies');

		$this->company = $company;

		$this->fractal = $fractal;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		$companies = $this->company->paginate();
		return $this->fractal->paginatedCollection($companies, new CompanyTransformer(), $this->getResourceKey());
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

		return $this->fractal->collection([$company], new CompanyTransformer(), $this->getResourceKey());
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
		return $this->fractal->collection([$company], new CompanyTransformer(), $this->getResourceKey());
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
		return $this->fractal->collection([$company], new CompanyTransformer(), $this->getResourceKey());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function destroy($id)
	{
		$success = $this->company->destroy($id);
		if (!$success) {
			return $this->respondNotFound();
		}

		return $this->respondDestroy($id);
	}

}
