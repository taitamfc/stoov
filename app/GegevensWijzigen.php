<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GegevensWijzigen extends Model
{
    protected $fillable = [
        'relatienummer',
		'naam_bedrijf',
        'uw_naam',
        'emailadres',
        'client_id',
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id', 'id');
    }
}
