<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\UserStatusRequest;
use App\Library\RepositoriesInterface\UserStatusInterface;
use App\Library\Transformers\UserStatusTransformer;
use Sorskod\Larasponse\Larasponse;

class UserStatusesController extends ApiController
{
	/**
	 * @var UserStatusInterface
	 */
	protected $status;

	/**
	 * @var Larasponse
	 */
	protected $fractal;

	/**
	 * @param Larasponse $fractal
	 * @param UserStatusInterface $status
	 */
	public function __construct(Larasponse $fractal, UserStatusInterface $status)
	{
		$this->setResourceKey('statuses');

		$this->status = $status;

		$this->fractal = $fractal;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		$statuses = $this->status->paginate();
		return $this->fractal->paginatedCollection($statuses, new UserStatusTransformer(), $this->getResourceKey());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function show($id)
	{
		$status = $this->status->find($id);
		if (!$status) {
			return $this->respondNotFound();
		}

		return $this->fractal->collection([$status], new UserStatusTransformer(), $this->getResourceKey());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UserStatusRequest $request
	 * @return mixed
	 */
	public function store(UserStatusRequest $request)
	{
		$status = $this->status->store($request);
		return $this->fractal->collection([$status], new UserStatusTransformer(), $this->getResourceKey());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param UserStatusRequest $request
	 * @return mixed
	 */
	public function update(UserStatusRequest $request, $id)
	{
		$status = $this->status->update($request, $id);
		return $this->fractal->collection([$status], new UserStatusTransformer(), $this->getResourceKey());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function destroy($id)
	{
		$success = $this->status->destroy($id);
		if (!$success) {
			return $this->respondNotFound();
		}

		return $this->respondDestroy($id);
	}

}
