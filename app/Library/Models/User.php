<?php namespace App\Library\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Base implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = ['company_id', 'first_name', 'last_name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'options' => 'array',
	];

	/**
	 *  Available options for user
	 */
	public $castAttr = [
		'is_available'
	];
	/**
	 * Defining model guarded attributes
	 *
	 * @var array
	 */
	protected $guarded = ['password'];

	/**
	 * Set relation with company model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function company() {
		return $this->belongsTo('App\Library\Models\Company');
	}

	/**
	 * Set relation with call model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function calls() {
		return $this->hasMany('App\Library\Models\Call');
	}
}
