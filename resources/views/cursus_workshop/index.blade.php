@extends('layout.main')
@section('content')
<section>
    <div class="container-fluid"><span id="general_result"></span></div>
    <div class="container-fluid mb-3">
        <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i> {{__('Add Cursus / Workshop')}}</button>
    </div>
    <div class="table-responsive">
        <table id="table" class="table ">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('Thema') }}</th>
                    <th>{{ __('Cursuscode') }}</th>
                    <th>{{ __('Opleiding') }}</th>
                    <th>{{ __('Percentage') }}</th>
                    <th>{{ __('Verletvergoeding') }}</th>
                    <th>{{ __('Tonen employee') }}</th>
                    <th>{{ __('Is actief') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{__('Add Cursus / Workshop')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="_id">
                    <input type="hidden" name="_method" id="_method">
                    @csrf
                    <div class="row">
                        <div class="row col-12 form-box">
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Thema')}}</label>
                                <input type="text" name="thema" id="thema" placeholder="{{__('thema')}}" required class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Cursuscode')}}</label>
                                <input type="text" name="key" id="key" placeholder="{{__('Cursuscode')}}" required class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Opleiding')}} </label>
                                <input name="value" id="value" placeholder="{{__('Opleiding')}}" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Percentage')}}</label>
                                <input type="number" name="percentage" id="percentage" placeholder="{{__('Percentage')}}" required class="form-control" style="text-align: left;">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Verletvergoeding')}}</label>
                                <input type="text" name="price" id="price" placeholder="{{__('Verletvergoeding')}}" required class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Is actief')}}</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="is_active" id="is_active_0" value="0" checked>{{ __("Vervallen") }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_active" id="is_active_1" value="1" >{{ __("Actief") }}
                                </label>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Tonen employee')}}</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="status_0" value="0" checked>{{ __("No") }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="status_1" value="1" >{{ __("Yes") }}
                                </label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="checkbox" id="vakcertificaat_glaszetten" name="vakcertificaat_glaszetten" value="1"><label class="text-bold">{{__('Vakcertificaat glaszetten')}}</label> 
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="checkbox" id="vakcertificaat_glasmonteur" name="vakcertificaat_glasmonteur" value="1"><label class="text-bold">{{__('Vakcertificaat Glasmonteur')}}</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="checkbox" id="op_termijn_moeten_we_deze_gaan_bijhouden" name="op_termijn_moeten_we_deze_gaan_bijhouden" value="1"><label class="text-bold">{{__('Op termijn moeten we deze gaan bijhouden')}}</label>
                            </div>
                        </div>

                        <div class="container">
                            <div class="form-group" align="center">
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning w-100" value="{{__('Add')}}" />
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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    const formatDate = "{{ env('Date_Format_JS ')}}";
    const menu = "_MENU_ {{__('records per page ')}}";
    $(document).ready(function() {
        if (window.location.href.indexOf('#formModal') != -1) {
            $('#formModal').modal('show');
        }
        var date = $('.date');
        date.datepicker({
            format: formatDate,
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
                url: "{{ route('naam_cursus.index') }}",
                type: 'GET',
                data: function(d) {
                    if ($("#company_id_filter").val() !== '') {
                        d.company_id = $("#company_id_filter").val();
                    }
                }
            },

            columns: [{
                    data: 'id',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'thema',
                    name: 'thema',
                },
                {
                    data: 'key',
                    name: 'key',
                },
                {
                    data: 'value',
                    name: 'value',
                },
                {
                    data: 'percentage',
                    name: 'percentage',
                    
                },
                {
                    data: 'price',
                    name: 'price',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ],
            "order": [],
            'language': {
                'lengthMenu': menu,
                "info": '{{__("Showing")}} _START_ - _END_ (_TOTAL_)',
                "search": '{{__("Search")}}',
                'paginate': {
                    'previous': '{{__("Previous")}}',
                    'next': '{{__("Next")}}'
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

    $('#create_record').click(function() {
        $('.modal-title').text("{{__('Add Cursus / Workshop')}}");
        $('#action_button').val("{{__('Add')}}");
        $('#action').val("{{__('Add')}}");
        $('#formModal').modal('show');
        fillDataForm({});
    });

    $('#sample_form').on('submit', function(event) {
        event.preventDefault();
        setTimeout(() => {
            let id = $("#_id").val();
            $.ajax({
                url: "{{ route('naam_cursus.store') }}/" + id,
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
                        $('select').selectpicker('refresh');
                        $('.date').datepicker('update');
                        $('#table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }
            });
        })

    });

    let delete_id;

    $(document).on('click', '.delete', function() {
        delete_id = $(this).attr('id');
        $('#confirmModal').modal('show');
        $('.modal-title').text("{{__('DELETE Record ')}}");
        $('#ok_button').text("{{__('OK ')}}");
    });

    $('#ok_button').click(function() {
        let target = "{{ route('naam_cursus.index') }}/" + delete_id + '/delete';
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
                    $('#table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });
    //-------------- EDIT -----------------------
    $(document).on("click", "a.btn-edit", function() {
        $('.modal-title').text("{{__('Edit Package')}}");
        $('#action_button').val("{{__('Edit')}}");
        $('#action').val("{{__('Edit')}}");
        $('#formModal').modal('show');
        callAjaxShowDetail($(this).attr("data-id"))
    });
    //--------------/ EDIT -----------------------

    function callAjaxShowDetail(id) {
        $.ajax({
            url: "{{ route('naam_cursus.index') }}/" + id,
            beforeSend: function() {
                $("#action_button").attr("disabled", true);
            },
            success: function(data) {
                fillDataForm(data.data)
            }
        })
    }

    function fillDataForm(data) {
        $("#thema").val(data.thema ?? '');
        $("#price").val(data.price ?? '');
        $("#value").val(data.value ?? '');
        $("#key").val(data.key ?? '');
        $("#percentage").val(data.percentage ?? 0);
        $("#status_1").prop("checked", data.status == 1 ? true : false)
        $("#is_active_1").prop("checked", data.is_active == 1 ? true : false)
        $("#vakcertificaat_glaszetten").prop("checked", data.vakcertificaat_glaszetten == 1 ? true : false)
        $("#vakcertificaat_glasmonteur").prop("checked", data.vakcertificaat_glasmonteur == 1 ? true : false)
        $("#op_termijn_moeten_we_deze_gaan_bijhouden").prop("checked", data.op_termijn_moeten_we_deze_gaan_bijhouden == 1 ? true : false)
        $("#_id").val(data.id ?? '');
        $("#_method").val(data.id ? 'put' : 'post');
        setTimeout(() => {
            $("#action_button").removeAttr("disabled");
        })
    }
</script>
@endpush