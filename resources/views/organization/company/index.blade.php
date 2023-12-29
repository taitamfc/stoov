@extends('layout.main')

@section('content')

    <section>
        <div class="container-fluid mb-3">
            @if (auth()->user()->role_users_id != \App\User::CLIENT)
            <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i>
                {{ __('Bedrijf') }}</button>
            @endif
        </div>
        <div class="table-responsive">
            <table id="company-table" class="table ">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th>{{ __('Relatienummer') }}</th>
                        <th>{{ __('Bedrijf') }}</th>
                        <th>{{ __('Plaats') }}</th>
                        <th>{{ __('Keurmerk') }}</th>
                        <th>{{ __('Stoov klant') }}</th>
                        <th>{{ __('E-mailadres contact') }}</th>
                        <th>{{ __('E-mailadres administratie') }}</th>
                        <th class="not-exported">{{ __('Action') }}</th>
                    </tr>

                </thead>

            </table>

        </div>

    </section>



    <div id="formModal" class="modal fade" role="dialog">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 id="exampleModalLabel" class="modal-title">{{ __('Add Company') }}</h5>

                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i

                            class="dripicons-cross"></i></button>

                </div>



                <div class="modal-body">

                    <span id="store_logo"></span>

                    <div id="btn-budget"></div>

                    <div id="budget_form_result"></div>

                    <div id="box-budget"></div>

                    <span id="form_result"></span>

                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">



                        @csrf

                        <div class="row">

                            <div class="col-md-6 form-group">

                                <label>{{ __('Organisatie') }} *</label>

                                <input type="text" name="organisatie" id="organisatie" required class="form-control"

                                    placeholder="Organisatie">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Straat') }}</label>

                                <input type="text" name="straat" id="straat" class="form-control"

                                    placeholder="{{ __('Straat') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Number') }}</label>

                                <input type="text" name="number" id="number" class="form-control"

                                    placeholder="{{ __('Number') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Toevoeging') }}</label>

                                <input type="text" name="toevoeging" id="toevoeging" class="form-control"

                                    placeholder="{{ __('Toevoeging') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Postal Code') }}</label>

                                <input type="text" name="post_code" id="post_code" class="form-control"

                                    placeholder="{{ __('Postal Code') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Plaats') }}</label>

                                <input type="text" name="plaats" id="plaats" class="form-control"

                                    placeholder="{{ __('Plaats') }}">

                            </div>



                            <div class="col-md-6 form-group d-none">

                                <label>{{ __('Glass label') }}</label>

                                <input type="text" name="glaskeur" id="glaskeur" class="form-control"

                                    placeholder="{{ __('Glass label') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Contactpersoon') }}</label>

                                <input type="text" name="contact_persoon" id="contact_persoon" class="form-control"

                                    placeholder="{{ __('Contactpersoon') }}">

                            </div>



                            <div class="col-md-6 form-group d-none">

                                <label>{{ __('Functie') }}</label>

                                <input type="text" name="functie" id="functie" class="form-control"

                                    placeholder="{{ __('Functie') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Telefoonnummer') }}</label>

                                <input type="text" name="telefoonnummer" id="telefoonnummer" class="form-control"

                                    placeholder="{{ __('Telefoonnummer') }}">

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('E-mailadres') }}</label>

                                <input type="text" name="emailadres" id="emailadres" class="form-control"

                                    placeholder={{ __('E-mailadres') }}>

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Keurmerk') }} </label>

                                <br>

                                <label class="radio-inline" for="keurmerk_no">

                                    <input type="radio" name="keurmerk" value="0" checked id="keurmerk_no">

                                    {{ __('Nee') }}

                                </label>

                                <label class="radio-inline" for="keurmerk_yes">

                                    <input type="radio" name="keurmerk" value="1" id="keurmerk_yes"> {{ __('Ja') }}

                                </label>

                            </div>

                            <div class="col-md-6 form-group">

                                <label>{{ __('Stoov klant') }} </label>

                                <br>

                                <label class="radio-inline" for="keurmerk_no">

                                    <input type="radio" name="details" value="No STOOV" checked id="details_no">

                                    {{ __('Nee') }}

                                </label>

                                <label class="radio-inline" for="details_yes">

                                    <input type="radio" name="details" value="1" id="details_yes"> {{ __('Ja') }}

                                </label>

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('E-mailadres contact') }}</label>

                                <input type="text" name="email_contact" id="email_contact_input" class="form-control"

                                    placeholder={{ __('E-mailadres contact') }}>

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('E-mailadres administratie') }}</label>

                                <input type="text" name="email_receipt" id="email_receipt_input" class="form-control"

                                    placeholder={{ __('E-mailadres administratie') }}>

                            </div>



                            <div class="col-md-6 form-group">

                                <label>{{ __('Nummer certificaat') }}</label>

                                <input type="text" name="nummer_certificaat" id="nummer_certificaat_input" class="form-control"

                                    placeholder={{ __('Nummer certificaat') }}>

                            </div>



                            <div class="col-md-12 form-group" align="center">

                                <input type="hidden" name="action" id="action" />

                                <input type="hidden" name="hidden_id" id="hidden_id" />

                                <input type="submit" name="action_button" id="action_button"

                                    class="btn btn-primary btn-block" value={{ __('Add') }} />

                            </div>

                        </div>



                    </form>



                </div>

            </div>

        </div>

    </div>



    @include('organization.company.modals.company_modal')



    <div id="confirmModal" class="modal fade" role="dialog">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h2 class="modal-title">{{ __('Confirmation') }}</h2>

                </div>

                <div class="modal-body">

                    <h4 align="center">{{ __('Are you sure you want to remove this data?') }}</h4>

                </div>

                <div class="modal-footer">

                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{ __('OK') }}'

                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>

                </div>

            </div>

        </div>

    </div>

    <div id="formBudgetModal" class="modal fade" role="dialog">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 id="budget-title">{{ __('Budget toevoegen') }}</h5>

                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i

                            class="dripicons-cross"></i></button>

                </div>



                <div class="modal-body">

                    <span id="form_budget_result"></span>

                    <span id="store_profile_photo"></span>



                    <form method="post" id="form_budget" class="form-horizontal">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 form-group">

                                <label>{{ __('jaar') }} <span class="text-danger">*</span></label>

                                <select name="budget_jaartal" id="budget_jaartal" required class="form-control">

                                    @foreach (range(2000, 2030) as $year)

                                        <option value="{{ $year }}">{{ $year }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-6 form-group">

                                <label>{{ __('Beschikbaar budget') }} <span class="text-danger">*</span></label>

                                <input type="text" name="amount" id="amount"

                                    placeholder="{{ __('Beschikbaar budget') }}" required class="form-control">

                            </div>

                            <div class="container">

                                <div class="form-group" align="center">

                                    <input type="hidden" name="budget_action" id="budget_action"

                                        value='{{ __('Add') }}' />

                                    <input type="hidden" name="budget_id" id="budget_id" />

                                    <input type="hidden" name="client_id" id="client_id" />

                                    <input type="hidden" name="company_id" id="budget_company_id" />

                                    <input type="hidden" name="_method" id="budget_method" value="POST" />

                                    <input type="submit" name="budget_action_button" id="budget_action_button"

                                        class="btn btn-warning" value="{{ __('Add') }}">

                                </div>

                            </div>

                        </div>



                    </form>



                </div>

            </div>

        </div>

    </div>

@endsection



@push('scripts')

    <script type="text/javascript">

        function getNumberFormat(x) {

            if (x === null || x === undefined || x === '') {

                return '0.00';

            }



            return x.toLocaleString('en-US', {

                minimumFractionDigits: 2,

                maximumFractionDigits: 2

            });

        }



        (function($) {

            "use strict";

            $(document).ready(function() {

                $('#company-table').DataTable({

                    initComplete: function() {

                        this.api().columns([2, 4]).every(function() {

                            var column = this;

                            var select = $('<select><option value=""></option></select>')

                                .appendTo($(column.footer()).empty())

                                .on('change', function() {

                                    var val = $.fn.dataTable.util.escapeRegex(

                                        $(this).val()

                                    );



                                    column

                                        .search(val ? '^' + val + '$' : '', true, false)

                                        .draw();

                                });



                            column.data().unique().sort().each(function(d, j) {

                                select.append('<option value="' + d + '">' + d +

                                    '</option>');

                                $('select').selectpicker('refresh');

                            });

                        });

                    },

                    responsive: false,

                    fixedHeader: {

                        header: true,

                        footer: true

                    },

                    serverSide: true,

                    ajax: {

                        url: "{{ route('companies.index') }}",

                    },

                    columns: [{

                            data: 'id',

                            orderable: false,

                            searchable: false

                        },

                        {

                            data: 'relatienummer',

                            name: 'relatienummer',

                        },

                        {

                            data: 'organisatie',

                            name: 'organisatie',

                        },

                        {

                            data: 'plaats',

                            name: 'plaats'

                        },

                        {

                            data: 'keurmerk',

                            name: 'keurmerk'

                        },

                        {

                            data: 'stoov_klant',

                            name: 'stoov_klant'

                        },

                        {

                            data: 'email_contact',

                            name: 'email_contact'

                        },

                        {

                            data: 'email_receipt',

                            name: 'email_receipt'

                        },

                        {

                            data: 'action',

                            name: 'action',

                            orderable: false

                        }

                    ],





                    "order": [],

                    'language': {

                        'lengthMenu': '_MENU_ {{ __('records per page') }}',

                        "info": '{{ __('Showing') }} _START_ - _END_ (_TOTAL_)',

                        "search": '{{ __('Search') }}',

                        'paginate': {

                            'previous': '{{ __('Previous') }}',

                            'next': '{{ __('Next') }}'

                        }

                    },



                    'columnDefs': [{

                            "orderable": false,

                            'targets': [0, 5]

                        },

                        {

                            'render': function(data, type, row, meta) {

                                if (type == 'display') {

                                    data =

                                        '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';

                                }



                                return data;

                            },

                            'checkboxes': {

                                'selectRow': true,

                                'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'

                            },

                            'targets': [0]

                        }

                    ],





                    'select': {

                        style: 'multi',

                        selector: 'td:first-child'

                    },

                    'lengthMenu': [

                        [10, 25, 50, -1],

                        [10, 25, 50, "All"]

                    ],

                    dom: '<"row"lfB>rtip',

                    buttons: [{

                            extend: 'csv',

                            text: '<i title="export to csv" class="fa fa-file-text-o"></i>',

                            exportOptions: {

                                columns: ':visible:Not(.not-exported)',

                                rows: ':visible'

                            },

                        },

                        {

                            extend: 'colvis',

                            text: '<i title="column visibility" class="fa fa-eye"></i>',

                            columns: ':gt(0)'

                        },

                    ],

                });

            });





            $('#create_record').on('click', function() {

                $('.modal-title').text("{{ __('Add New Company') }}");

                $('#action_button').val('{{ __('Add') }}');

                $('#action').val('{{ __('Add') }}');

                $('#store_logo').html('');

                $('#formModal').modal('show');

            });



            $('#sample_form').on('submit', function(event) {

                event.preventDefault();

                if ($('#action').val() == "{{ __('Add') }}") {

                    $.ajax({

                        url: "{{ route('companies.store') }}",

                        method: "POST",

                        data: new FormData(this),

                        contentType: false,

                        cache: false,

                        processData: false,

                        dataType: "json",

                        success: function(data) {

                            var html = '';

                            if (data.errors) {

                                html = '<div class="alert alert-danger">';

                                for (var count = 0; count < data.errors.length; count++) {

                                    html += '<p>' + data.errors[count] + '</p>';

                                }

                                html += '</div>';

                            }

                            if (data.success) {

                                html = '<div class="alert alert-success">' + data.success +

                                    '</div>';

                                $('#sample_form')[0].reset();

                                $('select').selectpicker('refresh');

                                $('#company-table').DataTable().ajax.reload();

                            }

                            $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);

                        }

                    })

                }



                if ($('#action').val() == '{{ __('Edit') }}') {

                    $.ajax({

                        url: "{{ route('companies.update') }}",

                        method: "POST",

                        data: new FormData(this),

                        contentType: false,

                        cache: false,

                        processData: false,

                        dataType: "json",

                        success: function(response) {

                            console.log(response.data);

                            var html = '';

                            if (response.errors) {

                                html = '<div class="alert alert-danger">';

                                for (var count = 0; count < response.errors.length; count++) {

                                    html += '<p>' + response.errors[count] + '</p>';

                                }

                                html += '</div>';

                            }

                            if (response.success) {

                                html = '<div class="alert alert-success">' + response.success +

                                    '</div>';

                                $('#sample_form')[0].reset();

                                $('select').selectpicker('refresh');

                                $('#company-table').DataTable().ajax.reload();



                                $('#organisatie').val(response.data.organisatie);

                                $('#straat').val(response.data.straat);

                                $('#number').val(response.data.number);

                                $('#toevoeging').val(response.data.toevoeging);

                                $('#post_code').val(response.data.post_code);

                                $('#plaats').val(response.data.plaats);

                                $('#glaskeur').val(response.data.glaskeur);

                                $('#contact_persoon').val(response.data.contact_persoon);

                                $('#functie').val(response.data.functie);

                                $('#telefoonnummer').val(response.data.telefoonnummer);

                                $('#emailadres').val(response.data.emailadres);

                                $('#email_receipt_input').val(response.data.email_receipt);

                                $('#email_contact_input').val(response.data.email_contact);

                                $('#nummer_certificaat_input').val(response.data.nummer_certificaat);

                                if (response.data.keurmerk == 1) {

                                    $('#keurmerk_yes').prop('checked', true);

                                } else {

                                    $('#keurmerk_no').prop('checked', true);

                                }



                                $('#hidden_id').val(response.data.id);

                                $('.modal-title').text("{{ __('Edit') }}");

                                $('#action_button').val("{{ __('Edit') }}");

                                $('#action').val("{{ __('Edit') }}");

                                $('#formModal').modal('show');

                            }

                            $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);

                        }

                    });

                }

            });





            $(document).on('click', '.edit', function() {



                var id = $(this).attr('id');

                $('#form_result').html('');



                var target = "{{ url('/organization/companies/edit') }}/" + id;



                $.ajax({

                    url: target,

                    dataType: "json",

                    success: function(html) {



                        $('#organisatie').val(html.data.organisatie);

                        $('#straat').val(html.data.straat);

                        $('#number').val(html.data.number);

                        $('#toevoeging').val(html.data.toevoeging);

                        $('#post_code').val(html.data.post_code);

                        $('#plaats').val(html.data.plaats);

                        $('#glaskeur').val(html.data.glaskeur);

                        $('#contact_persoon').val(html.data.contact_persoon);

                        $('#functie').val(html.data.functie);

                        $('#telefoonnummer').val(html.data.telefoonnummer);

                        $('#emailadres').val(html.data.emailadres);

                        $('#email_receipt_input').val(html.data.email_receipt);

                        $('#email_contact_input').val(html.data.email_contact);

                        $('#nummer_certificaat_input').val(html.data.nummer_certificaat);

                        $('#keurmerk').val(html.data.keurmerk);



                        $('#hidden_id').val(html.data.id);

                        $('.modal-title').text("{{ __('Edit') }}");

                        $('#action_button').val("{{ __('Edit') }}");

                        $('#action').val("{{ __('Edit') }}");

                        $('#formModal').modal('show');

                        callBudgetApi(null, id)

                        let xmlBudgetTable = `

                     <div class="table-responsive">

                        <table class="table">

                        <thead>

                            <tr>

                            <th scope="col">#</th>

                            <th scope="col">{{ __('Relatienummer') }}</th>

                            <th scope="col">{{ __('Boekjaar') }}</th>

                            <th scope="col">{{ __('Budget jaartal') }}</th>

                            <th scope="col">{{ __('Loonsom opgegeven') }}</th>

                            <th scope="col">{{ __('Overheveling budget') }}</th>

                            <th scope="col">{{ __('loonsom (euro)') }}</th>

                            <th scope="col">{{ __('Medewerkers aantal') }}</th>

                            <th scope="col">{{ __('Datum opgave') }}</th>

                            <th scope="col">{{ __('Premie') }}</th>

                            <th scope="col">{{ __('Vakbondsbijdr') }}</th>

                            <th scope="col">{{ __('Opleidingsbudget') }}</th>

                            <th scope="col">{{ __('Total budget') }}</th>

                            </tr>

                        </thead>

                        <tbody id="res-budget-data"></tbody>

                    </table>

                    </div>`;

                        $('#box-budget').html(xmlBudgetTable)

                    }

                })

            });



            $(document).on('click', '.show_new', function() {

                var id = $(this).attr('id');

                $('#form_result').html('');



                var target = "{{ url('/organization/companies') }}/" + id;



                $.ajax({

                    url: target,

                    dataType: "json",

                    success: function(result) {

                        $('#relatienummer').html(result.data.client?.relatienummer || '');

                        $('#organisatie_id').html(result.data.organisatie);

                        $('#straat_id').html(result.data.straat);

                        $('#number_id').html(result.data.number);

                        $('#toevoeging_id').html(result.data.toevoeging);

                        $('#post_code_id').html(result.data.post_code);

                        $('#plaats_id').html(result.data.plaats);

                        $('#glaskeur_id').html(result.data.glaskeur);

                        $('#contact_persoon_id').html(result.data.contact_persoon);

                        $('#functie_id').html(result.data.functie);

                        $('#telefoonnummer_id').html(result.data.telefoonnummer);

                        $('#emailadres_id').html(result.data.emailadres);

                        $('#email_receipt').html(result.data.client?.email_receipt || '');

                        $('#keurmerk').html(result.data.keurmerk);

                        $('#stoov_klant').html(result.data.stoov_klant || '');

                        // $('#year_sent').html(result.data.client?.year_sent || '');

                        $('#kvk').html(result.data.client?.kvk || '');

                        $('#btwnummer').html(result.data.client?.btwnummer || '');

                        $('#first_name').html(result.data.client?.first_name || '');

                        $('#last_name').html(result.data.client?.last_name || '');

                        $('#country').html(result.data.client?.country_name || '');

                        $('#company_modal').modal('show');

                        $('.modal-title').text("{{ __('Company Info') }}");

                    }

                });

            });



            let lid;

            $(document).on('click', '.delete', function() {

                lid = $(this).attr('id');

                $('#confirmModal').modal('show');

                $('.modal-title').text('{{ __('DELETE Record') }}');

                $('#ok_button').text('{{ __('OK') }}');



            });



            $(document).on('click', '#bulk_delete', function() {

                let table = $('#company-table').DataTable();

                let id = [];

                id = table.rows({

                    selected: true

                }).ids().toArray();

                if (id.length > 0) {

                    if (confirm("Are you sure you want to delete the selected company?")) {

                        $.ajax({

                            url: '{{ route('mass_delete_companies') }}',

                            method: 'POST',

                            data: {

                                companyIdArray: id

                            },

                            success: function(data) {

                                let html = '';

                                if (data.success) {

                                    html = '<div class="alert alert-success">' + data.success +

                                        '</div>';

                                }

                                if (data.error) {

                                    html = '<div class="alert alert-danger">' + data.error +

                                        '</div>';

                                }

                                table.ajax.reload();

                                table.rows('.selected').deselect();

                                if (data.errors) {

                                    html = '<div class="alert alert-danger">' + data.error +

                                        '</div>';

                                }

                                $('#general_result').html(html).slideDown(300).delay(5000).slideUp(

                                    300);

                            }



                        });

                    }

                } else {



                }

            });



            $('.close').on('click', function() {

                $('#sample_form')[0].reset();

                $('#store_logo').html('');

                $('#logo_id').html('');

                $('#company-table').DataTable().ajax.reload();

                $('select').selectpicker('refresh');

            });



            $('#ok_button').on('click', function() {

                var target = "{{ url('/organization/companies/delete') }}/" + lid;

                $.ajax({

                    url: target,

                    beforeSend: function() {

                        $('#ok_button').text('{{ __('Deleting...') }}');

                    },

                    success: function(data) {

                        let html = '';

                        if (data.success) {

                            html = '<div class="alert alert-success">' + data.success + '</div>';

                        }

                        if (data.error) {

                            html = '<div class="alert alert-danger">' + data.error + '</div>';

                        }

                        setTimeout(function() {

                            $('#general_result').html(html).slideDown(300).delay(5000)

                                .slideUp(300);

                            $('#confirmModal').modal('hide');

                            $('#company-table').DataTable().ajax.reload();

                        }, 2000);

                    }

                })

            });



            $('#form_budget').on('submit', function(event) {

                event.preventDefault();

                if ($('#budget_id').val() == null || $('#budget_id').val() == "") {

                    $.ajax({

                        url: "{{ route('budgets.store') }}",

                        method: "POST",

                        data: new FormData(this),

                        contentType: false,

                        cache: false,

                        processData: false,

                        dataType: "json",

                        success: function(data) {

                            var html = '';

                            if (data.errors) {

                                html = '<div class="alert alert-danger">';

                                for (var count = 0; count < data.errors.length; count++) {

                                    html += '<p>' + data.errors[count] + '</p>';

                                }

                                html += '</div>';

                            }

                            if (data.success) {

                                html = '<div class="alert alert-success">' + data.success +

                                    '</div>';

                                $('#form_budget')[0].reset();

                                $('select').selectpicker('refresh');

                                $('#client-table').DataTable().ajax.reload();

                                $('#formBudgetModal').modal('hide');

                                callBudgetApi(null, $('#budget_company_id').val())

                            }

                            $('#budget_form_result').html(html).slideDown(300).delay(5000).slideUp(

                                300);

                            $('#form_budget_result').html(html).slideDown(300).delay(5000).slideUp(

                                300);

                        }

                    });

                } else {

                    $.ajax({

                        url: "{{ route('budgets.store') }}/" + $('#budget_id').val(),

                        method: "POST",

                        data: new FormData(this),

                        contentType: false,

                        cache: false,

                        processData: false,

                        dataType: "json",

                        success: function(data) {

                            var html = '';

                            if (data.errors) {

                                html = '<div class="alert alert-danger">';

                                for (var count = 0; count < data.errors.length; count++) {

                                    html += '<p>' + data.errors[count] + '</p>';

                                }

                                html += '</div>';

                            }

                            if (data.error) {

                                html = '<div class="alert alert-success">' + data.error + '</div>';

                            }

                            if (data.success) {

                                html = '<div class="alert alert-success">' + data.success +

                                    '</div>';

                                setTimeout(function() {

                                    $('#form_budget')[0].reset();

                                }, 2000);

                                callBudgetApi(null, $('#budget_company_id').val())

                                $('#formBudgetModal').modal('hide');



                            }

                            $('#budget_form_result').html(html).slideDown(300).delay(5000).slideUp(

                                300);

                            $('#form_budget_result').html(html).slideDown(300).delay(5000).slideUp(

                                300);

                        }

                    });

                }

            });



            $(document).on('click', '.budget-edit', function() {

                var id = $(this).attr('id');

                $('#formBudgetModal').modal('show')

                $('#budget-title').text("{{ __('Begroting bewerken') }}");

                $('#budget_action_button').val("{{ __('Edit') }}");

                $('#budget_method').val("PUT");



                $.ajax({

                    url: "{{ route('budgets.index') }}/" + id,

                    dataType: "json",

                    success: function(data) {

                        $("#budget_jaartal").val(data.data.budget_jaartal).change();

                        $('#amount').val(data.data.amount)

                        $('#client_id').val(data.data.client_id)

                        $('#budget_company_id').val(data.data.company_id)

                        $('#budget_id').val(data.data.id)

                    }

                })

            });





            $(document).on('click', '.btn-modal-budget', function() {

                $('#budget-title').text("{{ __('Budget toevoegen') }}");

                $('#budget_action_button').val("{{ __('Add') }}");

                $('#budget_method').val("POST");

                $('#budget_id').val(null);

            });



            $(document).on('click', '.budget-delete', function() {

                var budget_delete_id = $(this).attr('id');

                $.ajax({

                    url: "{{ route('budgets.index') }}/" + budget_delete_id + '/delete',

                    success: function(data) {

                        let html = '';

                        if (data.success) {

                            html = '<div class="alert alert-success">' + data.success + '</div>';

                        }

                        if (data.error) {

                            html = '<div class="alert alert-danger">' + data.error + '</div>';

                        }

                        setTimeout(function() {

                            callBudgetApi(null, $('#budget_company_id').val())

                            $('#budget_form_result').html(html).slideDown(300).delay(5000)

                                .slideUp(300);

                        }, 1000);

                    }

                })

            });



            function callBudgetApi(clientId, companyId) {

                let xmlBudgetTable = ``

                $.ajax({

                    url: '/budgets?clientId=' + clientId + '&companyId=' + companyId,

                    dataType: "json",

                    success: function(data) {

                        let result = getXmlBudgetTr(data.data)

                        $('#res-budget-data').html(result)

                    }

                })

                $('#budget_company_id').val(companyId);

                $('#client_id').val(clientId);

            }



            function getXmlBudgetTr(data) {

                return $.map(data, function(val, i) {

                    return `<tr>

                        <th scope="row">${val.id}</th>

                        <td>${val.relatienummer ?? ''}</td>

                        <td>${val.year ?? ''}</td>

                        <td>${val.budget_jaartal ?? ''}</td>

                        <td>${val.loonsom_opgegeven ?? ''}</td>

                        <td>${val.overheveling_budget}</td>

                        <td>${val.loonsom_euro}</td>

                        <td>${val.medewerkers_aantal ?? ''}</td>

                        <td>${val.datum_opgave ?? ''}</td>

                        <td>${val.premie}</td>

                        <td>${val.vakbondsbijdr}</td>

                        <td>${val.opleidingsbudget}</td>

                        <td>${val.amount}</td>

                    </tr>`

                });

            }

        })(jQuery);

    </script>

@endpush

