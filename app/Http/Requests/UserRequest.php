<?php namespace App\Http\Requests;

use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response as IlluminateResponse;

class UserRequest extends Request
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
		$user = User::find($this->users);

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
					'first_name' => 'required',
					'last_name'  => 'required',
					'email'      => 'required|email|unique:users,email',
					'password'   => 'required|confirmed',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'first_name' => 'sometimes|required',
					'last_name'  => 'sometimes|required',
					'email'      => 'sometimes|required|email|unique:users,email' . $user->id,
					'password'   => 'sometimes|required|confirmed',
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
