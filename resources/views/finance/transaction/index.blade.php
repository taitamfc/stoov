@extends('layout.main')
@section('content')


    <section>


        <div class="container-fluid">
           <h1>{{__('Transaction History')}}</h1>
        </div>

        <div class="table-responsive">
            <table id="transaction-table" class="table ">
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
    </section>



@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {

        "use strict";
        $(document).ready(function () {


            var table_table = $('#transaction-table').DataTable({
                initComplete: function () {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                            $('select').selectpicker('refresh');
                        });
                    });
                },
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transactions.index') }}",
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
                        "orderable": false,
                        'targets': [0, 6],
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
        });
    })(jQuery);
</script>
@endpush
