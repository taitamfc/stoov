@extends('layout.main')

@section('content')

<section>

    <div class="container-fluid"><span id="general_result"></span></div>

    <div class="container-fluid mb-3">

        @can('store-details-employee')

        <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i> {{__('Medewerker toevoegen')}}</button>

        @endcan

        @can('modify-details-employee')

        <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i class="fa fa-minus-circle"></i> {{__('Bulk delete')}}</button>

        @endcan

        @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)

        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">

            <i class="fa fa-filter" aria-hidden="true"></i> Filter

        </button>

        @endif

        @if (auth()->user()->role_users_id != \App\User::CLIENT)

        <button class="btn btn-info" type="button" id="create_employee_request" data-toggle="modal" data-target="#createEmployeeRequest">

            <i class="fa fa-plus"></i> {{__('Medewerker toevoegen')}}

        </button>

        @endif

    </div>

    <div class="col-12">

        <!-- Filtering -->

        <div class="collapse" id="collapseExample">

            <div class="card card-body">

                <form action="" method="GET" id="filter_form">

                    <div class="row">

                        <!-- Company -->

                        <div class="col-md-3">

                            <div class="form-group">

                                <label class="text-bold"><strong>{{__('Berdrijf')}}</strong></label>

                                <select name="company_id" id="company_id_filter" class="form-control selectpicker dynamic" data-live-search="true" data-live-search-style="contains" data-shift_name="shift_name" data-dependent="department_name" title="{{__('Selecting',['key'=>__('Berdrijf')])}}...">

                                    <option value=""></option>

                                    @foreach($companies as $company)

                                    <option value="{{$company->id}}">{{$company->organisatie}}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!--/ Company-->

                        <div class="col-md-1">

                            <label class="text-bold"></label><br>

                            <button type="button" class="btn btn-dark" id="filterSubmit">

                                <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; KRIJGEN

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!--/ Filtering -->

    </div>





    <div class="table-responsive">

        <table id="employee-table" class="table ">

            <thead>

                <tr>

                    <th class="not-exported"></th>

                    <th>{{__('Company Name')}}</th>

                    <th>{{__('Achternaam')}}</th>

                    <th>{{__('Initialen')}}</th>

                    <th>{{ __('Toevoeging') }}</th>

                    <th>{{__('Tussenvoegsel')}}</th>

                    <th>{{__('Geboortedatum')}}</th>

                    <th>{{__('Geboorteplaats')}}</th>

                    <th>{{ __('Aktief') }}</th>

                    <th>{{ __('In Dienst') }}</th>

                    <th>{{ __('Indienst Sinds') }}</th>

                    <th>{{ __('Is Onderaannemer') }}</th>

                    <th>{{ __('Onderaannemer Sinds') }}</th>

                    <!-- <th>{{ __('Vevaldatum VCA') }}</th>

                    <th>{{ __('Vervaldatum Glasmonteur') }}</th>

                    <th>{{ __('Vervaldatum Glaszetter') }}</th> -->

                    <th class="not-exported">{{__('action')}}</th>

                </tr>

            </thead>



        </table>

    </div>

</section>







