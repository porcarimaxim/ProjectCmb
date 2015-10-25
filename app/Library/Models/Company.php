<?php namespace App\Library\Models;


class Company extends Base
{
	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email'];

	/**
	 * Set relation one to many with user model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users() {
		return $this->hasMany('App\Library\Models\User');
	}

	/**
	 * Set relation one to many with user model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function apiKeys() {
		return $this->hasMany('App\Library\Models\ApiKey');
	}

	/**
	 * Set relation one to many with user model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function firebaseAccounts() {
		return $this->hasMany('App\Library\Models\FirebaseAccount');
	}
}
