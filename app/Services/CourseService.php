<?php

namespace App\Services;

use App\Budget;
use App\Course;
use App\EmailSetting;
use App\Mail\ClientRegistersForTheCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CourseService
{
    protected $fileService;
    protected $storageFolderPath;

    /**
     * Create a new controller instance.
     *
     * @param FileService 		   $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->storageFolderPath = Course::STORAGE_FOLDER_PATH;
    }

    /**
     * @param $request
     * @param $loggedUser
     * @param $id
     * 
     * @return bool
     */
    public function postFormVerletvergoeding($request, $loggedUser = null, $id = null)
    {
        $course = collect([]);
        DB::transaction(function () use ($request, $loggedUser, &$course, $id) {
            $data = $this->convertFormVerletvergoeding($request, ($id ? Course::find($id) : null));
            if ($loggedUser) {
                $data['user_id'] = $loggedUser->id;
                $data['company_id'] = @$loggedUser->client->company_id ?? null;
            }
            $course = null;
            if (isset($id)) {
                $course = Course::find($id);
                if (isset($request->is_approved)) {
                    $data = [];
                    $data['is_approved'] = $request->is_approved;
                    if (
                        ($course->is_approved == Course::IS_APPROVED_NO || $course->is_approved == Course::IS_WAIT_CONFIRM) &&
                        $request->is_approved == Course::IS_APPROVED_YES
                    ) {
                        $remainingBudget = $this->getRemainingBudget($course->client->company_id);
                        if ($remainingBudget < $course->amount_request) {
                            throw new \Exception(__('Onvoldoende budget'));
                        }
                    }
                } else {
                    $data['amount_request'] = (float) $request['subsidiepercentage_dat_van_toepassing_is'] / 100 * $request['totaalbedrag_subsidie_aanvraag'];
                }
                if (@$request->reden) {
                    $data['reden'] = $request->reden;
                }
                $course = Course::find($id)->update($data);
            } else {
                $data['is_approved'] = Course::IS_WAIT_CONFIRM;
                $course = Course::create($data);
            }
        });

        if (!isset($request->is_approved)) {
            $this->sendMailGuestAndAdmin($course, [
                EmailSetting::TYPE_BEVESTIGING_ADMIN_VERLETVERGOEDINGL,
                EmailSetting::TYPE_BEVESTIGING_GEBRUIKER_VERLETVERGOEDING
            ]);
        }

        return true;
    }

    /**
     * @param $request
     * @param $loggedUser
     * @param $id
     * 
     * @return bool
     */
    public function postFormOpleidingsvergoeding($request, $loggedUser = null, $id = null)
    {
        $course = collect([]);
        DB::transaction(function () use ($request, $loggedUser, &$course, $id) {
            $data = $this->convertFormOpleidingsvergoeding($request, ($id ? Course::find($id) : null));
            if ($loggedUser) {
                $data['user_id'] = $loggedUser->id;
                $data['company_id'] = @$loggedUser->client->company_id ?? null;
            }
            $course = null;
            if (isset($id)) {
                $course = Course::find($id);
                if (isset($request->is_approved)) {
                    $data = [];
                    $data['is_approved'] = $request->is_approved;
                    if (
                        ($course->is_approved == Course::IS_APPROVED_NO || $course->is_approved == Course::IS_WAIT_CONFIRM) &&
                        $request->is_approved == Course::IS_APPROVED_YES
                    ) {
                        $remainingBudget = $this->getRemainingBudget($course->client->company_id);
                        if ($remainingBudget < $course->amount_request) {
                            throw new \Exception(__('Onvoldoende budget'));
                        }
                    }
                } else {
                    $data['amount_request'] = (float) $request['subsidiepercentage_dat_van_toepassing_is'] / 100 * $request['totaalbedrag_subsidie_aanvraag'];
                }
                if (@$request->reden) {
                    $data['reden'] = $request->reden;
                }
                $course = $course->update($data);
            } else {
                $data['amount_request'] = (float) $request['subsidiepercentage_dat_van_toepassing_is'] / 100 * $request['totaalbedrag_subsidie_aanvraag'];
                $data['is_approved'] = Course::IS_WAIT_CONFIRM;
                $course = Course::create($data);
            }
        });

        if (!isset($request->is_approved)) {
            $this->sendMailGuestAndAdmin($course, [
                EmailSetting::TYPE_BEVESTIGING_ADMIN_OPLEIDINGSVERGOEDING,
                EmailSetting::TYPE_BEVESTIGING_GEBRUIKER_OPLEIDINGSVERGOEDING
            ]);
        }

        return true;
    }

    /**
     * @param $request
     * @param $loggedUser
     * @param $id
     * 
     * @return bool
     */
    public function postFormLoonsomopgave($request, $loggedUser = null, $id = null)
    {
        $course = collect([]);
        DB::transaction(function () use ($request, $loggedUser, &$course, $id) {
            $data = $this->convertFormLoonsomopgave($request, ($id ? Course::find($id) : null));
            if ($loggedUser) {
                $data['user_id'] = $loggedUser->id;
                $data['company_id'] = @$loggedUser->client->company_id ?? null;
            }
            // $data['amount_request'] = (float) $request->loonsom;
            $course = null;
            if (isset($id)) {
                if (isset($request->is_approved)) {
                    $data = [];
                    $data['is_approved'] = $request->is_approved;
                }
                $course = Course::find($id)->update($data);
            } else {
                $data['is_approved'] = Course::IS_WAIT_CONFIRM;
                $data['boekjaar'] = now()->year - 1;
                $course = Course::create($data);
            }
        });

        //Sent mail to user
        if (!isset($request->is_approved)) {
            $this->sendMailGuestAndAdmin($course, [
                EmailSetting::TYPE_BEVESTIGING_ADMIN_LOONSOMOPGAVE,
                EmailSetting::TYPE_BEVESTIGING_BEVESTIGING_GEBRUIKER_LOONSOMOPGAVE
            ]);
        }

        return true;
    }

    /**
     * @param $request
     * @param $course
     * 
     * @return array
     */
    private function convertFormVerletvergoeding($request, $course = null)
    {
        $fields = $course ? json_decode($course->content, true) : [];
        $params = [
            'naam_bedrijf' => $request->naam_bedrijf ?? $fields['naam_bedrijf'] ?? '',
            'iban_nummer' => $request->iban_nummer ?? $fields['iban_nummer'] ?? '',
            'first_name' => $request->first_name ?? $fields['first_name'] ?? '',
            'middle_name' => $request->middle_name ?? $fields['middle_name'] ?? '',
            'last_name' => $request->last_name ?? $fields['last_name'] ?? '',
            'email' => $request->email ?? $fields['email'] ?? '',
            'naam_cursus' => $request->naam_cursus ?? $fields['naam_cursus'] ?? '',
            'datum_cursus_van' => $request->datum_cursus_van ?? $fields['datum_cursus_van'] ?? '',
            'datum_tot' => $request->datum_tot ?? $fields['datum_tot'] ?? '',
            'deelnemersinfo_per_bestand' => $request->deelnemersinfo_per_bestand ?? $fields['deelnemersinfo_per_bestand'] ?? '',
            'aantal_deelnemers_in_cursus' => $request->aantal_deelnemers_in_cursus ?? $fields['aantal_deelnemers_in_cursus'] ?? 0,
            'medewerker' => $request->medewerker ?? $fields['medewerker'] ?? '',
            'data_deelnemerslijst' => @$request->data_deelnemerslijst ?? @$fields['data_deelnemerslijst'] ?? '',
        ];
        $params['deelnemerslijst'] = $request->hasFile('deelnemerslijst') ? $this->fileService->uploadFile($this->storageFolderPath, $request->deelnemerslijst) : $fields['deelnemerslijst'] ?? null;
        $request = $request->all();
        $amountRequest = 0;
        foreach (@$request['data_deelnemerslijst'] ?? [] as $index => $item) {
            $params['data_deelnemerslijst'][$index]["hoogte_verletvergoeding"] = @config('course.compensation_amount')[$request['data_deelnemerslijst'][$index]["hoogte_verletvergoeding"]] ?? null;
            $amountRequest += (float) $item['hoogte_verletvergoeding'];
        }
        return [
            'type' => Course::TYPE_VERLETVERGOEDING,
            'content' => json_encode($params),
            'email' => $params['email'],
            'amount_request' => $amountRequest
        ];
    }

    /**
     * @param $request
     * @return array
     */
    private function convertFormOpleidingsvergoeding($request, $course = null)
    {
        $fields = $course ? json_decode($course->content, true) : [];
        $params = [
            'naam_bedrijf' => $request->naam_bedrijf ?? $fields['naam_bedrijf'] ?? '',
            'iban_nummer'  => $request->iban_nummer ?? $fields['iban_nummer'] ?? '',
            'first_name'  => $request->first_name ?? $fields['first_name'] ?? '',
            'middle_name'  => $request->middle_name ?? $fields['middle_name'] ?? '',
            'last_name'  => $request->last_name ?? $fields['last_name'] ?? '',
            'email'  => $request->email ?? $fields['email'] ?? '',
            'course'  => $request->course ?? $fields['course'] ?? '',
            'naam_cursus'  => $request->naam_cursus ?? $fields['naam_cursus'] ?? '',
            'cursus_info'  => $request->cursus_info ?? '' ?? $fields['cursus_info'] ?? '',
            'naam_opleidingsinstituut'  => $request->naam_opleidingsinstituut ?? $fields['naam_opleidingsinstituut'] ?? '',
            'datum_cursus_van'  => $request->datum_cursus_van ?? $fields['datum_cursus_van'] ?? '',
            'datum_tot'  => $request->datum_tot ?? $fields['datum_tot'] ?? '',
            'subsidiepercentage_dat_van_toepassing_is'  => $request->subsidiepercentage_dat_van_toepassing_is ?? $fields['subsidiepercentage_dat_van_toepassing_is'] ?? '',
            'totaalbedrag_subsidie_aanvraag'  => $request->totaalbedrag_subsidie_aanvraag ?? $fields['totaalbedrag_subsidie_aanvraag'] ?? '',
            'aard_van_de_cursus'  => $request->aard_van_de_cursus ?? $fields['aard_van_de_cursus'] ?? '',
            'deelnemers'  => $request->deelnemers ?? $fields['deelnemers'] ?? '',
            'verklaring'  => $request->verklaring ?? $fields['verklaring'] ?? '',
            'data_deelnemerslijst' => $request->data_deelnemerslijst ?? $fields['data_deelnemerslijst'] ?? [],
            'aantal_deelnemers_in_cursus' => $request->aantal_deelnemers_in_cursus ?? $fields['aantal_deelnemers_in_cursus'] ?? '',
            'informatie_over_het_opleidingsinstituut' => $request->informatie_over_het_opleidingsinstituut ?? $fields['informatie_over_het_opleidingsinstituut'] ?? '',
            'uw_vergoeding_bedraagt' => @$request->uw_vergoeding_bedraagt ?? @$fields['uw_vergoeding_bedraagt'] ?? ''
        ];
        $params['factuur'] = $request->hasFile('factuur') ? $this->fileService->uploadFile($this->storageFolderPath, $request->factuur) : $fields['factuur'] ?? null;
        $params['certificaat'] = $request->hasFile('certificaat') ? $this->fileService->uploadFile($this->storageFolderPath, $request->certificaat) : $fields['certificaat'] ?? null;
        $params['deelnemersinfo_per_bestand'] = $request->hasFile('deelnemersinfo_per_bestand') ? $this->fileService->uploadFile($this->storageFolderPath, $request->deelnemersinfo_per_bestand) : $fields['deelnemersinfo_per_bestand'] ?? null;
        $request = $request->all();
        return [
            'type' => Course::TYPE_OPLEIDINGSVERGOEDING,
            'content' => json_encode($params),
            'email' => $params['email']
        ];
    }

    /**
     * @param $request
     * @return array
     */
    private function convertFormLoonsomopgave($request, $course = null)
    {
        $fields = $course ? json_decode($course->content, true) : [];
        $params = [
            'relatienummer' => $request->relatienummer ?? $fields['relatienummer'] ?? '',
            'naam_bedrijf' => $request->naam_bedrijf ?? $fields['naam_bedrijf'] ?? '',
            'uw_naam' => $request->uw_naam ?? $fields['uw_naam'] ?? '',
            'email' => $request->email ?? $fields['email'] ?? '',
            'telefoonnummer' => $request->telefoonnummer ?? $fields['telefoonnummer'] ?? '',
            'reden' => $request->reden ?? $fields['reden'] ?? '',
            'reden_other' => $request->reden_other ?? $fields['reden_other'] ?? '',
            'personeel_in_loondienst' => $request->personeel_in_loondienst ?? $fields['personeel_in_loondienst'] ?? '',
            'personeel_datum' => $request->personeel_datum ?? $fields['personeel_datum'] ?? '',
            'personeel_tot' => $request->personeel_tot ?? $fields['personeel_tot'] ?? '',
            'loonsom' => $request->loonsom ?? $fields['loonsom'] ?? '',
            'aantal_medewerkers' => $request->aantal_medewerkers ?? $fields['aantal_medewerkers'] ?? '',
            'toelichting_en_of_opmerkingen' => $request->toelichting_en_of_opmerkingen ?? $fields['toelichting_en_of_opmerkingen'] ?? '',
            'verklaring' => $request->verklaring ?? $fields['verklaring'] ?? '',
        ];
        return [
            'type' => Course::TYPE_LOONSOMOPGAVE,
            'content' => json_encode($params),
            'email' => $params['email'],
        ];
    }

    /**
     * @param $course
     * @param $type
     */
    private function sendMailGuestAndAdmin($course, $type = [])
    {
        $emailSettings = EmailSetting::whereIn('type', $type)->get();
        $userTemplate = $emailSettings->where('type', $type[1])->first();
        $adminTemplate = $emailSettings->where('type', $type[0])->first();
        if (isset($course->email) && $userTemplate) {
            Mail::to($course->email)->send(new ClientRegistersForTheCourse($course, $userTemplate));
        }

        if ($adminTemplate) {
            Mail::to(@$adminTemplate->admin_email ?? config('mail.from.address'))->send(new ClientRegistersForTheCourse($course, $adminTemplate));
        }
    }

    /**
     * @param $companyId
     * 
     * @return float
     */
    public function getRemainingBudget($companyId)
    {
        $amountBudget = @Budget::whereBudgetJaartal(now()->year)
            ->whereCompanyId($companyId)
            ->first()->amount ?? 0;
        $amountCourse = @Course::whereCompanyId($companyId)
            ->whereYear('created_at', now()->year)
            ->whereIsApproved(Course::IS_APPROVED_YES)
            ->sum('amount_request') ?? 0;

        return $amountBudget - $amountCourse;
    }
}
