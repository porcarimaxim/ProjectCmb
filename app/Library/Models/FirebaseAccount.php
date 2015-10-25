<?php namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class FirebaseAccount extends Model
{
	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = ['account', 'token', 'company_id'];
}
