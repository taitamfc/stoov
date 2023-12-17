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
                    <form method="post" id="basic_sample_form" class="form-horizontal" enctype="multipart/form-data"
                        autocomplete="off">
                        <input type="hidden" name="_method" value="put">
                        @csrf
                       
                        <div class="col-12 row">
                            <div class="col-6 form-group">
                                <label class="text-bold">{{ __('Datum bewerkt') }}</label>
                                <p>{{ formatDate($course->updated_at) }}</p>
                            </div>
                        </div>
                        <div class="col-6 form-group" id="box-reden">
                            <label class="text-bold">{{ __('Reden') }}</label>
                            <p>{{ @$fields['reden'] ? \App\Course::REDENS[$fields['reden']] : @$fields['reden_other'] }}</p>
                        </div>
                        <div class="col-6 form-group" id="box-reden">
                            <label class="text-bold">{{ __('Boekjaar') }}</label>
                            <p>{{ $course->boekjaar }}</p>
                        </div>
                        <div class="row col-12">
                            @foreach ($nameFields as $name)
                                @if ($name === 'relatienummer')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Relatienummer') }}</label>
                                        <p>{{ $course->relatienummer }}</p>
                                    </div>
                                @elseif($name === 'inzenddatum')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Inzenddatum') }}</label>
                                        <p>{{ formatDate($course->created_at) }}</p>
                                    </div>
                                @elseif($name === 'full_name')
                                <div class="col-md-6 form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="text-bold">{{ __('Voornaam') }}</label>
                                            <p>{{ @$fields['first_name'] ?? null }}</p>
                                        </div>
                                        <div class="col-4">
                                            <label class="text-bold">{{ __('Tussenvoegsel') }}</label>
                                            <p>{{ @$fields['middle_name'] ?? null }}</p>
                                        </div>
                                        <div class="col-4">
                                            <label class="text-bold">{{ __('Achternaam') }}</label>
                                        <p>{{ @$fields['last_name'] ?? null }}</p>
                                        </div>
                                    </div>
                                </div>
                                @elseif($name === 'first_name')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Voornaam') }}</label>
                                        <p>{{ @$fields['first_name'] ?? null }}</p>
                                    </div>
                                @elseif($name === 'middle_name')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Tussenvoegsel') }}</label>
                                        <p>{{ @$fields['middle_name'] ?? null }}</p>
                                    </div>
                                @elseif($name === 'last_name')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Achternaam') }}</label>
                                        <p>{{ @$fields['last_name'] ?? null }}</p>
                                    </div>
                                @elseif($name === 'loonsom' || $name === 'totaalbedrag_subsidie_aanvraag')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $name))) }}</label>
                                        <p>{{ @$fields[$name] ? getNumberFormat(@$fields[$name], 2) : null }}</p>
                                    </div>
                                @elseif($name === 'personeel_in_loondienst')
                                    <div class="col-md-6 form-group">
                                        <label
                                            class="text-bold">{{ __('Personeel in loondienst gehad van (datum)') }}</label>
                                        <p>{{ @$fields[$name] ?? null }}</p>
                                    </div>
                                @elseif($name === 'id')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Id') }}</label>
                                        <p>{{ $course->id }}</p>
                                    </div>
                                @elseif($name === 'datum_tot')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Datum tot') }}</label>
                                        <p>{{ formatDate(@$fields[$name] ?? null) }}</p>
                                    </div>
                                @elseif($name === 'datum_cursus_van')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Datum cursus van') }}</label>
                                        <p>{{ formatDate(@$fields[$name] ?? null) }}</p>
                                    </div>
                                @elseif($name === 'subsidiepercentage_dat_van_toepassing_is')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $name))) }}</label>
                                        <p>{{ (@$fields[$name] ?? null) . '%' }}</p>
                                    </div>
                                @else
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $name))) }}</label>
                                        <p>{{ @$fields[$name] ?? null }}</p>
                                    </div>
                                @endif
                            @endforeach
                            <div class="col-12">
                                @php
                                    $filedNameArray = 'data_deelnemerslijst';
                                @endphp
                                @foreach (@$fields[$filedNameArray] ?? [] as $arrayIndex => $arrayValue)
                                    <label
                                        class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $filedNameArray))) . ' ' . $arrayIndex }}
                                    </label>
                                    <div class="row">
                                        @foreach ($arrayValue as $fieldArrayName => $fieldValue)
                                            <div class="col-md-4 form-group">
                                                <label
                                                    class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $fieldArrayName))) }}</label>
                                                <p>{{ $fieldValue }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                <div class="col-12 form-group pr-3 pl-3">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" onclick="history.back();" class="btn w-100">{{ __('Terug') }}</button>
                        </div>
                        <div class="col-6">
                            @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Opslaan') }}
                                </button>
                            @endif
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
        // function showBoxReden() {
        //     var value = $("input[name=is_approved]:checked").val();
        //     if (value == 0) {
        //         $("#box-reden").removeClass('d-none');
        //     } else {
        //         $("#box-reden").addClass('d-none');
        //     }
        // }
        // showBoxReden();
        // $("input[name=is_approved]").change(function() {
        //     showBoxReden();
        // });
        $('#basic_sample_form').on('submit', function(event) {
            event.preventDefault();
            var attendance_type = $("#attendance_type").val();
            $.ajax({
                url: "{{ route('course.update', $course->id) }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.error) {
                        html = '<div class="alert alert-danger">';
                        html += '<p style="color: red">' + data.error + '</p>';
                        html += '</div>';

                    }
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p style="color: red">' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    setTimeout(() => {
                        location.reload();
                    }, 5000);
                }
            });
        });
    </script>
@endpush
