@extends('layout.main')
@section('content')
<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h2>{{ __('Detail') }}</h2>
                </div>
                <span id="form_result"></span>
                <form method="post" id="basic_sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_method" value="put">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Achternaam') }} <span class="text-danger">*</span></label>
                        <p>{{ $detail->last_name ?? "" }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Naam') }} <span class="text-danger">*</span></label>
                        <p>{{ $detail->first_name ?? "" }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Geboortedatum') }} <span class="text-danger">*</span></label>
                        <p>{{ $detail->birthdate ?  \Carbon\Carbon::parse($detail->birthdate)->format('d-m-Y') : "" }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{__('Berdrijf')}} <span class="text-danger">*</span></label>
                        <p>{{ $detail->client->company->organisatie ?? "" }}</p>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{__('Status')}} <span class="text-danger">*</span></label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0" {{ $detail->status == '0' ? "checked" : null }}>{{__('In behandeling')}}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" {{ $detail->status == '1' ? "checked" : null }}>{{__('Afgerond')}}
                        </label>
                    </div>
                    @if(count($employees))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">{{ __('Achternaam') }}</th>
                                <th scope="col">{{ __('Naam') }}</th>
                                <th scope="col">{{ __('Geboortedatum') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <th scope="row"><input type="radio" name="company_id" value="{{ $detail->client->company_id }}"/></th>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->date_of_birth }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    <div class="col-12 form-group pr-3 pl-3">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" onclick="history.back();" class="btn w-100">{{__('Terug')}}</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">
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
            format: "{{ env('Date_Format_JS')}}",
            autoclose: true,
            todayHighlight: true
        });
    })

    $('#basic_sample_form').on('submit', function(event) {
        event.preventDefault();
        var attendance_type = $("#attendance_type").val();
        $.ajax({
            url: "{{ route('employee-request.update', $detail->id) }}",
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
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                }
                $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
            }
        });
    });
</script>
@endpush