<?php namespace App\Http\Controllers\Api\v1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response as IlluminateResponse;

abstract class ApiController extends BaseController
{

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Respond status code
	 *
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * Respond resource key
	 *
	 * @var string
	 */
	protected $resourceKey = 'data';

	public function __construct()
	{
		$this->middleware('auth.basic.once');
		$this->middleware('auth');
	}

	/**
	 * Register middleware on the controller.
	 *
	 * @param  string $middleware
	 * @param  int $index
	 * @param  array $options
	 * @return void
	 */
	public function insertMiddleware($middleware, $index, array $options = [])
	{
		$this->middleware = array_slice($this->middleware, 0, $index, true) +
			[$middleware => $options] +
			array_slice($this->middleware, $index, count($this->middleware), true);
//		$this->middleware = $result;
	}

	/**
	 * @return string
	 */
	public function getResourceKey()
	{
		return $this->resourceKey;
	}

	/**
	 * @param string $resourceKey
	 */
	public function setResourceKey($resourceKey)
	{
		$this->resourceKey = $resourceKey;
	}

	/**
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * Return respond
	 *
	 * @param $data
	 * @param array $headers
	 * @return mixed
	 */
	private function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * Return error respond
	 *
	 * @param $message
	 * @return mixed
	 */
	private function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
	}

	/**
	 * Return not found respond
	 *
	 * @param string $message
	 * @return mixed
	 */
	public function respondNotFound($message = 'Resource not found')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * Return forbidden respond
	 *
	 * @param string $message
	 * @return mixed
	 */
	public function respondForbidden($message = 'insufficient permissions')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
	}

	/**
	 * Return internal server error respond
	 *
	 * @param string $message
	 * @return mixed
	 */
	public function respondInternalError($message = 'Internal server error')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

	/**
	 * Return destroy respond
	 *
	 * @param $id
	 * @param string $message
	 * @return mixed
	 */
	public function respondDestroy($id, $message = 'Resource deleted')
	{
		return $this->respond([
			$this->getResourceKey() => [
				'id' => $id,
				'message' => $message
			]
		]);
	}

}