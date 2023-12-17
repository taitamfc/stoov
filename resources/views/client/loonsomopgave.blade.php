@extends('layout.main')
@section('content')
    <section>
        <div class="container">
            <div class="content-editor">
                <h1 class="single-title">Loonsomopgave</h1>
                <time class="posted-on published" datetime="2018-11-12"></time>
                <p>Met dit online formulier kunt u uw loonsom over het <u>kalenderjaar 2022</u> doorgeven aan het Stichting
                    Opleidings- en Ontwikkelingsfonds voor de Vlakglasbranche (Stoov).</p>

                <p>Nadat u het formulier heeft ingevuld en verzonden, krijgt u per e-mail een bevestiging van ons.<br>
                    Wij verwerken uw opgave. Indien nodig, sturen wij u een (correctie)nota.</p>
                <h3>Hoe geeft u andere wijzigingen door?</h3>
                <p>Wilt u aan ons een naams- of adreswijziging van uw organisatie doorgeven, stuur ons dan <a
                        href="mailto:info@stoov.nl">een mail</a>. <br>
                    Bij een bedrijfsbeëindiging ontvangen wij ook graag een mail met een bewijs van uitschrijving uit de
                    Kamer van Koophandel.</p>
                <p></p>
                <p>Bij voorbaat dank voor uw medewerking.</p>
                <p>Bestuur Stoov</p>
                <h1>Uw opgave</h1>

                *= verplicht veld
            </div>
            <div class="main-content-page">
                <form method="post" enctype="multipart/form-data" id="loonsomopgave" action="/loonsomopgave">
                    <span id="form_result"></span>
                    {!! csrf_field() !!}
                    <div class="gform_body gform-body">
                        <div id="gform_fields_14" class="gform_fields top_label form_sublabel_below description_below">
                            <div class="gform_section">
                                <div
                                    class="gfield gsection field_sublabel_below field_description_below gfield_visibility_visible">
                                    <h2 class="gsection_title">Bedrijfsgegevens</h2>
                                </div>
                                <div class="gfield field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">Relatienummer</label>
                                    <div class="ginput_container ginput_container_text">
                                        <input name="relatienummer" type="text"
                                            value="{{ auth()->user()->relatienummer }}" class="medium">
                                    </div>
                                </div>
                                <div id="field_naam_bedrijf"
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">Naam bedrijf <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_text">
                                        <input required name="naam_bedrijf" type="text"
                                            value="{{ @$client->company->organisatie }}" class="medium">
                                    </div>
                                </div>
                            </div>
                            <div class="gform_section">
                                <div
                                    class="gfield gsection field_sublabel_below field_description_below gfield_visibility_visible">
                                    <h2 class="gsection_title">Contactgegevens</h2>
                                </div>
                                <div
                                    class="gfield gfield_html gfield_html_formatted gfield_no_follows_desc field_sublabel_below field_description_below gfield_visibility_visible">
                                    Juiste contact gegevens zijn nodig zodat wij u kunnen benaderen voor eventuele vragen
                                    over uw loonsomopgave. Wij verzoeken u om uw gegevens in of aan te vullen.</div>
                                <div
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">Uw naam <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_text">
                                        <input required name="uw_naam" type="text" class="medium"
                                            value="{{ $client->first_name . ' ' . $client->last_name }}">
                                    </div>
                                </div>
                                <div
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">E-mailadres <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_email">
                                        <input required name="email" type="text" value="{{ $client->email }}"
                                            class="medium">
                                    </div>
                                </div>
                                <div
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">Telefoonnummer <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_text">
                                        <input required name="telefoonnummer" type="text" class="medium"
                                            value="{{ $client->contact_no }}">
                                    </div>
                                </div>
                            </div>
                            <div class="gform_section">
                                <div
                                    class="gfield gsection field_sublabel_below field_description_below gfield_visibility_visible">
                                    <h2 class="gsection_title">Reden van uw opgave</h2>
                                </div>
                                <div
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">Reden <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_radio">
                                        <ul class="gfield_radio" id="input_reden">
                                            @foreach (\App\Course::REDENS as $index => $value)
                                                <div class="gchoice">
                                                    <input class="gfield-choice-input" name="reden" type="radio"
                                                        value="{{ $index }}"
                                                        {{ ($fields['reden'] ?? null) == $index ? 'checked' : null }}
                                                        id="choice_reden_{{ $index - 1 }}"
                                                        onfocus="@if ($index == \App\Course::REDEN_4) jQuery(this).next('input').focus(); @endif" />
                                                    @if ($index == \App\Course::REDEN_4)
                                                        <input class="small" id="input_reden_other" name="reden_other"
                                                            type="text" value="{{ $fields['reden_other'] ?? null }}" />
                                                    @else
                                                        <label for="choice_reden_{{ $index - 1 }}"
                                                            id="label_reden_{{ $index - 1 }}">{{ $value }}</label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="gform_section">
                                <div
                                    class="gfield gsection field_sublabel_below field_description_below gfield_visibility_visible">
                                    <h2 class="gsection_title">Opgave loonsom</h2>
                                </div>
                                <div id="field_personeel_in_loondienst"
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label">PERSONEEL IN LOONDIENST <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_radio">
                                        <ul class="gfield_radio" id="input_personeel_in_loondienst">
                                            @foreach (\App\Course::PERSONEEL_IN_LOONDIENST as $index => $value)
                                                <div class="gchoice">
                                                    <input class="gfield-choice-input" name="personeel_in_loondienst"
                                                        type="radio" value="{{ $index }}"
                                                        id="choice_personeel_in_loondienst_{{ $index - 1 }}" />
                                                    <label for="choice_personeel_in_loondienst_{{ $index - 1 }}"
                                                        id="label_personeel_in_loondienst_{{ $index - 1 }}">{{ str_replace('2021', date('Y') - 1, $value) }}</label>
                                                </div>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div id="field_personeel_datum"
                                    class="field_personeel hide gfield gf-col-2 gfield_contains_required "
                                    style="display: none;">
                                    <label class="gfield_label" for="input_personeel_datum">Personeel in loondienst gehad
                                        van (datum) <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_date">
                                        <input required name="personeel_datum" id="input_personeel_datum" type="date"
                                            value=""
                                            class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized"
                                            placeholder="dd-mm-yyyy" aria-describedby="input_14_11_date_format"
                                            aria-invalid="false" aria-required="true" disabled="disabled">
                                    </div>
                                    <input type="hidden" id="gforms_calendar_icon_input_personeel_datum"
                                        class="gform_hidden"
                                        value="https://hutspotdigital.nl/stoovwp/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg"
                                        disabled="disabled">
                                </div>
                                <div id="field_personeel_tot" class="gfield gf-col-2 field_personeel hide"
                                    style="display: none;">
                                    <label class="gfield_label" for="input_personeel_tot">tot (datum) <span
                                            class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_date">
                                        <input required name="personeel_tot" id="input_personeel_tot" type="date"
                                            value=""
                                            class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized"
                                            placeholder="dd-mm-yyyy" aria-describedby="input_personeel_tot_date_format"
                                            aria-invalid="false" aria-required="true" disabled="disabled">
                                    </div>
                                </div>
                                <div id="field_loonsom" class="gfield gfield_contains_required gf-col-2">
                                    <label class="gfield_label" for="input_loonsom">Loonsom [euro] <span
                                            class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_number">
                                        <input required name="loonsom" id="input_loonsom" type="text" value=""
                                            class="medium"
                                            aria-describedby="gfield_instruction_loonsom gfield_description_loonsom">
                                        <div class="instruction " id="gfield_instruction_loonsom">Voer een getal groter
                                            dan of gelijk aan <strong>2</strong> in. </div>
                                    </div>
                                    <div class="gfield_description" id="gfield_description_loonsom">Vul hier in het totale
                                        bedrag aan ULB-loon (Uniform Loonbegrip) over {{ date('Y') - 1 }} voor het totaal aantal
                                        werknemers, gemaximeerd tot het maximum premieloon. Voor {{ date('Y') - 1 }} is dat € 58.311,- per
                                        werknemer.</div>
                                </div>
                                <div id="field_aantal_medewerkers"
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label" for="input_aantal_medewerkers">Aantal medewerkers per 31
                                        december {{ date('Y') - 1 }} <span class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_number">
                                        <input required name="aantal_medewerkers" id="input_aantal_medewerkers"
                                            type="text" value="" class="medium"
                                            aria-describedby="gfield_instruction_aantal_medewerkers gfield_description_aantal_medewerkers">
                                        <div class="instruction " id="gfield_instruction_aantal_medewerkers">Voer een
                                            getal groter dan of gelijk aan <strong>1</strong> in. </div>
                                    </div>
                                    <div class="gfield_description" id="gfield_description_aantal_medewerkers">Onder het
                                        aantal medewerkers wordt verstaan het totaal aantal werknemers waarop de hierboven
                                        vermelde loonsom betrekking heeft. Werknemer is iedere mannelijke of vrouwelijke
                                        werknemer, ongeacht de leeftijd, in dienst van een werkgever. Van de regeling zijn
                                        uitgesloten de niet (meer) voor de verplichte werknemersverzekeringen verzekerde
                                        directeur/grootaandeelhouder, diens echtgeno(o)te en familieleden indien zij
                                        eveneens niet verzekerd zijn voor de werknemersverzekeringen. </div>
                                </div>
                                <div class="gfield field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label" for="input_14_20">Toelichting en/of opmerkingen</label>
                                    <div class="ginput_container ginput_container_textarea">
                                        <textarea name="toelichting_en_of_opmerkingen" id="input_toelichting_en_of_opmerkingen" class="textarea medium"
                                            aria-invalid="false" rows="10" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="gform_section">

                                <div
                                    class="gfield gsection field_sublabel_below field_description_below gfield_visibility_visible">
                                    <h2 class="gsection_title">Bevestiging</h2>
                                </div>
                                <!-- <div class="gfield field_sublabel_below field_description_below gfield_visibility_hidden">
                                        <div class="admin-hidden-markup">
                                            <i class="gform-icon gform-icon--hidden"></i>
                                            <span>Hidden</span>
                                        </div>
                                        <label class="gfield_label" for="input_14_47">Datum opgave</label>
                                        <div class="ginput_container ginput_container_date">
                                            <input name="input_47" id="input_14_47" type="text" value="19/11/2022" class="datepicker dmy datepicker_no_icon gdatepicker-no-icon hasDatepicker initialized" placeholder="dd/mm/jjjj" aria-describedby="input_14_47_date_format" aria-invalid="false">
                                            <span id="input_14_47_date_format" class="screen-reader-text">DD slash MM slash JJJJ</span>
                                        </div>
                                        <input type="hidden" id="gforms_calendar_icon_input_14_47" class="gform_hidden" value="https://hutspotdigital.nl/stoovwp/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg">
                                    </div> -->
                                <div
                                    class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                    <label class="gfield_label gfield_label_before_complex">VERKLARING <span
                                            class="gfield_required">
                                            <span class="gfield_required gfield_required_asterisk">*</span>
                                        </span>
                                    </label>
                                    <div class="ginput_container ginput_container_checkbox">
                                        <ul class="gfield_checkbox" id="input_14_24">
                                            <div class="gchoice gchoice_14_24_1">
                                                <input required class="gfield-choice-input" name="verklaring"
                                                    type="checkbox" value="1  " id="choice_verklaring">
                                                <label for="choice_14_24_1" id="label_14_24_1">Ik verklaar de gegevens
                                                    naar waarheid te hebben ingevuld.</label>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <div class="gfield">
                                    <label class="gfield_label" for="input_10_29">CAPTCHA</label>
                                    <div class="g-recaptcha " data-sitekey="6LdHO7cjAAAAACmV8vxjAMORIdXNd16hjitgoQAc" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaResponseExpiry" data-error-callback="onRecaptchaError">
                                    </div>
                                </div> -->

                            </div>
                        </div>
                    </div>
                    <div class="gform_footer top_label">
                        <input type="submit" id="gform_submit_button_14" class="gform_button button" value="Versturen">
                        <!-- <a type="button" href="javascript:void(0);" id="gform_save_14_footer_link" class="gform_save_link"> Opslaan en later doorgaan</a> -->
                        <input type="hidden" name="gform_ajax"
                            value="form_id=14&amp;title=&amp;description=&amp                    <input type="hidden"
                            class="gform_hidden" name="is_submit_14" value="1">
                        <input type="hidden" class="gform_hidden" name="gform_submit" value="14">
                        <input type="hidden" class="gform_hidden" name="gform_save" id="gform_save_14" value="">
                        <input type="hidden" class="gform_hidden" name="gform_resume_token" id="gform_resume_token_14"
                            value="">
                        <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
                        <input type="hidden" class="gform_hidden" name="state_14"
                            value="WyJbXSIsImIwNTRmMTc1NGRhNTAyNTZjOGM1MjcyYTVkYjYzMTE1Il0=">
                        <input type="hidden" class="gform_hidden" name="gform_target_page_number_14"
                            id="gform_target_page_number_14" value="0">
                        <input type="hidden" class="gform_hidden" name="gform_source_page_number_14"
                            id="gform_source_page_number_14" value="1">
                        <input type="hidden" name="gform_field_values" value="check=First+Choice%2CSecond+Choice">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        (function($) {
            "use strict";
            var form = $('#loonsomopgave');

            form.on('submit', function(event) {
                event.preventDefault();

                if ($('#gform_submit_button_14').val() == "{{ __('Versturen') }}") {
                    var data = new FormData(this);

                    $.ajax({
                        url: "{{ route('create-contact-wage-bill') }}",
                        method: "POST",
                        data: data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
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
                                //Get name
                                var uw_naam = $('#input_uw_naam').val();

                                $('.content-editor').remove();
                                $('.main-content-page').remove();
                                $(".container").append('\
                                    <div class="content-editor introduce"> \
                                        <h1 class="single-title">Aanvraag scholingssubsidie</h1>\
                                    <p class="email-thanks first">Geachte mevrouw, heer,</p>\
                                    <p class="email-thanks">\
                                        U heeft zojuist een aanvraag scholingssubsidie ingediend, waarvoor hartelijk dank.<br>\
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
                                console.log(e.responseJSON.errors[i][0], v)
                                html += '<p>' + e.responseJSON.errors[i][0] + '</p>';
                            })
                            html += '</div>';
                            $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    });
                }
            });

        })(jQuery);
    </script>
@endsection
