<?php namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use SoftDeletes;

	/**
	 * Soft delete
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

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
}
