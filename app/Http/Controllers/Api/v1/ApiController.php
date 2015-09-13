<?php namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response as IlluminateResponse;

abstract class ApiController extends BaseController
{

	use DispatchesCommands, ValidatesRequests;

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
		$this->middleware('auth');
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