<div id="formModal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">



            <div class="modal-header">

                <h5 id="exampleModalLabel" class="modal-title">{{__('Werknemer toevoegen')}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>



            <div class="modal-body">

                <span id="form_result"></span>

                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">



                    @csrf

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label class="text-bold">{{__('Berdrijf')}} <span class="text-danger">*</span></label>

                                <select name="company_ids[]" multiple id="company_id" required class="form-control selectpicker dynamic" data-live-search="true" data-live-search-style="contains" data-shift_name="shift_name" data-dependent="department_name" title="{{__('Selecting',['key'=>__('Berdrijf')])}}...">

                                    @foreach($companies as $company)

                                    <option value="{{$company->id}}">{{$company->organisatie}}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-4 form-group">

                            <label class="text-bold">{{__('Initialen')}} <span class="text-danger">*</span></label>

                            <input type="text" name="initialen" id="initialen" placeholder="{{__('Initialen')}}" required class="form-control">

                        </div>

                        <div class="col-md-4 form-group">

                            <label class="text-bold">{{__('Tussenvoegsel')}} <span class="text-danger">*</span></label>

                            <input type="text" name="tussenvoegsel" id="tussenvoegsel" placeholder="{{__('Tussenvoegsel')}}" required class="form-control">

                        </div>

                        <div class="col-md-4 form-group">

                            <label class="text-bold">{{__('Achternaam')}} <span class="text-danger">*</span></label>

                            <input type="text" name="achternaam" id="achternaam" placeholder="{{__('Achternaam')}}" required class="form-control">

                        </div>

                        

                        <!-- <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Toevoeging')}} <span class="text-danger">*</span></label>

                            <input type="text" name="toevoeging" id="toevoeging" placeholder="{{__('Toevoeging')}}" required class="form-control">

                        </div> -->

                        <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Geboortedatum')}} <span class="text-danger">*</span></label>

                            <input type="text" name="geboortedatum" id="geboortedatum" required autocomplete="off" class="form-control date" value="">

                        </div>

                        <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Geboorteplaats')}} <span class="text-danger">*</span></label>

                            <input type="text" name="geboorteplaats" id="geboorteplaats" placeholder="{{__('Geboorteplaats')}}" required class="form-control">

                        </div>

                        <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Indienst Sinds')}} <span class="text-danger">*</span></label>

                            <input type="text" name="indienst_sinds" id="indienst_sinds" required autocomplete="off" class="form-control date" value="">

                        </div>

                        <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Onderaannemer Sinds')}} <span class="text-danger">*</span></label>

                            <input type="text" name="onderaannemer_sinds" id="onderaannemer_sinds" required autocomplete="off" class="form-control date" value="">

                        </div>

                        <div class="col-md-4 form-group">

                            <label class="text-bold">{{__('Aktief')}} <span class="text-danger">*</span></label>

                            <div>

                                <label class="radio-inline">

                                    <input type="radio" name="aktief" value="0">{{__('No')}}

                                </label>

                                <label class="radio-inline">

                                    <input type="radio" name="aktief" value="1" checked>{{__('Yes')}}

                                </label>

                            </div>

                        </div>

                        

                        <div class="col-md-4 form-group">

                            <label class="text-bold">{{__('In Dienst')}} <span class="text-danger">*</span></label>

                            <div>

                                <label class="radio-inline">

                                    <input type="radio" name="in_dienst" value="0">{{__('No')}}

                                </label>

                                <label class="radio-inline">

                                    <input type="radio" name="in_dienst" value="1" checked>{{__('Yes')}}

                                </label>

                            </div>

                            

                        </div>

                        

                        <div class="col-md-4 form-group">

                            <label class="text-bold">{{__('Is Onderaannemer')}} <span class="text-danger">*</span></label>

                            <div>

                                <label class="radio-inline">

                                    <input type="radio" name="is_onderaannemer" value="0">{{__('No')}}

                                </label>

                                <label class="radio-inline">

                                    <input type="radio" name="is_onderaannemer" value="1" checked>{{__('Yes')}}

                                </label>

                            </div>

                        </div>

                       

                        <!-- <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Vevaldatum VCA')}} <span class="text-danger">*</span></label>

                            <input type="text" name="vevaldatum_vca" id="vevaldatum_vca" required autocomplete="off" class="form-control date" value="">

                        </div> -->

                        <!-- <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Vervaldatum Glasmonteur')}} <span class="text-danger">*</span></label>

                            <input type="text" name="vervaldatum_glasmonteur" id="vervaldatum_glasmonteur" required autocomplete="off" class="form-control date" value="">

                        </div> -->

                        <!-- <div class="col-md-6 form-group">

                            <label class="text-bold">{{__('Vervaldatum Glaszetter')}} <span class="text-danger">*</span></label>

                            <input type="text" name="vervaldatum_glaszetter" id="vervaldatum_glaszetter" required autocomplete="off" class="form-control date" value="">

                        </div> -->

                        <div class="container">

                            <div class="form-group" align="center">

                                <input type="hidden" name="action" id="action" />

                                <input type="hidden" name="hidden_id" id="hidden_id" />

                                <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}" />

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>





