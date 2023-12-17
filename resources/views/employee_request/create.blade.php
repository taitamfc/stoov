@extends('layout.main')
@section('content')
<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h2>{{ __('Create') }}</h2>
                </div>
                <span id="form_result"></span>
                <form method="post" id="basic_sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Achternaam') }} <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" required/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Naam') }} <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" required/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="text-bold">{{ __('Geboortedatum') }} <span class="text-danger">*</span></label>
                        <input type="text" name="birthdate" required class="date"/>
                    </div>

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
    $(document).ready(function () {
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
            url: "{{ route('employee-request.store') }}",
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