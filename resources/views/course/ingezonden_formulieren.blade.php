@extends('layout.main')
@section('content')
    <section>
        <div class="container-fluid"><span id="general_result"></span></div>
        <div class="container-fluid mb-3">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-filter" aria-hidden="true"></i> Filter
            </button>
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
                                    <label class="text-bold"><strong>{{ __('Titel') }}</strong></label>
                                    <select name="type" id="type_filter" class="form-control dynamic"
                                        data-live-search="true" data-live-search-style="contains">
                                        <option value="">{{ __('Alle') }}</option>
                                        <option value="{{ \App\Course::TYPE_VERLETVERGOEDING }}">
                                            {{ __('Verletvergoeding') }}</option>
                                        <option value="{{ \App\Course::TYPE_OPLEIDINGSVERGOEDING }}">
                                            {{ __('Opleidingsvergoeding') }}</option>
                                        <option value="{{ \App\Course::TYPE_LOONSOMOPGAVE }}">{{ __('Loonsomopgave') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-bold"><strong>{{ __('Aanvraag') }}</strong></label>
                                    <select name="is_approved" id="is_approved_filter" class="form-control dynamic">
                                        <option value="">{{ __('Alle') }}</option>
                                        <option value="0">{{ __('Niet akkoord') }}</option>
                                        <option value="1">{{ __('Akkoord') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-bold"><strong>{{ __('Begin datum') }}</strong></label>
                                    <input name="start_date" id="input_start_date" type="date"
                                        class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized"
                                        placeholder="dd-mm-yyyy" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-bold"><strong>{{ __('Eind datum') }}</strong></label>
                                    <input name="end_date" id="input_end_date" type="date"
                                        class="datepicker dmy_dash datepicker_with_icon gdatepicker_with_icon hasDatepicker initialized"
                                        placeholder="dd-mm-yyyy" />
                                </div>
                            </div>
                            <!--/ Company-->
                            <div class="col-md-1">
                                <label class="text-bold"></label><br>
                                <button type="button" class="btn btn-dark" id="filterSubmit">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; {{__('Zoeken')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Filtering -->
        </div>
        <div class="table-responsive">
            <table id="table" class="table ">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th>{{ __('Id') }}</th>
                        <th>{{ __('Relatienummer') }}</th>
                        <th>{{ __('IBAN nummer') }}</th>
                        <th>{{ __('Inzenddatum') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Aanvraag') }}</th>
                        <th>{{ __('Amount Request') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

            </table>
        </div>
    </section>
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{ __('Confirmation') }}</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">{{ __('Are you sure you want to remove this data?') }}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button"
                        class="btn btn-danger">{{ __('OK') }}</button>
                    <button type="button" class="close btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            console.log($("#input_start_date").val());
            if (window.location.href.indexOf('#formModal') != -1) {
                $('#formModal').modal('show');
            }
            var date = $('.date');
            date.datepicker({
                format: "{{ env('Date_Format_JS ') }}",
                autoclose: true,
                todayHighlight: true
            });

            var table_table = $('#table').DataTable({
                initComplete: function() {},
                responsive: false,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('course.index') }}",
                    type: 'GET',
                    data: function(d) {
                        if ($("#type_filter").val() !== '') {
                            d.type = $("#type_filter").val();
                        }
                        if ($("#is_approved_filter").val() !== '') {
                            d.is_approved = $("#is_approved_filter").val();
                        }
                        if ($("#input_start_date").val()) {
                            d.start_date = $("#input_start_date").val();
                        }
                        if ($("#input_end_date").val()) {
                            d.end_date = $("#input_end_date").val();
                        }
                    }
                },
                columns: [{
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'relatienummer',
                        name: 'relatienummer',
                    },
                    {
                        data: 'iban_nummer',
                        name: 'iban_nummer',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'type',
                        name: 'type',
                    },
                    {
                        data: 'is_watched',
                        name: 'is_watched',
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                    },
                    {
                        data: 'amount_request',
                        name: 'amount_request',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ],
                "order": [],
                'language': {
                    'lengthMenu': "_MENU_ {{ __('records per page ') }}",
                    "info": '{{ __('Showing') }} _START_ - _END_ (_TOTAL_)',
                    "search": '{{ __('Search') }}',
                    'paginate': {
                        'previous': '{{ __('Previous') }}',
                        'next': '{{ __('Next') }}'
                    }
                },
                'columnDefs': [{
                        "orderable": false,
                        'targets': [0, 1],
                        "className": "text-left"
                    },
                    {
                        'render': function(data, type, row, meta) {
                            if (type == 'display') {
                                data =
                                    '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>';
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
                buttons: [],
            });
            new $.fn.dataTable.FixedHeader(table_table);

        });


        //-------------- Filter -----------------------

        $('#filterSubmit').on("click", function(e) {
            $('#table').DataTable().draw(true);
        });
        //--------------/ Filter ----------------------

        $(document).on('click', '#bulk_send_mail', function() {

            var id = [];
            let table = $('#table').DataTable();
            id = table.rows({
                selected: true
            }).ids().toArray();
            if (id.length > 0) {
                if (confirm("{{ __('Confirm send mail ') }}")) {
                    $.ajax({
                        url: '',
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
                alert("{{ __('Please select atleast one checkbox ') }}");
            }
        });
    </script>
@endpush
