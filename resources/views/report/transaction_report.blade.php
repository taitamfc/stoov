@extends('layout.main')
@section('content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="wrapper count-title text-center mb-30px ">
                        <div class="box mb-4">
                            <div class="box-header with-border">
                                <h3 class="box-title"> {{__('Transaction Report')}} </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" id="filter_form" class="form-horizontal">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="start_date">{{__('Start Date')}}</label>
                                                        <input class="form-control month_year date"
                                                               placeholder="{{__('Select Date')}}"
                                                               id="start_date" name="start_date" type="text" required>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="end_date">{{__('End Date')}}</label>
                                                        <input class="form-control month_year date"
                                                               placeholder="{{__('Select Date')}}"
                                                               id="end_date" name="end_date" type="text" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-actions">
                                                            <button type="submit" class="filtering btn btn-primary"><i
                                                                        class="fa fa-check-square-o"></i> {{trans('Search')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title text-center"><h3>{{__('Transaction Info')}} <span
                                        id="expense_info"></span></h3></div>


                        <div class="table-responsive">
                            <table id="transaction_report-table" class="table ">
                                <thead>
                                <tr>
                                    <th class="not-exported"></th>
                                    <th>{{trans('Date')}}</th>
                                    <th>{{trans('Account')}}</th>
                                    @if(config('variable.currency_format')=='suffix')
                                        <th>{{trans('Amount')}} ({{config('variable.currency')}})</th>
                                    @else
                                        <th>({{config('variable.currency')}}) {{trans('Amount')}}</th>
                                    @endif
                                    <th></th>
                                    <th>{{trans('Type')}}</th>
                                    <th>{{__('Reference No')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>





@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {
        "use strict";

        $(document).ready(function () {

            let date = $('.date');
            date.datepicker({
                format: "{{ env('Date_Format_JS')}}",
                autoclose: true,
                todayHighlight: true,
            });

        });


        fill_datatable();

        function fill_datatable(filter_start_date = '', filter_end_date = '',category='') {


            let table_table = $('#transaction_report-table').DataTable({

                responsive: true,

                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('report.transaction') }}",
                    data: {
                        filter_start_date: filter_start_date,
                        filter_end_date: filter_end_date,
                        "_token": "{{ csrf_token()}}"
                    },
                },

                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date',
                    },
                    {
                        data: 'account',
                        name: 'account',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        render: function (data) {
                            if ('{{config('variable.currency_format') =='suffix'}}') {
                                return data + ' {{config('variable.currency')}}';
                            } else {
                                return '{{config('variable.currency')}} ' + data;

                            }
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if (data.deposit_reference){
                                return '{{trans('Credit')}}';
                            }
                            else {
                                return '{{trans('Debit')}}';
                            }
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if (data.category == 'transfer'){
                                return '{{trans('Transfer')}}';
                            }
                            else if(data.category){
                                return '{{trans('Income')}}';
                            }
                            else {
                                return '{{trans('Expense')}}';
                            }
                        }
                    },
                    {
                        data: 'ref_no',
                        name: 'ref_no',
                    },
                ],



                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ {{__("records per page")}}',
                    "info": '{{trans("Showing")}} _START_ - _END_ (_TOTAL_)',
                    "search": '{{trans("Search")}}',
                    'paginate': {
                        'previous': '{{trans("Previous")}}',
                        'next': '{{trans("Next")}}'
                    }
                },

                'columnDefs': [
                    {

                        "orderable": true,
                        'targets': [0],
                    },
                    {
                        'render': function (data, type, row, meta) {
                            if (type == 'display') {
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
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


                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: '<"row"lfB>rtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
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
        }

        $('#filter_form').on('submit',function (e) {
            e.preventDefault();
            var filter_start_date = $('#start_date').val();
            var filter_end_date = $('#end_date').val();

            if (filter_start_date !== '' && filter_end_date !== '') {
                $('#transaction_report-table').DataTable().destroy();
                fill_datatable(filter_start_date, filter_end_date);
            } else {
                alert('{{__('Select Both filter option')}}');
            }
        });
    })(jQuery);

</script>

@endpush