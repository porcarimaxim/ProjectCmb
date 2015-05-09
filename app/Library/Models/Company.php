<?php namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {

	use SoftDeletes;

	/**
	 * Soft delete
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	//
	protected $fillable = ['name', 'email'];


}
