<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use Cmb\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{


	/**
	 * @var Cmb\Repositories\UserRepositoryInterface
	 */
	protected $user;

	/**
	 * @param UserRepository $user
	 */
	public function __construct(UserRepositoryInterface $user)
	{
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->user->getAll();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UserRequest $request
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		return $this->user->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->user->find($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param UserRequest $request
	 * @return Response
	 */
	public function update(UserRequest $request, $id)
	{
		dd($request->all(), $id);
		return $this->user->update($request, $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