<div id="confirmModal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h2 class="modal-title">{{__('Confirmation')}}</h2>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <h4 align="center" style="margin:0;">{{__('Are you sure you want to remove this data?')}}</h4>

            </div>

            <div class="modal-footer">

                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{__('OK')}}</button>

                <button type="button" class="close btn-default" data-dismiss="modal">{{__('Cancel')}}</button>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="createEmployeeRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h2 class="modal-title">{{__('Medewerker toevoegen')}}</h2>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <span id="form_result_request"></span>

            <form method="post" id="createEmployeeRequestForm" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-body">

                    @csrf

                    <div class="col-md-12 form-group">

                        <label class="text-bold">{{ __('Achternaam') }} <span class="text-danger">*</span></label>

                        <input type="text" name="last_name" required />

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="text-bold">{{ __('Naam') }} <span class="text-danger">*</span></label>

                        <input type="text" name="first_name" required />

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="text-bold">{{ __('Geboortedatum') }} <span class="text-danger">*</span></label>

                        <input type="text" name="birthdate" required class="date" readonly/>

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="text-bold">{{ __('VCA Vervaldatum') }}</label>

                        <input type="text" name="vca_expiry_date" required class="date" readonly/>

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="text-bold">{{ __('Werkzaam sinds') }}</label>

                        <input type="text" name="working_since" required class="date" readonly/>

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="text-bold">{{__('Onderaannemer')}}</label>

                        <label class="radio-inline">

                            <input type="radio" name="is_subcontractor" value="0">{{__('No')}}

                        </label>

                        <label class="radio-inline">

                            <input type="radio" name="is_subcontractor" value="1" checked>{{__('Yes')}}

                        </label>

                    </div>

                </div>

                <div class="modal-footer">

                    <div class="col-12 form-group pr-3 pl-3">

                        <div class="row">

                            <div class="col-12 text-center">

                                <button type="submit" class="btn btn-primary">

                                    {{__('Opslaan')}}

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



@endsection



@push('scripts')

