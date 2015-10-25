<?php namespace App\Library\Models;


class Call extends Base
{
	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = ['company_id', 'user_id', 'number', 'timer', 'description', 'status'];

	/**
	 * Set relation with user model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user() {
		return $this->belongsTo('App\Library\Models\User');
	}
}
