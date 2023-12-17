@extends('layout.main')
@section('content')
<section>
    <div class="container-fluid"><span id="general_result"></span></div>
    <div class="table-responsive">
        <table id="table" class="table ">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('Achternaam') }}</th>
                    <th>{{ __('Naam') }}</th>
                    <th>{{ __('Geboortedatum') }}</th>
                    <th>{{ __('Berdrijf') }}</th>
                    <th>{{ __('Status') }}</th>
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
                url: "{{ route('employee-request.index') }}",
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
                    data: 'last_name',
                    name: 'last_name',
                },
                {
                    data: 'first_name',
                    name: 'first_name',
                },
                {
                    data: 'birthdate',
                    name: 'birthdate',
                },
                {
                    data: 'company',
                    name: 'company',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'action',
                    name: 'action',
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
            buttons: [],
        });
        new $.fn.dataTable.FixedHeader(table_table);

    });


    //-------------- Filter -----------------------

    $('#filterSubmit').on("click", function(e) {
        $('#table').DataTable().draw(true);
    });
    //--------------/ Filter ----------------------

</script>
@endpush