<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = [
		'organisatie',
		'straat',
		'number',
		'toevoeging',
		'post_code',
		'plaats',
		'glaskeur', 
		'contact_persoon',
		'functie',
		'telefoonnummer',
		'emailadres',
		'keurmerk',
		'details'
	];

	public function client()
	{
		return $this->hasOne(Client::class, 'company_id', 'id');
	}
}
