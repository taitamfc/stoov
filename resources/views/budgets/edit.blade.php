@extends('layout.main')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h2>{{ __('Bewerking') }}</h2>
                    </div>
                    <span id="budget_form_result"></span>
                    <form method="post" id="form_budget" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="_method" id="budget_method" value="PUT" />
                        <div class="row col-6">
                            <div class="col-md-12 form-group">
                                <label>{{ __('Bedrijf') }} <span class="text-danger">*</span></label>
                                <select name="company_id" required class="form-control">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ $budget->company_id === $company->id ? 'selected' : null }}>
                                            {{ $company->organisatie }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Boekjaar') }} <span class="text-danger">*</span></label>
                                <select name="year" required class="form-control">
                                    @foreach (range(2000, 2030) as $year)
                                        <option value="{{ $year }}"
                                            {{ $budget->year == $year ? 'selected' : null }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Budget jaartal') }} <span class="text-danger">*</span></label>
                                <select name="budget_jaartal" required class="form-control">
                                    @foreach (range(2000, 2030) as $year)
                                        <option value="{{ $year }}"
                                            {{ $budget->budget_jaartal == $year ? 'selected' : null }}>
                                            {{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Loonsom opgegeven') }} <span class="text-danger">*</span></label>
                                <input type="radio" name="loonsom_opgegeven" value="0"
                                    {{ $budget->loonsom_opgegeven == '0' ? 'checked' : null }}>{{ __('Nee') }}
                                <input type="radio" name="loonsom_opgegeven" value="1"
                                    {{ $budget->loonsom_opgegeven == '1' ? 'checked' : null }}>{{ __('Ja') }}
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Loonsom euro') }} <span class="text-danger">*</span></label>
                                <input type="text" name="loonsom_euro" id="loonsom_euro"
                                    value="{{ $budget->loonsom_euro }}" class="form-control text-left">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Overheveling budget') }} <span class="text-danger">*</span></label>
                                <input type="text" name="overheveling_budget" id="overheveling_budget" value="{{ $budget->overheveling_budget }}"
                                    class="form-control text-left">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Medewerkers aantal') }} <span class="text-danger">*</span></label>
                                <input type="number" name="medewerkers_aantal" value="{{ $budget->medewerkers_aantal }}"
                                    class="form-control text-left">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Datum opgave') }} <span class="text-danger">*</span></label>
                                <input type="date" name="datum_opgave"
                                    value="{{ formatDate($budget->datum_opgave, 'Y-m-d') }}"
                                    class="form-control text-left">
                            </div>

                            <div class="container">
                                <div class="form-group" align="center">
                                    <button type="submit" class="btn btn-primary">
                                        {{__('Opslaan')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var date = $('.date');
            date.datepicker({
                format: "{{ env('Date_Format_JS ') }}",
                autoclose: true,
                todayHighlight: true
            });
            $('#form_budget').on('submit', function(event) {
                event.preventDefault();
                $('#loonsom_euro').val($('#loonsom_euro').val().replace(/,/g, ''));
                $('#overheveling_budget').val($('#overheveling_budget').val().replace(/,/g, ''));
                $.ajax({
                    url: "{{ route('beschikbare-budgetten-edit', ['id' => $budget->id]) }}",
                    method: "post",
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
                            html = '<div class="alert alert-success">' + data.error +
                                '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success +
                                '</div>';
                        }
                        $('#budget_form_result').html(html).slideDown(300).delay(5000).slideUp(
                            300);
                        loomsomEuroConvertToCurrency();
                        overhevelingBudgetConvertToCurrency();
                    }
                });
            });

            function formatCurrency(total) {
                var neg = false;
                total = parseFloat(total.replace(/,/g, '').replace('.', '').replace(',', '.'));

                if (total < 0) {
                    neg = true;
                    total = Math.abs(total);
                }

                var formattedCurrency = total.toLocaleString('de-DE', { style: 'currency', currency: 'EUR' });

                // Xoá ký tự "€"
                formattedCurrency = formattedCurrency.replace('€', '').trim();

                return formattedCurrency;
            }
            function loomsomEuroConvertToCurrency() {
                $('#loonsom_euro').val(formatCurrency($('#loonsom_euro').val()));
            }
            function overhevelingBudgetConvertToCurrency() {
                $('#overheveling_budget').val(formatCurrency($('#overheveling_budget').val()));
            }
            loomsomEuroConvertToCurrency();
            overhevelingBudgetConvertToCurrency();
            $("#loonsom_euro").on('change', function(){
                loomsomEuroConvertToCurrency()
            });
            $("#overheveling_budget").on('change', function(){
                overhevelingBudgetConvertToCurrency()
            });
        });

        
    </script>
@endpush
