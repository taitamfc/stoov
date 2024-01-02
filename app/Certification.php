<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Certification extends Model
{
    const Glaszetters = 'Glaszetters';
    const Beide = 'Beide';
    const Glasmonteurs = 'Glasmonteurs';

    protected $fillable = [
        'employee_id',
        'datum_uitgifte_vca',
        'vervaldatum_vca',
        'certificaatnummer',
        'gewenste_certificatie',
        'pasje_gecertificeerd_glasmonteur',
        'datum_gecertificeerd_glasmonteur',
        'vervaldatum_gecertificeerd_glasmonteur',
        'examen_glasmonteur',
        'examencode_glasmonteur',
        'examencijfer_glasmonteur',
        'hercertificering_glasmonteur',
        'datum_hercertificering_glasmonteur',
        'vervaldatum_hercertificering_glasmonteur',
        'hercertificeringscode_glasmonteur',
        'hercertificeringscijfer_glasmonteur',
        'hercertificeringspasnummer_glasmonteur',
        'pasje_gecertificeerd_glaszetter',
        'datum_gecertificeerd_glaszetter',
        'vervaldatum_gecertificeerd_glaszetter',
        'examen_glaszetter',
        'examencode_glaszetter',
        'examencijfer_glaszetter',
        'hercertificering_glaszetter',
        'datum_hercertificering_glaszetter',
        'vervaldatum_hercertificering_glaszetter',
        'hercertificeringscode_glaszetter',
        'hercertificeringscijfer_glaszetter',
        'hercertificeringspasnummer_glaszetter',
        'notitie',
    ];
    
    protected $casts = [
        'datum_uitgifte_vca' => 'datetime:Y-m-d', 
        'vervaldatum_vca' => 'datetime:Y-m-d',
        'datum_gecertificeerd_glasmonteur' => 'datetime:Y-m-d', 
        'vervaldatum_gecertificeerd_glasmonteur' => 'datetime:Y-m-d',
        'datum_hercertificering_glasmonteur' => 'datetime:Y-m-d', 
        'vervaldatum_hercertificering_glasmonteur' => 'datetime:Y-m-d',
        'datum_gecertificeerd_glaszetter' => 'datetime:Y-m-d', 
        'vervaldatum_gecertificeerd_glaszetter' => 'datetime:Y-m-d',
        'datum_hercertificering_glaszetter' => 'datetime:Y-m-d', 
        'vervaldatum_hercertificering_glaszetter' => 'datetime:Y-m-d'
    ];

    public function employee(){
		return $this->belongsTo(Employee::class, 'employee_id', 'id');
	}
}
