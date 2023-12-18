@extends('layout.main')
@section('content')
<section>
    <div class="container">
        <div class="content-editor">
            <h1 class="single-title">Aanvraag opleidingsvergoeding</h1>
            <time class="posted-on published" datetime="2018-11-12"></time>
            <p>Werkgevers kunnen via onderstaand formulier een vergoeding aanvragen voor de scholing van hun medewerkers.</p>
            <p>Op deze aanvraag zijn de voorwaarden van <a href="https://stoov.nl/media/Financieringsreglement_2023.pdf" target="_blank" rel="noopener"> het Stoov Financieringsreglement</a> van toepassing.</p>
            <p>Vul de aanvraag zorgvuldig in en vergeet niet de vereiste documenten te uploaden.</p>
            <p>De aanvraag wordt pas verwerkt als alle gegevens juist zijn ingevuld en alle correcte bijlagen zijn geüpload.</p>
        </div>
        <div class="main-content-page">
            <form method="post" enctype="multipart/form-data" id="aanvraag_scholingssubsidie" action="#">
                <span id="form_result"></span>
                {!! csrf_field() !!}
                <div class="gform_body gform-body">
                    <div id="gform_fields_10" class="gform_fields  ">
                        <div class="gform_section">
                            <div id="field_10_9" class="gfield ">
                                <h2 class="gsection_title">Werkgevergegevens</h2>
                            </div>
                            <div class="gfield  gfield_contains_required" >
                                <label class="gfield_label" for="input_naam_bedrijf">Naam bedrijf <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_text">
                                    <input name="naam_bedrijf" id="input_naam_bedrijf" type="text" value="{{ @$client->company->organisatie }}"  class="medium">
                                </div>
                            </div>
                            <div id="field_iban_nummer" class="gfield   gfield_contains_required  ">
                                <label class="gfield_label" for="input_iban_nummer">IBAN nummer <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_text">
                                    <input name="iban_nummer" id="input_iban_nummer" type="text" value="" class="medium" placeholder="NL123ABCD1234567890">
                                </div>
                            </div>
                            <div id="field_10_5" class="gfield gf-col-2 gfield_contains_required  ">
                                <label class="gfield_label gfield_label_before_complex">Contactpersoon voor aanvraag <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput-col-3" id="input_10_5">
                                    <span id="input_first_name_container" class="ginput-col first_name">
                                        <input type="text" name="first_name" id="input_first_name" value="" >
                                        <label for="input_first_name" class="font-small">Voornaam</label>
                                    </span>
                                    <span id="input_middle_name_container" class="ginput-col middle_name">
                                        <input type="text" name="middle_name" id="input_middle_name" value="" >
                                        <label for="input_middle_name" class="font-small">Tussenvoegsel</label>
                                    </span>
                                    <span id="input_last_name_container" class="ginput-col last_name">
                                        <input type="text" name="last_name" id="input_last_name" value="" >
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
                                    <input name="email" id="input_email" type="text" value="" class="medium">
                                </div>
                            </div>
                        </div>
                        <div class="gform_section">
                            <div id="field_10_22" class="gfield ">
                                <h2 class="gsection_title">Gegevens cursus</h2>
                            </div>
                            <div id="field_course" class="gfield gfield_contains_required   ">
                                <label class="gfield_label" for="input_course">Cursus in Stoov overzicht opleidingsvergoedingspercentages? <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_select">
                                    <select name="course" id="input_course" class="medium gfield_select" >
                                        <option value="Ja">Ja</option>
                                        <option value="Nee" data-id="#field_cursus_info, #field_informatie_over_het_opleidingsinstituut">Nee</option>
                                    </select>
                                </div>
                                <div class="gfield_description" id="gfield_description_course">De bij Stoov bekende cursussen staan op <a href="https://stoov.nl/scholingssubsidies/overzicht-subsidiepercentages" target="_blank" rel="noopener">onze website</a>. U dient extra informatie aan te leveren voor opleidingsvergoeding aanvraag van niet bekende cursussen. Het bestuur van Stoov beoordeelt dan of de cursus vergoedingslabel is. </div>
                            </div>
                            <div id="field_naam_cursus" class="gfield gfield_contains_required row  ">
                                <div class="col-6">
                                    <label class="gfield_label" for="input_naam_cursus">Naam cursus <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_select ">
                                        <select name="naam_cursus" id="input_naam_cursus" class="medium gfield_select">
                                            <option value=""></option>
                                            @foreach ($courses as $index => $course)
                                            <option 
                                                value="{{ $course->id }}" 
                                                data-status="{{ $course->status }}" 
                                                data-price="{{ $course->price }}" 
                                                data-percentage="{{ $course->percentage }}" 
                                                {{ ($fields['naam_cursus'] ?? null) == $course->id ? "selected" : null }}>{{ $course->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="field_cursus_info" class="course hide gfield gfield_contains_required  " style="display: none;">
                                <label class="gfield_label" for="input_cursus_info">Informatie over de cursus <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_textarea">
                                    <textarea name="cursus_info" id="input_cursus_info" class="textarea medium"  rows="10" cols="50" disabled="disabled"></textarea>
                                </div>
                                <div class="gfield_description" id="gfield_description_cursus_info">U dient een aanvraag in voor een cursus die niet op het overzicht van onze website staat. Wij hebben informatie over de cursus nodig om te kunnen beoordelen of de cursus past binnen de statutaire bepalingen en de cao.</div>
                            </div>
                            <div id="field_naam_opleidingsinstituut" class="gfield gfield_contains_required  ">
                                <label class="gfield_label" for="input_naam_opleidingsinstituut">Naam opleidingsinstituut <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_text">
                                    <input name="naam_opleidingsinstituut" id="input_naam_opleidingsinstituut" type="text" value="" class="medium">
                                </div>
                            </div>
                            <div id="field_informatie_over_het_opleidingsinstituut" class="course hide gfield gfield_contains_required" style="display: none;">
                                <label class="gfield_label" for="input_informatie_over_het_opleidingsinstituut">Informatie over het opleidingsinstituut <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_textarea">
                                    <textarea name="informatie_over_het_opleidingsinstituut" id="input_informatie_over_het_opleidingsinstituut" class="textarea medium"  rows="10" cols="50" disabled="disabled"></textarea>
                                </div>
                                <div class="gfield_description" id="gfield_description_informatie_over_het_opleidingsinstituut">U dient een aanvraag in over een cursus die niet bij ons op de website staat. Wij hebben informatie over het opleidingsinstituut nodig om te kunnen beoordelen of de cursus past binnen de statutaire bepalingen en de cao.</div>
                            </div>
                            <div id="field_datum_cursus_van" class="gfield  gfield_contains_required  gf-col-2">
                                <label class="gfield_label" for="input_datum_cursus_van">Datum cursus van <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_date">
                                    <input name="datum_cursus_van" id="input_datum_cursus_van" type="date" value="" class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized" placeholder="dd-mm-yyyy" >
                                </div>
                            </div>
                            <div id="field_datum_tot" class="gfield  gfield_contains_required  gf-col-2">
                                <label class="gfield_label" for="input_datum_tot">tot <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_date">
                                    <input name="datum_tot" id="input_datum_tot" type="date" value="" class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized" placeholder="dd-mm-yyyy" >
                                </div>
                            </div>
                            <div id="field_subsidiepercentage_dat_van_toepassing_is" class="gfield gfield_contains_required ">
                                <label class="gfield_label" for="input_subsidiepercentage_dat_van_toepassing_is">Vergoedingspercentage dat van toepassing is <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="gfield_description" id="gfield_description_subsidiepercentage_dat_van_toepassing_is">Het percentage staat op <a href="https://stoov.nl/scholingssubsidies/overzicht-subsidiepercentages" target="_blank" rel="noopener">onze website</a>, in het overzicht van bekende cursussen. </div>
                                <div class="ginput_container ginput_container_number">
                                    <input name="subsidiepercentage_dat_van_toepassing_is" id="input_subsidiepercentage_dat_van_toepassing_is" type="text" value="" class="medium" readonly>
                                </div>
                            </div>
                            <div id="field_totaalbedrag_subsidie_aanvraag" class="gfield gfield_contains_required   ">
                                <label class="gfield_label" for="input_totaalbedrag_subsidie_aanvraag">Totaalbedrag opleidingsvergoeding ex BTW<span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_number">
                                    <input readonly name="totaalbedrag_subsidie_aanvraag" id="input_totaalbedrag_subsidie_aanvraag" type="text" value="" class="medium">
                                </div>
                            </div>
                            <div id="field_uw_vergoeding_bedraagt" class="gfield gfield_contains_required   ">
                                <label class="gfield_label" for="input_uw_vergoeding_bedraagt">Uw vergoeding bedraagt
                                </label>
                                <div class="ginput_container ginput_container_number">
                                    <input name="uw_vergoeding_bedraagt" id="input_uw_vergoeding_bedraagt" type="text" value="" class="medium">
                                </div>
                            </div>
                            <div id="field_totaalbedrag_subsidie_aanvraag" class="gfield gfield_contains_required   ">
                                <label class="gfield_label" for="input_totaalbedrag_subsidie_aanvraag">Aard van de cursus <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_select">
                                    <select name="aard_van_de_cursus" id="input_aard_van_de_cursus" class="medium gfield_select">
                                        <option value="Incompany">Incompany</option>
                                        <option value="Open inschrijving">Open inschrijving</option>
                                    </select>
                                </div>
                            </div>
                            <div id="field_factuur" class="gfield gf_left gfield_contains_required  ">
                                <label class="gfield_label" for="input_factuur">Factuur <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_fileupload">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="20971520">
                                    <input name="factuur" id="input_factuur" type="file" class="medium">
                                    <span class="gform_fileupload_rules" id="gfield_upload_rules_factuur">Toegestane bestandstypen: jpg, png, pdf, Max. bestandsgrootte: 20 MB.</span>
                                    <div class="validation_message validation_message--hidden-on-empty" id="live_validation_message_factuur"></div>
                                </div>
                            </div>
                            <div id="field_certificaat" class="gfield gf_right gfield_contains_required  ">
                                <label class="gfield_label" for="input_certificaat">Bewijs van deelname (certificaat) <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_fileupload">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="20971520">
                                    <input name="certificaat" id="input_certificaat" type="file" class="medium">
                                    <span class="gform_fileupload_rules" id="gfield_upload_rules_certificaat">Toegestane bestandstypen: jpg, png, pdf, Max. bestandsgrootte: 20 MB.</span>
                                    <div class="validation_message validation_message--hidden-on-empty" id="live_validation_message_certificaat"></div>
                                </div>
                                <div class="gfield_description " id="gfield_description_certificaat">Getekende presentielijsten ter vervanging van certificaten worden niet geaccepteerd.</div>
                            </div>
                        </div>
                        <div class="gform_section">
                            <div id="field_10_36" class="gfield ">
                                <h2 class="gsection_title">Werknemergegevens</h2>
                            </div>
                            <div id="field_deelnemers" class="gfield gfield--width-full gfield_contains_required  ">
                                <label class="gfield_label" for="input_deelnemers">Meer of minder dan 10 deelnemers? <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_select">
                                    <select name="deelnemers" id="input_deelnemers" class="small gfield_select">
                                        <option value="Maak een keuze" selected="selected">Maak een keuze</option>
                                        <option value="Minder dan 10" data-id="#field_aantal_deelnemers_in_cursus">Minder dan 10</option>
                                        <option value="Meer dan 10" data-id="#field_deelnemersinfo_per_bestand">Meer dan 10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="gform_section">
                            <div id="field_aantal_deelnemers_in_cursus" class="deelnemers hide gfield gfield_contains_required hide select_great_more" style="display: none;">
                                <label class="gfield_label" for="input_aantal_deelnemers_in_cursus">Aantal deelnemers in cursus <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_select ">
                                    <select name="aantal_deelnemers_in_cursus" id="input_aantal_deelnemers_in_cursus" class="medium gfield_select">
                                        <option value="">maak een keuze</option>
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div id="boxCourseMemberRequests"></div>
                            <div id="field_deelnemersinfo_per_bestand" class="deelnemers  hide gfield gfield--width-full gfield_contains_required  " style="display: none;">
                                <label class="gfield_label" for="input_deelnemersinfo_per_bestand">Deelnemersinfo per bestand <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_fileupload">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="20971520" disabled="disabled">
                                    <input name="deelnemersinfo_per_bestand" id="input_deelnemersinfo_per_bestand" type="file" class="medium" disabled="disabled">
                                    <span class="gform_fileupload_rules" id="gfield_upload_rules_deelnemersinfo_per_bestand">Toegestane bestandstypen: jpg, png, pdf, Max. bestandsgrootte: 20 MB.</span>
                                    <div class="validation_message validation_message--hidden-on-empty" id="live_validation_message_deelnemersinfo_per_bestand"></div>
                                </div>
                                <div class="gfield_description" id="gfield_description_deelnemersinfo_per_bestand">
                                    <font color="red">Indien 11 of meer deelnemers</font>, lever dan een bestand aan waarin per deelnemer wordt vermeld de voorletters en achternaam en geboortedatum.
                                </div>
                            </div>
                            <div id="field_10_25" class="gfield ">
                                <h2 class="gsection_title">Indienen aanvraag</h2>
                            </div>
                            <div id="field_10_28" class="gfield gfield_contains_required  ">
                                <label class="gfield_label gfield_label_before_complex">Verklaring <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput_container ginput_container_checkbox">
                                    <ul class="gfield_checkbox" id="input_10_28">
                                        <div class="gchoice gchoice_verklaring">
                                            <input class="gfield-choice-input" name="verklaring" type="checkbox" value="1" id="choice_verklaring" >
                                            <label for="choice_verklaring" id="label_verklaring">Ik verklaar de gegevens naar waarheid te hebben ingevuld.</label>
                                        </div>
                                    </ul>
                                </div>
                                <div class="gfield_description" id="gfield_description_10_28">U bent bekend en akkoord met de voorwaarden. Met deze akkoordverklaring geeft u aan op de hoogte te zijn van de voorwaarden en het <a href="https://stoov.nl/media/STOOV_financieringsreglement_2020.pdf" target="_blank">Stoov financieringsreglement</a>. </div>
                                <!-- <div class="gfield">
                                    <label class="gfield_label" for="input_10_29">CAPTCHA</label>
                                    <div class="g-recaptcha " data-sitekey="6LdHO7cjAAAAACmV8vxjAMORIdXNd16hjitgoQAc" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaResponseExpiry" data-error-callback="onRecaptchaError">
                                    </div>
                                </div> -->

                            </div>
                        </div>
                        <div class="gform_footer top_label">
                            <input type="submit" id="gform_submit" class="gform_button button" value="Versturen">
                            <!-- <a type="button" href="javascript:void(0);" id="gform_save_10_footer_link" class="gform_save_link"> Opslaan en later doorgaan</a> -->
                            <!-- <input type="hidden" name="gform_ajax" value="form_id=10&amp;title=&amp;description=&amp                            <input type="hidden" class="gform_hidden" name="is_submit_10" value="1">
                            <input type="hidden" class="gform_hidden" name="gform_submit" value="10">
                            <input type="hidden" class="gform_hidden" name="gform_save" id="gform_save_10" value="">
                            <input type="hidden" class="gform_hidden" name="gform_resume_token" id="gform_resume_token_10" value="">
                            <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
                            <input type="hidden" class="gform_hidden" name="state_10" value="WyJbXSIsImIwNTRmMTc1NGRhNTAyNTZjOGM1MjcyYTVkYjYzMTE1Il0=">
                            <input type="hidden" class="gform_hidden" name="gform_target_page_number_10" id="gform_target_page_number_10" value="0">
                            <input type="hidden" class="gform_hidden" name="gform_source_page_number_10" id="gform_source_page_number_10" value="1">
                            <input type="hidden" name="gform_field_values" value="check=First+Choice%2CSecond+Choice"> -->
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
        var form = $('#aanvraag_scholingssubsidie');

        form.on('submit', function(event) {
            event.preventDefault();
            jQuery('.error-input').removeClass('error-input');
            if ($('#gform_submit').val() == "{{__('Versturen')}}") {
                var data = new FormData(this);
                $.each($(':input', form), function(i, fileds) {
                    data.append($(fileds).attr('name'), $(fileds).val());
                });
                $.each($('input[type=file]', form)[0].files, function(i, file) {
                    data.append(file.name, file);
                });

                $.ajax({
                    url: "{{ route('create-contact-training-grant') }}",
                    method: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    mimeType: "multipart/form-data",
                    success: function(response) {

                        var html = '';
                        /*if (response.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < response.errors.length; count++) {
                                html += '<p>' + response.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }*/

                        if (response.success) {
                            $('.content-editor').remove();
                            $('.main-content-page').remove();
                            $(".container").append('\
                                <div class="content-editor introduce"> \
                                    <h1 class="single-title">Aanvraag opleidingsvergoeding</h1>\
                                <p class="email-thanks first">Geachte mevrouw, heer,</p>\
                                <p class="email-thanks">\
                                    U heeft zojuist een aanvraag opleidingsvergoeding ingediend, waarvoor hartelijk dank.<br>\
                                    We sturen u een bevestigingsmail met daarin de gegevens van uw aanvraag. Ontvangt u de bevestigingsmail niet meteen na het indienen van uw aanvraag, kijk dan of het bericht in uw spambox terecht is gekomen.\
                                </p>\
                                <p class="email-thanks">Wij streven ernaar correcte en volledige aanvragen binnen 2 weken af te handelen en de vergoeding binnen 4 weken uit te betalen.</p>\
                                <p class="email-thanks">Met vriendelijke groet,</p>\
                                <p class="email-thanks">Secretariaat Stoov</p>\
                            </div>');
                        }
                    },
                    error: function(e) {
                        var html = '<div class="alert alert-danger">';
                        Object.keys(e.responseJSON.errors).forEach(function(i, v) {
                            jQuery('.ginput_container [name="'+i+'"]').addClass('error-input');
                            html += '<p>' + e.responseJSON.errors[i][0] + '</p>';
                        })
                        html += '</div>';
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                });
            }
        });

        function getXmlCourseMemberRequests(i) {
            let xmlCourseMemberRequests = `<div data-great-more="${i}" id="field_${i}_11" class="gf-col-2 great-more aantal_deelnemers_in_cursus deelnemers gfield  gfield_contains_required">
                                <label class="gfield_label gfield_label_before_complex">Naam werknemer <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div class="ginput-col-3" id="input_${i}_11">
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
                            <div data-great-more="0" id="field_${i}_12" class=" gf-col-2 great-more aantal_deelnemers_in_cursus deelnemers gfield  gfield_contains_required  gf-col-2  ">
                                <label class="gfield_label gfield_label_before_complex">Geboortedatum werknemer <span class="gfield_required">
                                        <span class="gfield_required gfield_required_asterisk">*</span>
                                    </span>
                                </label>
                                <div id="input_${i}_12" class="ginput_container ginput_complex">
                                    <div class="clear-multi ginput-col-3">
                                        <div class="ginput-col gfield_date_day ginput_container ginput_container_date">
                                            <input type="text" maxlength="2" name="data_deelnemerslijst[${i}][geboortedatum_werknemer_dd]">
                                            <label for="input_geboortedatum_werknemer" class="">DD</label>
                                        </div>
                                        <div class="ginput-col gfield_date_month ginput_container ginput_container_date">
                                            <input type="text" maxlength="2" name="data_deelnemerslijst[${i}][geboortedatum_werknemer_mm]">
                                            <label for="input_geboortedatum_werknemer_mm" class="">MM</label>
                                        </div>
                                        <div class="ginput-col gfield_date_year ginput_container ginput_container_date">
                                            <input type="text" maxlength="4" name="data_deelnemerslijst[${i}][geboortedatum_werknemer_jjjj]">
                                            <label for="input_geboortedatum_werknemer_jjjj" class="">JJJJ</label>
                                        </div>
                                    </div>
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

        $('#input_course').change(function() {
            let input_course = $(this).val();
            if(input_course == 'Ja'){
                $('#field_naam_cursus').show();
                $('#input_subsidiepercentage_dat_van_toepassing_is').prop('readonly',true).val('');
                $('#input_totaalbedrag_subsidie_aanvraag').prop('readonly',true).val('');
            }else{
                $('#input_naam_cursus').val('');
                $('#field_naam_cursus').hide();
                $('#input_subsidiepercentage_dat_van_toepassing_is').prop('readonly',false).val('');
                $('#input_totaalbedrag_subsidie_aanvraag').prop('readonly',false).val('');
            }
        });
        $('#input_deelnemers').change(function() {
            if ($(this).val() === "Minder dan 10") {
                $('#boxCourseMemberRequests').show()

            } else {
                $('#boxCourseMemberRequests').hide()
            }
        });

        $('#input_naam_cursus').change(function() {
            let inputValue = $(this).val();
            let percentage = $(this).find('option[value="'+inputValue+'"]').attr('data-percentage');
            let price = $(this).find('option[value="'+inputValue+'"]').attr('data-price');
            if (percentage || price) {
                // percentage = parseFloat(percentage).toFixed(2);
                price = parseFloat(price).toFixed(2);
                $('#input_subsidiepercentage_dat_van_toepassing_is').val(percentage)
                $('#input_totaalbedrag_subsidie_aanvraag').val(price)
            }
        });
        $('#input_naam_cursus').select2({
            sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
        });
    })(jQuery);

    function isInt(value) {
        return !isNaN(value) && (function(x) {
            return (x | 0) === x;
        })(parseFloat(value))
    }
</script>


@endsection