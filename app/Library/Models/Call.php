<?php namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
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
	protected $fillable = ['company_id', 'number', 'timer', 'description', 'status'];

	/**
	 * Set relation with user model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user() {
		return $this->belongsTo('App\Library\Models\User');
	}
}
