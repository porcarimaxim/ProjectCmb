<?php namespace App\Http\Requests;

use Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response as IlluminateResponse;

class CallRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		switch($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [
					'number' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'number' => 'required'
				];
			}
			default:break;
		}
		return [];
	}

	//TODO de stilizat dupa modelul responsului
	public function response(array $errors)
	{
		return new JsonResponse($errors, IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY);
	}


}
