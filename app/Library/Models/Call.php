<?php namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model {

	//
	protected $fillable = ['company_id', 'number', 'time', 'description', 'status'];


}
