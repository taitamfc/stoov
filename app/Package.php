<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'key',
		'value',
        'price',
        'status',
        'is_active',
        'thema',
        'percentage',
        'vakcertificaat_glaszetten',
        'vakcertificaat_glasmonteur',
        'op_termijn_moeten_we_deze_gaan_bijhouden'
	];

    const STATUS_SHOW = 1;
    const STATUS_HIDE = 0;
}
