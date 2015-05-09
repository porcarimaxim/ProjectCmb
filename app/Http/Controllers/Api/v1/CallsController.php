<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CallRequest;
use Library\Repositories\CallRepositoryInterface;
use Illuminate\Http\Request;

class CallsController extends Controller
{


	/**
	 * @var CallRepositoryInterface
	 */
	protected $call;

	/**
	 * @param CallRepositoryInterface $call
	 */
	public function __construct(CallRepositoryInterface $call)
	{
		$this->call = $call;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->call->getAll();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CallRequest $request
	 * @return Response
	 */
	public function store(CallRequest $request)
	{
		return $this->call->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->call->find($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param CallRequest $request
	 * @return Response
	 */
	public function update(CallRequest $request, $id)
	{
		return $this->call->update($request, $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->call->destroy($id);
	}

}
