<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
	protected $fillable = [
        'subject',
		'content',
        'cc_email',
        'bcc_email',
        'type',
        'status',
        'admin_email'
	];

    const TYPE_VERLETVERGOEDING = 1;
    const TYPE_OPLEIDINGSVERGOEDING = 2;
    const TYPE_LOONSOMOPGAVE = 3;

    const TYPE_BEVESTIGING_ADMIN_VERLETVERGOEDINGL= 4;
    const TYPE_BEVESTIGING_GEBRUIKER_VERLETVERGOEDING = 5;
    const TYPE_BEVESTIGING_ADMIN_OPLEIDINGSVERGOEDING = 6;
    const TYPE_BEVESTIGING_GEBRUIKER_OPLEIDINGSVERGOEDING = 7;
    const TYPE_BEVESTIGING_ADMIN_LOONSOMOPGAVE = 8;
    const TYPE_BEVESTIGING_BEVESTIGING_GEBRUIKER_LOONSOMOPGAVE = 9;

    const TYPE_AKKOORD_ADMIN_VERLETVERGOEDING = 10;
    const TYPE_AKKOORD_ADMIN_OPLEIDINGSVERGOEDING = 11;
    const TYPE_AKKOORD_ADMIN_LOONSOMOPGAVE = 12;

    const TYPES_LIST = [
        // self::TYPE_VERLETVERGOEDING,
        // self::TYPE_OPLEIDINGSVERGOEDING,
        self::TYPE_LOONSOMOPGAVE,
        self::TYPE_BEVESTIGING_ADMIN_VERLETVERGOEDINGL,
        self::TYPE_BEVESTIGING_GEBRUIKER_VERLETVERGOEDING,
        self::TYPE_BEVESTIGING_ADMIN_OPLEIDINGSVERGOEDING,
        self::TYPE_BEVESTIGING_GEBRUIKER_OPLEIDINGSVERGOEDING,
        self::TYPE_BEVESTIGING_ADMIN_LOONSOMOPGAVE,
        self::TYPE_BEVESTIGING_BEVESTIGING_GEBRUIKER_LOONSOMOPGAVE,
        self::TYPE_AKKOORD_ADMIN_VERLETVERGOEDING,
        self::TYPE_AKKOORD_ADMIN_OPLEIDINGSVERGOEDING,
        self::TYPE_AKKOORD_ADMIN_LOONSOMOPGAVE
    ];

    const TYPE_NAMES_LIST = [
        // self::TYPE_VERLETVERGOEDING => 'Uitnodiging Verletvergoeding',
        // self::TYPE_OPLEIDINGSVERGOEDING => 'Uitnodiging Opleidingsvergoeding',
        self::TYPE_LOONSOMOPGAVE => 'Uitnodiging Loonsomopgave',
        self::TYPE_BEVESTIGING_ADMIN_VERLETVERGOEDINGL => 'Bevestiging admin verletvergoeding',
        self::TYPE_BEVESTIGING_GEBRUIKER_VERLETVERGOEDING => 'Bevestiging gebruiker verletvergoeding',
        self::TYPE_BEVESTIGING_ADMIN_OPLEIDINGSVERGOEDING => 'Bevestiging admin Opleidingsvergoeding',
        self::TYPE_BEVESTIGING_GEBRUIKER_OPLEIDINGSVERGOEDING => 'Bevestiging gebruiker Opleidingsvergoeding',
        self::TYPE_BEVESTIGING_ADMIN_LOONSOMOPGAVE => 'Bevestiging admin Loonsomopgave',
        self::TYPE_BEVESTIGING_BEVESTIGING_GEBRUIKER_LOONSOMOPGAVE => 'Bevestiging gebruiker Loonsomopgave',
        self::TYPE_AKKOORD_ADMIN_VERLETVERGOEDING => 'Akkoord admin verletvergoeding',
        self::TYPE_AKKOORD_ADMIN_OPLEIDINGSVERGOEDING => 'Akkoord admin Opleidingsvergoeding',
        self::TYPE_AKKOORD_ADMIN_LOONSOMOPGAVE => 'Akkoord admin Loonsomopgave'
    ];
}
