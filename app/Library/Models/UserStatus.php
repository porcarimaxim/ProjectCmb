<?php namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'company_id', 'is_available'];
}
