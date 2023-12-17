<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'year',
        'amount',
        'company_id',
        'relatienummer',
        'budget_jaartal',
        'loonsom_opgegeven',
        'overheveling_budget',
        'loonsom_euro',
        'medewerkers_aantal',
        'datum_opgave',
        'premie',
        'vakbondsbijdr',
        'opleidingsbudget',
    ];

    /**
     * Get the company that owns the Budget
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
