<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRequest extends Model
{
    protected $fillable = [
		'id',
		'last_name',
		'first_name',
        'birthdate',
        'user_id',
		'status',
		'vca_expiry_date',
		'working_since',
		'is_subcontractor'
	];

	const STATUS_APPROVED = 1;
	const STATUS_CONFIRMED = 0;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function client()
	{
		return $this->belongsTo('App\Client', 'user_id', 'id');
	}
}
