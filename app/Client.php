<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Client extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'username',
		'first_name',
		'last_name',
		'password',
		'contact_no',
		'email',
		'website',
		'address1',
		'address2',
		'city',
		'state',
		'country',
		'zip',
		'profile',
		'is_active',
		'company_id',
		'year_sent',
		'relatienummer',
		'kvk',
		'email_receipt',
		'btwnummer'
	];

	protected $appends = ['country_name'];
	

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}

	
	public function projects()
	{
		return $this->hasMany(Project::class);
	}

	public function user(){
		return $this->hasOne(User::class,'id','id');
	}

	public function company(){
		return $this->belongsTo(Company::class, 'company_id', 'id');
	}

	/**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function courses()
    {
        return $this->hasMany('App\Course', 'user_id', 'id');
    }

	public function getCountryNameAttribute()
	{
		return DB::table('countries')->where('id', $this->country)->value('name');
	}
}
