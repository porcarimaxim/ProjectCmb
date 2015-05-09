<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model {

	//
	protected $fillable = ['company_id', 'number', 'time', 'description', 'status'];


}
