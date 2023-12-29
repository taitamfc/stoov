<div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ __('Company Info') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <span id="logo_id"></span>
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table  table-bordered">
                                <tr>
                                    <th>{{ __('Relatienummer') }}</th>
                                    <td id="relatienummer"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Bedrijf') }}</th>
                                    <td id="organisatie_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('kvk') }}</th>
                                    <td id="kvk"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('straat') }}</th>
                                    <td id="straat_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Number') }}</th>
                                    <td id="number_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('toevoeging') }}</th>
                                    <td id="toevoeging_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Postal code') }}</th>
                                    <td id="post_code_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Plaats') }}</th>
                                    <td id="plaats_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Land') }}</th>
                                    <td id="country"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Glass label') }}</th>
                                    <td id="glaskeur_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Contact Persoon') }}</th>
                                    <td id="contact_persoon_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Functie') }}</th>
                                    <td id="functie_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Telefoonnummer') }}</th>
                                    <td id="telefoonnummer_id"></td>
                                </tr>
                                {{-- client --}}
                                <tr>
                                    <th>{{ __('Btwnummer') }}</th>
                                    <td id="btwnummer"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Voornaam') }}</th>
                                    <td id="first_name"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Achternaam') }}</th>
                                    <td id="last_name"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Email receipt') }}</th>
                                    <td id="email_receipt"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('E-mail address') }}</th>
                                    <td id="emailadres_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Keurmerk') }}</th>
                                    <td id="keurmerk"></td>
                                </tr>
                                <tr>
                                    <th>{{ __('Stoov klant') }}</th>
                                    <td id="stoov_klant"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>

    </div>
</div>