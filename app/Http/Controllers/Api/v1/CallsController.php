<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\CallRequest;
use App\Library\RepositoriesInterface\CallInterface;
use App\Library\Transformers\CallTransformer;
use Sorskod\Larasponse\Larasponse;

class CallsController extends ApiController
{
	/**
	 * @var CallInterface
	 */
	protected $call;

	/**
	 * @var Larasponse
	 */
	protected $fractal;

	/**
	 * @param Larasponse $fractal
	 * @param CallInterface $call
	 */
	public function __construct(Larasponse $fractal, CallInterface $call)
	{
		$this->setResourceKey('calls');

		$this->call = $call;

		$this->fractal = $fractal;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		$calls = $this->call->paginate();
		return $this->fractal->paginatedCollection($calls, new CallTransformer(), $this->getResourceKey());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function show($id)
	{
		$call = $this->call->find($id);
		if (!$call) {
			return $this->respondNotFound();
		}

		return $this->fractal->collection([$call], new CallTransformer(), $this->getResourceKey());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CallRequest $request
	 * @return mixed
	 */
	public function store(CallRequest $request)
	{
		$call = $this->call->store($request);
		return $this->fractal->collection([$call], new CallTransformer(), $this->getResourceKey());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param CallRequest $request
	 * @return mixed
	 */
	public function update(CallRequest $request, $id)
	{
		$call = $this->call->update($request, $id);
		return $this->fractal->collection([$call], new CallTransformer(), $this->getResourceKey());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function destroy($id)
	{
		$success = $this->call->destroy($id);
		if (!$success) {
			return $this->respondNotFound();
		}

		return $this->respondDestroy($id);
	}

}
