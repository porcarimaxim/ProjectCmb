<?php namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response as IlluminateResponse;

abstract class ApiController extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * @var string
	 */
	protected $resourceKey = 'data';

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

	public function respondNotFound($message = 'Resource not found')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	public function respondInternalError($message = 'Internal server error')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

	private function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	private function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
	}

	public function respondDestroy($id, $message = 'Resource deleted') {
		return $this->respond([
			$this->getResourceKey() => [
				'id' => $id,
				'message' => $message
			]
		]);
	}

}