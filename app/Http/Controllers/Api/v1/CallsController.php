<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\CallRequest;
use Library\Repositories\CallRepositoryInterface;
use Library\Transformers\CallTransformer;
use Sorskod\Larasponse\Larasponse;

class CallsController extends ApiController
{
	/**
	 * @var CallRepositoryInterface
	 */
	protected $call;

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
	 * @param CallRepositoryInterface $call
	 */
	public function __construct(Larasponse $response, CallRepositoryInterface $call)
	{
		$this->call = $call;

		$this->response = $response;

		// TODO put in extended class
		$this->resourceKey = 'calls';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		return $this->response->paginatedCollection($this->call->paginate(), new CallTransformer(), $this->resourceKey);
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

		return $this->response->collection([$call], new CallTransformer(), $this->resourceKey);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CallRequest $request
	 * @return mixed
	 */
	public function store(CallRequest $request)
	{
		return $this->response->collection([$this->call->store($request)], new CallTransformer(), $this->resourceKey);
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
		return $this->response->collection([$this->call->update($request, $id)], new CallTransformer(), $this->resourceKey);
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
		return $this->call->destroy($id);
	}

}
