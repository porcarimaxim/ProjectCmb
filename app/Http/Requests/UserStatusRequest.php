<?php namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response as IlluminateResponse;

class UserStatusRequest extends Request
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
					'user_id' => 'required',
					'company_id' => 'required',
					'is_available' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'user_id' => 'sometimes|required',
					'company_id' => 'sometimes|required',
					'is_available' => 'sometimes|required',
				];
			}
			default:break;
		}
	}

	//TODO de stilizat dupa modelul responsului
	public function response(array $errors)
	{
		return new JsonResponse($errors, IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY);
	}


}
