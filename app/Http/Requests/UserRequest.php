<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Symfony\Component\HttpFoundation\JsonResponse;

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
					'first_name' => 'required',
					'last_name'  => 'required',
					'email'      => 'required|email|unique:users,email,'.$user->id,
					'password'   => 'required|confirmed',
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
