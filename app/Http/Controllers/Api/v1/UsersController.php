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
	protected $response;

	/**
	 * @var string
	 */
	protected $resourceKey;

	/**
	 * @param Larasponse $response
	 * @param UserRepositoryInterface $user
	 */
	public function __construct(Larasponse $response, UserRepositoryInterface $user)
	{
		$this->user = $user;

		$this->response = $response;

		// TODO put in extended class
		$this->resourceKey = 'users';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 */
	public function index()
	{
		return $this->response->paginatedCollection($this->user->paginate(), new UserTransformer, $this->resourceKey);
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

		return $this->response->collection([$user], new UserTransformer, $this->resourceKey);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UserRequest $request
	 * @return mixed
	 */
	public function store(UserRequest $request)
	{
		return $this->response->collection([$this->user->store($request)], new UserTransformer, $this->resourceKey);
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
		return $this->response->collection([$this->user->update($request, $id)], new UserTransformer, $this->resourceKey);
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
