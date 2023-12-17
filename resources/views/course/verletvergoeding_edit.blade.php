@extends('layout.main')
@section('content')
<section>
    <div class="container">
        <div class="content-editor">
            <h1 class="single-title">Aanvraag verletvergoeding</h1>
            <time class="posted-on published" datetime="2018-11-12"></time>
            <p>Werkgevers kunnen via onderstaand formulier verletvergoeding aanvragen voor medewerkers die vaktechnische cursussen en workshops van het Kenniscentrum Glas gevolgd hebben.
                Een aanvraag voor een verletvergoeding kan uitsluitend tegelijk of direct na een aanvraag voor de Stoov- opleidingsvergoeding worden ingediend.</p>
            <p>Op deze aanvraag is <a href="https://stoov.nl/verletregeling" target="_blank">de verletregeling</a> van toepassing.</p>
            <p>Vul de aanvraag zorgvuldig in en vergeet niet de vereiste documenten te uploaden.</p>
            <p>De declaratie wordt pas verwerkt als alle gegevens juist zijn ingevuld en alle geldige bijlagen zijn geüpload.</p>
        </div>
        <div class="main-content-page">
            <form method="post" enctype="multipart/form-data" id="aanvraag_verletvergoeding" action="#">
                <span id="form_result"></span>
                {!! csrf_field() !!}
                <div class="gform_body gform-body">
                    <div id="gform_fields_10" class="gform_fields  ">
                        <div class="gform_section">
                            <div id="field_10_9" class="gfield ">
                                <h2 class="gsection_title">Werkgevergegevens</h2>
                            </div>
                            <div id="field_naam_bedrijf" class="gfield  gfield_contains_required">
                                <label class="gfield_label" >Naam bedrijf <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_text">
                                    <input name="naam_bedrijf" type="text" value="{{ ($fields['naam_bedrijf'] ?? null) }}" class="medium">
                                </div>
                            </div>
                            <div id="field_iban_nummer" class="gfield   gfield_contains_required  ">
                                <label class="gfield_label" for="input_iban_nummer">IBAN nummer <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_text">
                                    <input name="iban_nummer" id="input_iban_nummer" type="text" value="{{ ($fields['iban_nummer'] ?? null) }}" class="medium" placeholder="NL123ABCD1234567890">
                                </div>
                            </div>
                            <div id="field_10_5" class="gfield gf-col-2 gfield_contains_required  ">
                                <label class="gfield_label gfield_label_before_complex">Contactpersoon voor aanvraag <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput-col-3" id="input_10_5">
                                    <span id="input_first_name_container" class="ginput-col first_name">
                                        <input type="text" name="first_name" id="input_first_name" value="{{ ($fields['first_name'] ?? null) }}" aria-required="true">
                                        <label for="input_first_name" class="font-small">Voornaam</label>
                                    </span>
                                    <span id="input_middle_name_container" class="ginput-col middle_name">
                                        <input type="text" name="middle_name" id="input_middle_name" value="{{ ($fields['middle_name'] ?? null) }}" aria-required="false">
                                        <label for="input_middle_name" class="font-small">Tussenvoegsel</label>
                                    </span>
                                    <span id="input_last_name_container" class="ginput-col last_name">
                                        <input type="text" name="last_name" id="input_last_name" value="{{ ($fields['last_name'] ?? null) }}" aria-required="true">
                                        <label for="input_last_name" class="font-small">Achternaam</label>
                                    </span>
                                </div>
                            </div>
                            <div id="field_email" class="gfield gf-col-2 gfield_contains_required  ">
                                <label class="gfield_label" for="input_email">E-mailadres contactpersoon voor aanvraag <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_email">
                                    <input name="email" id="input_email" type="text" value="{{ ($fields['email'] ?? null) }}" class="medium">
                                </div>
                            </div>
                        </div>
                        <div class="gform_section">
                            <div id="field_10_22" class="gfield ">
                                <h2 class="gsection_title">Gegevens cursus</h2>
                            </div>
                            <div id="field_naam_cursus" class="gfield gfield_contains_required row  ">
                                <div class="col-6">
                                    <label class="gfield_label" for="input_naam_cursus">Naam cursus <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_select ">
                                        <select name="naam_cursus" id="input_naam_cursus" class="medium gfield_select">
                                            @foreach ($courses as $index => $course)
                                            <option 
                                                value="{{ $course->id }}" 
                                                data-status="{{ $course->status }}" 
                                                data-price="{{ $course->price }}" 
                                                {{ ($fields['naam_cursus'] ?? null) == $course->id ? "selected" : null }}>{{ $course->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="field_medewerker" class="col-12">
                                <div class="row">

                                </div>
                            </div>
                            {{-- <div id="field_cursus_info" class="hide gfield gfield_contains_required  " style="display: none;">
                                <label class="gfield_label" for="input_cursus_info">Informatie over de cursus <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_textarea">
                                    <textarea name="cursus_info" id="input_cursus_info" class="textarea medium" disabled="disabled"></textarea>
                                </div>
                                <div class="gfield_description" id="gfield_description_cursus_info">U dient een aanvraag in voor een cursus die niet op het overzicht van onze website staat. Wij hebben informatie over de cursus nodig om te kunnen beoordelen of de cursus past binnen de statutaire bepalingen en de cao.</div>
                            </div> --}}
                            {{-- <div id="field_informatie_over_het_opleidingsinstituut" class="gfield gfield_contains_required" style="display: none;">
                                <label class="gfield_label" for="input_informatie_over_het_opleidingsinstituut">Informatie over het opleidingsinstituut <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_textarea">
                                    <textarea name="informatie_over_het_opleidingsinstituut" id="input_informatie_over_het_opleidingsinstituut" class="textarea medium" disabled="disabled"></textarea>
                                </div>
                                <div class="gfield_description" id="gfield_description_informatie_over_het_opleidingsinstituut">U dient een aanvraag in over een cursus die niet bij ons op de website staat. Wij hebben informatie over het opleidingsinstituut nodig om te kunnen beoordelen of de cursus past binnen de statutaire bepalingen en de cao.</div>
                            </div> --}}
                            <div id="field_datum_cursus_van" class="gfield  gfield_contains_required  gf-col-2">
                                <label class="gfield_label" for="input_datum_cursus_van">Datum cursus van <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_date">
                                    <input 
                                        name="datum_cursus_van" 
                                        id="input_datum_cursus_van" 
                                        type="date" 
                                        value="{{ ($fields['datum_cursus_van'] ?? null) }}" 
                                        class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized" 
                                        placeholder="dd-mm-yyyy" 
                                    />
                                </div>
                            </div>
                            <div id="field_datum_tot" class="gfield  gfield_contains_required  gf-col-2" style="margin: 0">
                                <label class="gfield_label" for="input_datum_tot">Tot<span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_date">
                                    <input 
                                        name="datum_tot" 
                                        id="input_datum_tot" 
                                        type="date" 
                                        value="{{ ($fields['datum_tot'] ?? null) }}" 
                                        class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized" 
                                        placeholder="dd-mm-yyyy" 
                                    />
                                </div>
                            </div>
                            <div id="field_deelnemersinfo_per_bestand" class="gfield gfield_contains_required ">
                                <label class="gfield_label" for="input_deelnemersinfo_per_bestand">Incompany cursus? <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_select">
                                    <select name="deelnemersinfo_per_bestand" id="input_deelnemersinfo_per_bestand" class="medium gfield_select">
                                        <option value="Nee" {{ ($fields['deelnemersinfo_per_bestand'] ?? null) === 'Nee' ? 'selected' : null }}>Nee</option>
                                        <option value="Ja" data-id="#field_deelnemerslijst" {{ ($fields['deelnemersinfo_per_bestand'] ?? null) === 'Ja' ? 'selected' : null }}>Ja</option>
                                    </select>
                                </div>
                            </div>
                            <div id="field_deelnemerslijst" class="deelnemersinfo_per_bestand hide gfield gf_left_third gfield_contains_required " style="{{ ($fields['deelnemersinfo_per_bestand'] ?? null) === 'Nee' ? 'display: none;' : null }}">
                                <label class="gfield_label" for="input_deelnemerslijst">Voeg getekende deelnemerslijst bij <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_fileupload">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="20971520">
                                    <input name="deelnemerslijst" id="input_deelnemerslijst" type="file" class="medium">
                                    <span class="gform_fileupload_rules" id="gfield_upload_rules_deelnemerslijst">Toegestane bestandstypen: jpg, png, pdf, Max. bestandsgrootte: 20 MB.</span>
                                    <div class="validation_message validation_message--hidden-on-empty" id="live_validation_message_deelnemerslijst"></div>
                                </div>
                                <div class="gfield_description" id="gfield_description_deelnemerslijst">Bij incompany cursussen is een getekende deelnemerslijst een verplichte bijlage bij de aanvraag.</div>
                            </div>


                        </div>
                        {{-- <div class="gform_section">
                            <div id="field_10_36" class="gfield ">
                                <h2 class="gsection_title">Werknemergegevens</h2>
                            </div>
                            <div class="gfield  gfield_contains_required  gf-col-12">
                                <label>Selecteer de deelnemers in cursus <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <ul>
                                    @foreach($employees as $employee)
                                    <li style="list-style: none;">
                                        <input type="checkbox" class="employee-checkbox" id="employee_{{ $employee->id }}" name="employee[{{ $employee->id }}]" value="{{ showEmployeeCheckbox($employee) }}" style="width:auto">
                                        <label for="employee_{{ $employee->id }}">{{ showEmployeeCheckbox($employee) }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="gfield  gfield_contains_required  gf-col-12">
                                <label>Hoogte verletvergoeding:</label>
                                <div class="employee-list">

                                </div>
                            </div>
                        </div> --}}
                        <div class="gform_section">
                            <div id="field_aantal_deelnemers_in_cursus" class=" gfield gfield_contains_required hide select_great_more" data-js-reload="field_aantal_deelnemers_in_cursus">
                                <label class="gfield_label" for="input_aantal_deelnemers_in_cursus">Aantal deelnemers in cursus <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_select ">
                                    <select name="aantal_deelnemers_in_cursus" id="input_aantal_deelnemers_in_cursus" class="medium gfield_select" aria-required="true" aria-invalid="false">
                                        <option value="maak een keuze" selected="selected">maak een keuze</option>
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ ($fields['aantal_deelnemers_in_cursus'] ?? null) == $i ? 'selected' : null }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div id="boxCourseMemberRequests">
                                @foreach(($fields['data_deelnemerslijst'] ?? []) as $index => $item_deelnemerslijst)
                                <div class="gf-col-2 great-more aantal_deelnemers_in_cursus gfield  gfield_contains_required">
                                    <label class="gfield_label gfield_label_before_complex">Naam werknemer <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput-col-3" id="input{{ $index }}_11">
                                        <span id="input_first_name_{{ $index }}_container" class="first_name ginput-col">
                                            <input 
                                                type="text" 
                                                name="data_deelnemerslijst[{{ $index }}][first_name]" 
                                                id="input_first_name_{{ $index }}" 
                                                value="{{ ($item_deelnemerslijst['first_name'] ?? null) }}"
                                            />
                                            <label for="input_first_name_{{ $index }}">Voorletters</label>
                                        </span>
                                        <span id="input_middle_name_{{ $index }}_container" class="middle_name ginput-col">
                                            <input 
                                                type="text" 
                                                name="data_deelnemerslijst[{{ $index }}][middle_name]" 
                                                id="input_middle_name_{{ $index }}" 
                                                value="{{ ($item_deelnemerslijst['middle_name'] ?? null) }}"
                                            />
                                            <label for="input_middle_name_{{ $index }}">Tussenvoegsel</label>
                                        </span>
                                        <span id="input_last_name_{{ $index }}_container" class="last_name ginput-col">
                                            <input 
                                                type="text" 
                                                name="data_deelnemerslijst[{{ $index }}][last_name]" 
                                                id="input_last_name_{{ $index }}" 
                                                value="{{ ($item_deelnemerslijst['last_name'] ?? null) }}"
                                            />
                                            <label for="input_last_name_{{ $index }}">Achternaam</label>
                                        </span>
                                    </div>
                                </div>
                                <div id="field{{ $index }}_12" class=" gf-col-2 great-more aantal_deelnemers_in_cursus gfield  gfield_contains_required  gf-col-2">
                                    <label class="gfield_label gfield_label_before_complex">Geboortedatum werknemer <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div id="input{{ $index }}_12" class="ginput_container ginput_complex">
                                        <div class="clear-multi ginput-col-3">
                                            <div class="ginput-col gfield_date_day ginput_container ginput_container_date">
                                                <input 
                                                    type="text" 
                                                    maxlength="2" 
                                                    name="data_deelnemerslijst[{{ $index }}][geboortedatum_werknemer_dd]"
                                                    value="{{ ($item_deelnemerslijst['geboortedatum_werknemer_dd'] ?? null) }}"
                                                />
                                                <label for="input_geboortedatum_werknemer_{{ $index }}" class="">DD</label>
                                            </div>
                                            <div class="ginput-col gfield_date_month ginput_container ginput_container_date">
                                                <input 
                                                    type="text" 
                                                    maxlength="2" 
                                                    name="data_deelnemerslijst[{{ $index }}][geboortedatum_werknemer_mm]"
                                                    value="{{ ($item_deelnemerslijst['geboortedatum_werknemer_mm'] ?? null) }}"
                                                />
                                                <label for="input_geboortedatum_werknemer_mm_{{ $index }}" class="">MM</label>
                                            </div>
                                            <div class="ginput-col gfield_date_year ginput_container ginput_container_date">
                                                <input 
                                                    type="text" 
                                                    maxlength="4" 
                                                    name="data_deelnemerslijst[{{ $index }}][geboortedatum_werknemer_jjjj]"
                                                    value="{{ ($item_deelnemerslijst['geboortedatum_werknemer_jjjj'] ?? null) }}"
                                                />
                                                <label for="input_geboortedatum_werknemer_jjjj_{{ $index }}" class="">JJJJ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="field_hoogte_verletvergoeding_{{ $index }}" class="great-more aantal_deelnemers_in_cursus gfield gfield_contains_required">
                                    <label class="gfield_label" for="input_hoogte_verletvergoeding_{{ $index }}">Hoogte verletvergoeding <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_select">
                                        <select name="data_deelnemerslijst[{{ $index }}][hoogte_verletvergoeding]" class="medium gfield_select">
                                            @foreach($compensationAmounts as $compensationValue => $compensationName)
                                            <option value="{{ $compensationValue }}" {{ ($item_deelnemerslijst['hoogte_verletvergoeding'] ?? null) == $compensationValue ? 'selected' : null }}">{{ $compensationName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="gform_footer top_label">
                            <input type="hidden" name="_method" value="put">
                            <input type="submit" id="gform_submit" class="gform_button button" value="{{__('Versturen')}}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript">
    (function($) {
        "use strict";
        var form = $('#aanvraag_verletvergoeding');

        form.on('submit', function(event) {
            event.preventDefault();

            if ($('#gform_submit').val() == "{{__('Versturen')}}") {
                var data = new FormData(this);
                $.each($(':input', form), function(i, fileds) {
                    data.append($(fileds).attr('name'), $(fileds).val());
                });
                $.each($('input[type=file]', form)[0].files, function(i, file) {
                    data.append(file.name, file);
                });

                $.ajax({
                    url: "{{ route('course.update', $id) }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    mimeType: "multipart/form-data",
                    success: function(response) {
                        var html = '';
                        if (response.success) {
                            html = '<div class="alert alert-success">' + response.success + '</div>';
                            $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    },
                    error: function(e) {
                        var html = '<div class="alert alert-danger">';
                        Object.keys(e.responseJSON.errors).forEach(function(i, v) {
                            html += '<p>' + e.responseJSON.errors[i][0] + '</p>';
                        })
                        html += '</div>';
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                });
            }
        });


        function getXmlCourseMemberRequests(i) {
            let xmlCourseMemberRequests = `<div class="gf-col-2 great-more aantal_deelnemers_in_cursus gfield  gfield_contains_required">
            <label class="gfield_label gfield_label_before_complex">Naam werknemer <span class="gfield_required">
                    <span class="gfield_required gfield_required_asterisk">*</span>
                </span>
            </label>
            <div class="ginput-col-3" id="input${i}_11">
                <span id="input_first_name_${i}_container" class="first_name ginput-col">
                    <input type="text" name="data_deelnemerslijst[${i}][first_name]" id="input_first_name_${i}" value="">
                    <label for="input_first_name_${i}">Voorletters</label>
                </span>
                <span id="input_middle_name_${i}_container" class="middle_name ginput-col">
                    <input type="text" name="data_deelnemerslijst[${i}][middle_name]" id="input_middle_name_${i}" value="">
                    <label for="input_middle_name_${i}">Tussenvoegsel</label>
                </span>
                <span id="input_last_name_${i}_container" class="last_name ginput-col">
                    <input type="text" name="data_deelnemerslijst[${i}][last_name]" id="input_last_name_${i}" value="">
                    <label for="input_last_name_${i}">Achternaam</label>
                </span>
            </div>
        </div>
        <div id="field${i}_12" class=" gf-col-2 great-more aantal_deelnemers_in_cursus gfield  gfield_contains_required  gf-col-2">
            <label class="gfield_label gfield_label_before_complex">Geboortedatum werknemer <span class="gfield_required">
                    <span class="gfield_required gfield_required_asterisk">*</span>
                </span>
            </label>
            <div id="input${i}_12" class="ginput_container ginput_complex">
                <div class="clear-multi ginput-col-3">
                    <div class="ginput-col gfield_date_day ginput_container ginput_container_date">
                        <input type="text" maxlength="2" name="data_deelnemerslijst[${i}][geboortedatum_werknemer_dd]">
                        <label for="input_geboortedatum_werknemer_${i}" class="">DD</label>
                    </div>
                    <div class="ginput-col gfield_date_month ginput_container ginput_container_date">
                        <input type="text" maxlength="2" name="data_deelnemerslijst[${i}][geboortedatum_werknemer_mm]">
                        <label for="input_geboortedatum_werknemer_mm_${i}" class="">MM</label>
                    </div>
                    <div class="ginput-col gfield_date_year ginput_container ginput_container_date">
                        <input type="text" maxlength="4" name="data_deelnemerslijst[${i}][geboortedatum_werknemer_jjjj]">
                        <label for="input_geboortedatum_werknemer_jjjj_${i}" class="">JJJJ</label>
                    </div>
                </div>
            </div>
        </div>
        <div id="field_hoogte_verletvergoeding_${i}" class="great-more aantal_deelnemers_in_cursus gfield gfield_contains_required">
            <label class="gfield_label" for="input_hoogte_verletvergoeding_${i}">Hoogte verletvergoeding <span class="gfield_required">
                    <span class="gfield_required gfield_required_asterisk">*</span>
                </span>
            </label>
            <div class="ginput_container ginput_container_select">
                <select name="data_deelnemerslijst[${i}][hoogte_verletvergoeding]" class="medium gfield_select">
                    @foreach($compensationAmounts as $compensationValue => $compensationName)
                    <option value="{{ $compensationValue }}">{{ $compensationName }}</option>
                    @endforeach
                </select>
            </div>
        </div>`

            return xmlCourseMemberRequests;
        }

        $('#input_aantal_deelnemers_in_cursus').change(function() {
            var loop = $(this).val();
            let boxCourseMemberRequests = ''
            if (isInt(loop)) {
                for (let i = 0; i < loop; i++) {
                    boxCourseMemberRequests += getXmlCourseMemberRequests(i)
                }
            }
            $('#boxCourseMemberRequests').html(boxCourseMemberRequests)
        });

        let xmlEmployeeInput = `<div class="gfield gfield_contains_required ">
        <label class="gfield_label" for="medewerker">Medewerker <span class="gfield_required">
                <span class="gfield_required gfield_required_asterisk">*</span>
            </span>
        </label>
        <div class="ginput_container ginput_container_select">
            <select name="medewerker" id="medewerker" class="medium gfield_select">
                @foreach($employees as $employee)
                <option value="{{ checkNameSelect($employee) }}">{{ checkNameSelect($employee) }}</option>
                @endforeach
            </select>
        </div></div>`
        let packagePrice = 0
        $('#input_naam_cursus').change(function() {
            let inputValue = $(this).val();
            let status = $(this).find('option:selected').attr('data-status');
            packagePrice = $(this).find('option:selected').attr('data-price') ?? 0;
            if (status == 1) {
                $('#field_medewerker .row').html(xmlEmployeeInput)
            } else {
                $('#field_medewerker .row').html(``)
            }
            getEmployeeList(employeeCheckeds, packagePrice)
        });
        $('#input_naam_cursus').select2({
            sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
        });
        var employeeCheckeds = []
        $('.employee-checkbox').change(function() {
            let val = $(this).val();
            let index = employeeCheckeds.indexOf(val);
            if (index > -1) {
                employeeCheckeds.splice(index, 1);
            } else {
                employeeCheckeds.push(val)
            }
            getEmployeeList(employeeCheckeds, packagePrice)

        });

        function getEmployeeList(employeeCheckeds, packagePrice) {
            let employeeListXml = $.map(employeeCheckeds, function(val, i) {
                return `<ul>
                    <li style="list-style: none;">
                        <span>${val}</span>
                        <span>€${packagePrice}</span>
                    </li>
                </ul>`;
            });
            $('.employee-list').html(employeeListXml)
        }
    })(jQuery);

    function isInt(value) {
        return !isNaN(value) && (function(x) {
            return (x | 0) === x;
        })(parseFloat(value))
    }
</script>

@endsection