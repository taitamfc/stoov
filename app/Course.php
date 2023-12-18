<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'relatienummer',
        'email',
        'content',
        'type',
        'status',
        'is_approved',
        'user_id',
        'amount_total',
        'amount_request',
        'is_watched',
        'company_id',
        'reden',
        'boekjaar',
        'uw_vergoeding_bedraagt'
    ];

    const TYPE_VERLETVERGOEDING = 1;
    const TYPE_OPLEIDINGSVERGOEDING = 2;
    const TYPE_LOONSOMOPGAVE = 3;
    const STORAGE_FOLDER_PATH = 'email-contact';

    const STATUS_SENT = 1;
    const STATUS_WAIT = 0;
    const STATUS_ERROR = 2;

    CONST IS_APPROVED_NO = 0;
    CONST IS_APPROVED_YES = 1;
    CONST IS_WAIT_CONFIRM = 2;

    CONST APPROVED_LIST = [
        self::IS_APPROVED_NO => 'Niet akkoord',
        self::IS_APPROVED_YES => 'Akkoord',
        self::IS_WAIT_CONFIRM => 'In behandeling'
    ];

    const PERSONEEL_IN_LOONDIENST = [
        self::PERSONEEL_IN_LOONDIENST_1 => 'Ja, geheel 2021',
        self::PERSONEEL_IN_LOONDIENST_2 => 'Ja, een deel van 2021',
        self::PERSONEEL_IN_LOONDIENST_3 => 'Nee, wij verklaren dat we in 2021 geen personeel in dienst hadden. De loonsom is € 0,-'
    ];

    const PERSONEEL_IN_LOONDIENST_1 = 1;
    const PERSONEEL_IN_LOONDIENST_2 = 2;
    const PERSONEEL_IN_LOONDIENST_3 = 3;

    const REDENS = [
        self::REDEN_1 => 'Wij hebben een ambtshalve nota ontvangen en we willen deze nota corrigeren.',
        self::REDEN_2 => 'Wij zijn dit jaar voor het eerst aangesloten bij Stoov.',
        self::REDEN_3 => 'Wij hebben eerder een foute loonsom doorgegeven en willen dit corrigeren.',
        self::REDEN_4 => null
    ];

    const REDEN_1 = 1;
    const REDEN_2 = 2;
    const REDEN_3 = 3;
    const REDEN_4 = 4;

    const LIST_JSON_FIELDS_VERLETVERGOEDING = [
        'relatienummer',
        'id',
        'naam_bedrijf',
        'iban_nummer',
        'inzenddatum',
        'full_name',
        'naam_cursus',
        'medewerker',
        'datum_cursus_van',
        'datum_tot',
        'deelnemersinfo_per_bestand',
        'deelnemerslijst',
        'aantal_deelnemers_in_cursus',
        'boekjaar',
        'reden_afkeur',
        'ik_verklaar_de_gegevens_naar_waarheid_te_hebben_ingevuld',
    ];

    const LIST_JSON_FIELDS_LOONSOMOPGAVE = [
        'relatienummer',
        'id',
        'inzenddatum',
        'naam_bedrijf',
        'uw_naam',
        'email',
        'personeel_in_loondienst',
        'personeel_datum',
        'personeel_tot',
        'loonsom',
        'aantal_medewerkers',
        'toelichting_en_of_opmerkingen',
    ];

    const LIST_JSON_FIELDS_OPLEIDINGSVERGOEDING = [
        'relatienummer',
        'id',
        'boekjaar',
        'naam_bedrijf',
        'iban_nummer',
        'inzenddatum',
        'naam',
        'email',
        'course',
        'naam_cursus',
        'cursus_info',
        'naam_opleidingsinstituut',
        'datum_cursus_van',
        'datum_tot',
        'subsidiepercentage_dat_van_toepassing_is',
        'totaalbedrag_subsidie_aanvraag',
        'aard_van_de_cursus',
        'factuur',
        'certificaat',
        'deelnemers',
        'aantal_deelnemers_in_cursus',
        'informatie_over_het_opleidingsinstituut',
        'deelnemersinfo_per_bestand',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
}
