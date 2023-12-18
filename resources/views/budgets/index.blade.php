@extends('layout.main')
@section('content')
    <section>
        <div class="table-responsive">
            <div class="year-filter">
                <label class="year-filter-label">{{ __('Bedrijf') }}</label>
                <select name="year" id="year" required class="form-control">
                    @foreach (range(2022, 2030) as $year)
                        <option value="{{ $year }}" @if($year === now()->year) selected @endif>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <table id="budget-table" class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Relatienummer') }}</th>
                        <th scope="col">{{ __('Bedrijf') }}</th>
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
                        <th scope="col">{{ __('Remaining budget') }}</th>
                        <th scope="col">{{ __('action') }}</th>
                    </tr>
                </thead>
            </table>
            </table>
        </div>
    </section>
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
                $('#budget-table').DataTable({
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
                        url: "{{ route('beschikbare-budgetten') }}",
                        type: 'GET',
                        data: function(d) {
                            if ($("#year").val() !== '') {
                                d.year = $("#year").val();
                            }
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
                            data: 'bedrijf',
                            name: 'bedrijf',
                        },
                        {
                            data: 'year',
                            name: 'year',
                        },
                        {
                            data: 'budget_jaartal',
                            name: 'budget_jaartal'
                        },
                        {
                            data: 'loonsom_opgegeven',
                            name: 'loonsom_opgegeven'
                        },
                        {
                            data: 'overheveling_budget',
                            name: 'overheveling_budget',
                        },
                        {
                            data: 'loonsom_euro',
                            name: 'loonsom_euro',
                        },
                        {
                            data: 'medewerkers_aantal',
                            name: 'medewerkers_aantal'
                        },
                        {
                            data: 'datum_opgave',
                            name: 'datum_opgave'
                        },
                        {
                            data: 'premie',
                            name: 'premie',
                        },
                        {
                            data: 'vakbondsbijdr',
                            name: 'vakbondsbijdr',
                        },
                        {
                            data: 'opleidingsbudget',
                            name: 'opleidingsbudget'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'remainingBudget',
                            name: 'remainingBudget'
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
            $('#year').on("change", function(e) {
                $('#budget-table').DataTable().draw(true);
            });
        })(jQuery);
    </script>
@endpush
