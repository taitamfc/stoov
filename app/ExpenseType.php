<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
	protected $fillable = [
		'type','company_id'
	];

	public function company(){
		return $this->hasOne('App\Company','id','company_id');
	}
}