<script type="text/javascript">

    $(document).ready(function() {



        if (window.location.href.indexOf('#formModal') != -1) {

            $('#formModal').modal('show');

        }



        var date = $('.date');

        date.datepicker({

            format: "dd-mm-yyyy",

            autoclose: true,

            todayHighlight: true

        });



        var table_table = $('#employee-table').DataTable({

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

                        select.append('<option value="' + d + '">' + d + '</option>');

                        $('select').selectpicker('refresh');

                    });

                });

            },

            responsive: false,

            fixedHeader: {

                header: true,

                footer: true

            },

            processing: true,

            serverSide: true,

            ajax: {

                url: "{{ route('employees.index') }}",

                type: 'GET',

                data: function(d) {

                    if ($("#company_id_filter").val() !== '') {

                        d.company_id = $("#company_id_filter").val();

                    }

                }

            },



            columns: [



                {

                    data: 'id',

                    orderable: false,

                    searchable: false

                },

                {

                    data: 'organisatie',

                    name: 'organisatie',



                },

                {

                    data: 'achternaam',

                    name: 'achternaam',

                },

                {

                    data: 'initialen',

                    name: 'initialen',

                },

                {

                    data: 'toevoeging',

                    name: 'toevoeging',

                },

                {

                    data: 'tussenvoegsel',

                    name: 'tussenvoegsel',

                },

                {

                    data: 'geboortedatum',

                    name: 'geboortedatum',

                },

                {

                    data: 'geboorteplaats',

                    name: 'geboorteplaats',

                },

                {

                    data: 'aktief',

                    name: 'aktief',

                },

                {

                    data: 'in_dienst',

                    name: 'in_dienst',

                },

                {

                    data: 'indienst_sinds',

                    name: 'indienst_sinds',

                },

                {

                    data: 'is_onderaannemer',

                    name: 'is_onderaannemer',

                },

                {

                    data: 'onderaannemer_sinds',

                    name: 'onderaannemer_sinds',

                },

                /*

                {

                    data: 'vevaldatum_vca',

                    name: 'vevaldatum_vca',

                },

                {

                    data: 'vervaldatum_glasmonteur',

                    name: 'vervaldatum_glasmonteur',

                },

                {

                    data: 'vervaldatum_glaszetter',

                    name: 'vervaldatum_glaszetter',

                },*/

                {

                    data: 'action',

                    name: 'action',

                    orderable: false

                }

            ],





            "order": [],

            'language': {

                'lengthMenu': '_MENU_ {{__("records per page ")}}',

                "info": '{{__("Showing")}} _START_ - _END_ (_TOTAL_)',

                "search": '{{__("Search")}}',

                'paginate': {

                    'previous': '{{__("Previous")}}',

                    'next': '{{__("Next")}}'

                }

            },

            'columnDefs': [{

                    "orderable": false,

                    'targets': [0, 4],

                    "className": "text-left"

                },

                {

                    'render': function(data, type, row, meta) {

                        if (type == 'display') {

                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>';

                        }



                        return data;

                    },

                    'checkboxes': {

                        'selectRow': true,

                        'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>'

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

        new $.fn.dataTable.FixedHeader(table_table);



    });





    //-------------- Filter -----------------------



    $('#filterSubmit').on("click", function(e) {

        $('#employee-table').DataTable().draw(true);

        //$('#filter_form')[0].reset();

        //$('select').selectpicker('refresh');

    });

    //--------------/ Filter ----------------------





    $('#create_record').click(function() {



        $('.modal-title').text("Werknemer toevoegen");

        $('#action_button').val("{{__('Toevoegen ')}}");

        $('#action').val("{{__('Toevoegen ')}}");

        $('#formModal').modal('show');

    });



    $('#sample_form').on('submit', function(event) {

        event.preventDefault();

        // var attendance_type = $("#attendance_type").val();

        // console.log(attendance_type);



        $.ajax({

            url: "{{ route('employees.store') }}",

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

                    html = '<div class="alert alert-danger">' + data.error + '</div>';

                }

                if (data.success) {

                    html = '<div class="alert alert-success">' + data.success + '</div>';

                    $('#sample_form')[0].reset();

                    $('select').selectpicker('refresh');

                    $('.date').datepicker('update');

                    $('#employee-table').DataTable().ajax.reload();

                }

                $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);

            }

        });

    });



    $('#createEmployeeRequestForm').on('submit', function(event) {

        event.preventDefault();

        $.ajax({

            url: "{{ route('employee-request.store') }}",

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

                    html = '<div class="alert alert-danger">' + data.error + '</div>';

                }

                if (data.success) {

                    html = '<div class="alert alert-success">' + data.success + '</div>';

                    $('#createEmployeeRequestForm')[0].reset();

                    $('select').selectpicker('refresh');

                    $('.date').datepicker('update');

                    $('#employee-table').DataTable().ajax.reload();

                }

                $('#form_result_request').html(html).slideDown(300).delay(5000).slideUp(300);

            },

            error: function(e) {

                var html = '<div class="alert alert-danger">';

                Object.keys(e.responseJSON.errors).forEach(function(i, v) {

                    console.log(e.responseJSON.errors[i][0], v)

                    html += '<p>' + e.responseJSON.errors[i][0] + '</p>';

                })

                html += '</div>';

                $('#form_result_request').html(html).slideDown(300).delay(5000).slideUp(300);

            }

    });

    });





    let employee_delete_id;



    $(document).on('click', '.delete', function() {

        employee_delete_id = $(this).attr('id');

        $('#confirmModal').modal('show');

        $('.modal-title').text("{{__('DELETE Record')}}");

        $('#ok_button').text("{{__('OK')}}");



    });



    // $(document).on('click', '#create_employee_request', function() {

    //     $('#createEmployeeRequest').modal('show');

    // });





    $(document).on('click', '#bulk_delete', function() {



        var id = [];

        let table = $('#employee-table').DataTable();

        id = table.rows({

            selected: true

        }).ids().toArray();

        if (id.length > 0) {

            if (confirm("{{__('Delete Selection',['key'=>__('Employee')])}}")) {

                $.ajax({

                    url: "{{route('mass_delete_employees')}}",

                    method: 'POST',

                    data: {

                        employeeIdArray: id

                    },

                    success: function(data) {

                        if (data.success) {

                            html = '<div class="alert alert-success">' + data.success + '</div>';

                        }

                        if (data.error) {

                            html = '<div class="alert alert-danger">' + data.error + '</div>';

                        }

                        table.ajax.reload();

                        table.rows('.selected').deselect();

                        $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);



                    }



                });

            }

        } else {

            alert("{{__('Please select atleast one checkbox ')}}");

        }

    });





    $('#close').click(function() {

        $('#sample_form')[0].reset();

        $('select').selectpicker('refresh');

        $('.date').datepicker('update');

        $('#employee-table').DataTable().ajax.reload();

    });



    $('#ok_button').click(function() {

        let target = "{{ route('employees.index') }}/" + employee_delete_id + '/delete';

        $.ajax({

            url: target,

            beforeSend: function() {

                $('#ok_button').text("{{__('Deleting...')}}");

            },

            success: function(data) {

                if (data.success) {

                    html = '<div class="alert alert-success">' + data.success + '</div>';

                }

                if (data.error) {

                    html = '<div class="alert alert-danger">' + data.error + '</div>';

                }

                setTimeout(function() {

                    $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);

                    $('#confirmModal').modal('hide');

                    $('#employee-table').DataTable().ajax.reload();

                }, 2000);

            }

        })

    });









    $('#confirm_pass').on('input', function() {



        if ($('input[name="password"]').val() != $('input[name="password_confirmation"]').val())

            $("#divCheckPasswordMatch").html("{{__('Password does not match! please type again')}}");

        else

            $("#divCheckPasswordMatch").html("{{__('Password matches!')}}");



    });





    $('.dynamic').change(function() {

        if ($(this).val() !== '') {

            let value = $(this).val();

            let dependent = $(this).data('dependent');

            let _token = $('input[name="_token"]').val();

            $.ajax({

                url: "{{ route('dynamic_department') }}",

                method: "POST",

                data: {

                    value: value,

                    _token: _token,

                    dependent: dependent

                },

                success: function(result) {



                    $('select').selectpicker("destroy");

                    $('#department_id').html(result);

                    $('select').selectpicker();



                }

            });

        }

    });





    $('.dynamic').change(function() {

        if ($(this).val() !== '') {

            let value = $(this).val();

            let dependent = $(this).data('shift_name');

            let _token = $('input[name="_token"]').val();

            $.ajax({

                url: "{{ route('dynamic_office_shifts') }}",

                method: "POST",

                data: {

                    value: value,

                    _token: _token,

                    dependent: dependent

                },

                success: function(result) {

                    $('select').selectpicker("destroy");

                    $('#office_shift_id').html(result);

                    $('select').selectpicker();

                }

            });

        }

    });



    $('.designation').change(function() {

        if ($(this).val() !== '') {

            let value = $(this).val();

            let designation_name = $(this).data('designation_name');

            let _token = $('input[name="_token"]').val();

            $.ajax({

                url: "{{ route('dynamic_designation_department') }}",

                method: "POST",

                data: {

                    value: value,

                    _token: _token,

                    designation_name: designation_name

                },

                success: function(result) {

                    $('select').selectpicker("destroy");

                    $('#designation_id').html(result);

                    $('select').selectpicker();



                }

            });

        }

    });





    // Login Type Change

    // $('#login_type').change(function() {

    //     var login_type = $('#login_type').val();

    //     if (login_type=='ip') {

    //         data = '<label class="text-bold">{{__("IP Address")}} <span class="text-danger">*</span></label>';

    //         data += '<input type="text" name="ip_address" id="ip_address" placeholder="Type IP Address" required class="form-control">';

    //         $('#ipField').html(data)

    //     }else{

    //         $('#ipField').empty();

    //     }

    // });







    //--------  Filter  ---------



    // Company--> Department

    $('.dynamic').change(function() {

        if ($(this).val() !== '') {

            let value = $('#company_id_filter').val();

            let dependent = $(this).data('dependent');

            let _token = $('input[name="_token"]').val();

            $.ajax({

                url: "{{ route('dynamic_department') }}",

                method: "POST",

                data: {

                    value: value,

                    _token: _token,

                    dependent: dependent

                },

                success: function(result) {



                    $('select').selectpicker("destroy");

                    $('#department_id_filter').html(result);

                    $('select').selectpicker();



                }

            });

        }

    });



    //Department--> Designation

    $('.designationFilter').change(function() {

        if ($(this).val() !== '') {

            // let value = $(this).val();

            // let value = $('#company_id_filter').val();

            let value = $('#department_id_filter').val();

            let designation_name = $(this).data('designation_name');

            let _token = $('input[name="_token"]').val();

            $.ajax({

                url: "{{ route('dynamic_designation_department') }}",

                method: "POST",

                data: {

                    value: value,

                    _token: _token,

                    designation_name: designation_name

                },

                success: function(result) {

                    $('select').selectpicker("destroy");

                    $('#designation_id_filter').html(result);

                    $('select').selectpicker();



                }

            });

        }

    });



    //Company--> Office Shift

    $('.dynamic').change(function() {

        if ($(this).val() !== '') {

            // let value = $(this).val();

            let value = $('#company_id_filter').val();

            let dependent = $(this).data('shift_name');

            let _token = $('input[name="_token"]').val();

            $.ajax({

                url: "{{ route('dynamic_office_shifts') }}",

                method: "POST",

                data: {

                    value: value,

                    _token: _token,

                    dependent: dependent

                },

                success: function(result) {

                    $('select').selectpicker("destroy");

                    $('#office_shift_id_filter').html(result);

                    $('select').selectpicker();

                }

            });

        }

    });

</script>

@endpush