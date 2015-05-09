<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Call;
use Symfony\Component\HttpFoundation\JsonResponse;

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
					'number' => 'required',
				];
			}
			default:break;
		}
	}

	public function response(array $errors)
	{
		return new JsonResponse($errors, 422);
	}


}
