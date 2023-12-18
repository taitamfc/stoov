<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\PasswordReset;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    const ADMINISTRATOR = 1;
    const EMPLOYEE = 2;
    const CLIENT = 3;
    const DEFAULT_PASSWORD = 'secret';
    const DEFAULT_CONTACT_NO = '0000';
    const ACTIVED = 1;
    const DISABLED= 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'relatienummer','first_name','last_name','username', 'email', 'password','role_users_id','contact_no','profile_photo','profile_bg','is_active','last_login_ip','last_login_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


	public function RoleUser()
	{
		// return $this->hasone('App\Role_User','id',"role_users_id");
        return $this->hasone('Spatie\Permission\Models\Role','id',"role_users_id");
	}

//	public function scopeActive($query)
//	{
//		return $query->where('is_active',1);
//	}
//	public function scopeMonthly($query)
//	{
//		return $query->whereMonth('created_at','4');
//	}



	public function getLastLoginDateAttribute($value)
	{
		if ($value)
		{
			return Carbon::parse($value)->format(env('Date_Format').'--H:i');
		}
		else {
			return null;
		}
	}

    /**
     * Get full name Attribute
     * 
     * @return String
     */
    public function getFullNameAttribute(): string
	{
        return implode(
            ' ',
            array_filter(
                [
                    $this->first_name,
                    $this->last_name
                ],
                function ($item) {
                    return !empty($item);
                }
            )
        );
	}
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies(){
		return $this->belongsToMany(Company::class, 'user_company', 'user_id', 'company_id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(){
		return $this->hasOne(Client::class, 'id', 'id');
	}

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
}


