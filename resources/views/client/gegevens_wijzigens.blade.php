@extends('layout.main')
@section('content')
<section>
    <div class="container-fluid"><span id="general_result"></span></div>
    <div class="container-fluid mb-3">
        <button class="btn btn-info" type="button" id="create_employee_request" data-toggle="modal" data-target="#createModal">
            <i class="fa fa-plus"></i> {{__('Nieuw toevoegen')}}
        </button>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table ">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('Relatienummer') }}</th>
                    <th>{{ __('Naam Bedrijf') }}</th>
                    <th>{{ __('Uw Naam') }}</th>
                    <th>{{ __('Emailadres') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</section>
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('Confirmation')}}</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">{{__('Are you sure you want to remove this data?')}}</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{ __('OK')}}</button>
                <button type="button" class="close btn-default" data-dismiss="modal">{{ __('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{__('Nieuw toevoegen')}}</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <span id="form_result_request"></span>
            <form method="post" id="createModalForm" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Relatienummer') }} <span class="text-danger">*</span></label>
                        <input type="text" name="relatienummer" required />
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Naam bedrijf') }} <span class="text-danger">*</span></label>
                        <input type="text" name="naam_bedrijf" required />
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Uw Naam') }} <span class="text-danger">*</span></label>
                        <input type="text" name="uw_naam" required />
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Emailadres') }} <span class="text-danger">*</span></label>
                        <input type="text" name="emailadres" required />
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
            format: "{{ env('Date_Format_JS ')}}",
            autoclose: true,
            todayHighlight: true
        });

        var table_table = $('#data-table').DataTable({
            initComplete: function() {},
            responsive: false,
            fixedHeader: {
                header: true,
                footer: true
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('client.gegevens-wijzigens.index') }}",
                type: 'GET',
                data: function(d) {
                }
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
                    data: 'naam_bedrijf',
                    name: 'naam_bedrijf',
                },
                {
                    data: 'uw_naam',
                    name: 'uw_naam',
                },
                {
                    data: 'emailadres',
                    name: 'emailadres',
                }
            ],
            "order": [],
            'language': {
                'lengthMenu': "_MENU_ {{__('records per page ')}}",
                "info": '{{ __("Showing")}} _START_ - _END_ (_TOTAL_)',
                "search": '{{ __("Search")}}',
                'paginate': {
                    'previous': '{{ __("Previous")}}',
                    'next': '{{ __("Next")}}'
                }
            },
            'columnDefs': [{
                    "orderable": false,
                    'targets': [0, 1],
                    "className": "text-left"
                },
                {
                    'render': function(data, type, row, meta) {
                        return data;
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
        $('#createModalForm').on('submit', function(event) {
            event.preventDefault();
                $.ajax({
                    url: "{{ route('client.gegevens-wijzigens.store') }}",
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
                            $('#createModalForm')[0].reset();
                            $('#data-table').DataTable().ajax.reload();
                        }
                        $('#form_result_request').html(html).slideDown(300).delay(5000).slideUp(300);
                    },
                    error: function(e) {
                        var html = '<div class="alert alert-danger">';
                        Object.keys(e.responseJSON.errors).forEach(function(i, v) {
                            html += '<p>' + e.responseJSON.errors[i][0] + '</p>';
                        })
                        html += '</div>';
                        $('#form_result_request').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
            });
        });
    });
</script>
@endpush