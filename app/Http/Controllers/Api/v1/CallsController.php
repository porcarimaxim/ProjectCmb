<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\CallRequest;
use App\Library\RepositoriesInterface\CallInterface;
use App\Library\Transformers\CallTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
	 * @param Guard $auth
	 */
	public function __construct(Larasponse $fractal, CallInterface $call)
	{
		parent::__construct();

		$this->insertMiddleware('api.key', 0, ['only' => 'store']);

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
		$user = Auth::user();
		$filters = ['company_id' => $user->company_id];
		$calls = $this->call->paginate($filters);
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

		if (Gate::denies('view', $call)) {
			return $this->respondForbidden();
		};

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
		$user = Auth::user();

		if (Gate::denies('store')) {
			return $this->respondForbidden();
		};

		$request->merge([
			'company_id' => $user->company_id,
			'user_id' => null
		]);

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
		$user = Auth::user();
		$request->merge([
			'company_id' => $user->company_id,
			'user_id' => $user->id
		]);

		$call = $this->call->find($id);

		if (!$call) {
			return $this->respondNotFound();
		}

		if (Gate::denies('update', $call)) {
			return $this->respondForbidden();
		};

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
		$call = $this->call->find($id);

		if (!$call) {
			return $this->respondNotFound();
		}

		if (Gate::denies('delete', $call)) {
			return $this->respondForbidden();
		};

		$success = $this->call->destroy($id);

		if (!$success) {
			return $this->respondNotFound();
		}

		return $this->respondDestroy($id);
	}

}
