<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;

use App\Http\Requests\UserRequest;
use Library\Repositories\UserRepositoryInterface;
use Library\Transformers\UserTransformer;
use Sorskod\Larasponse\Larasponse;

class UsersController extends ApiController
{
	/**
	 * @var UserRepositoryInterface
	 */
	protected $user;

	/**
	 * @var Larasponse
	 */
	protected $fractal;

	/**
	 * @param Larasponse $fractal
	 * @param UserRepositoryInterface $user
	 */
	public function __construct(Larasponse $fractal, UserRepositoryInterface $user)
	{
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
		$users = $this->user->paginate();
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
		// TODO implement destroy response
		return $this->user->destroy($id);
	}

}
