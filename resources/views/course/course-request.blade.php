@extends('layout.main')
@section('content')
    <section>
        <div class="container-fluid"><span id="general_result"></span></div>
        <div class="container-fluid mb-3">
            @if (auth()->user()->role_users_id != \App\User::CLIENT)
                <button type="button" class="btn btn-primary" name="bulk_send_mail" id="bulk_send_mail"><i
                        class="fa fa-paper-plane"></i> {{ __('Verzend e-mail') }}</button>
            @endif
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
                                    <label class="text-bold"><strong>{{ __('Year') }}</strong></label>
                                    <input type="text" id="datepicker">
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
            <table id="table" class="table ">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th class="not-exported"></th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Berdrijf') }}</th>
                        <th>{{ __('Website') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Status Sent') }}</th>
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
                    url: "{{ route('course.course-request') }}",
                    type: 'GET',
                    data: function(d) {
                        if ($("#type_filter").val() !== '') {
                            d.type = $("#type_filter").val();
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
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'naam',
                        name: 'naam',

                    },
                    {
                        data: 'organisatie',
                        name: 'organisatie',
                    },
                    {
                        data: 'website',
                        name: 'website',
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'year_sent',
                        name: 'year_sent',
                    },
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
                        url: "{{ route('course.sendMails') }}",
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
        $("#datepicker").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@endpush
