<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\UserRequest;
use App\Library\RepositoriesInterface\UserInterface;
use App\Library\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Sorskod\Larasponse\Larasponse;

class UsersController extends ApiController
{
	/**
	 * @var UserInterface
	 */
	protected $user;

	/**
	 * @var Larasponse
	 */
	protected $fractal;

	/**
	 * @param Larasponse $fractal
	 * @param UserInterface $user
	 * @param Guard $auth
	 */
	public function __construct(Larasponse $fractal, UserInterface $user )
	{
		parent::__construct();

		$this->setResourceKey('users');

		$this->user = $user;

		$this->fractal = $fractal;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		$currentUser = Auth::user();
		$filters = ['company_id' => $currentUser->company_id];
		$users = $this->user->paginate($filters);
		return $this->fractal->paginatedCollection($users, new UserTransformer, $this->getResourceKey());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function show($id)
	{
		$user = $this->user->find($id);

		if (!$user) {
			return $this->respondNotFound();
		}

		if (Gate::denies('view', $user)) {
			return $this->respondForbidden();
		};

		return $this->fractal->collection([$user], new UserTransformer, $this->getResourceKey());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UserRequest $request
	 * @return mixed
	 */
	public function store(UserRequest $request)
	{
		$currentUser = Auth::user();

		if (Gate::denies('store')) {
			return $this->respondForbidden();
		};

		$request->merge([
			'company_id' => $currentUser->company_id
		]);

		$user = $this->user->store($request);
		return $this->fractal->collection([$user], new UserTransformer, $this->getResourceKey());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param UserRequest $request
	 * @return mixed
	 */
	public function update(UserRequest $request, $id)
	{
		$currentUser = Auth::user();
		$request->merge([
			'company_id' => $currentUser->company_id
		]);

		$user = $this->user->find($id);

		if (!$user) {
			return $this->respondNotFound();
		}

		if (Gate::denies('update', $user)) {
			return $this->respondForbidden();
		};

		$user = $this->user->update($request, $id);

		return $this->fractal->collection([$user], new UserTransformer, $this->getResourceKey());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return mixed
	 */
	public function destroy($id)
	{
		$user = $this->user->find($id);

		if (!$user) {
			return $this->respondNotFound();
		}

		if (Gate::denies('delete', $user)) {
			return $this->respondForbidden();
		};

		$success = $this->user->destroy($id);

		if (!$success) {
			return $this->respondNotFound();
		}

		return $this->respondDestroy($id);
	}

}
