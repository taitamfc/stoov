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
                            <div class="col-md-12 form-group">
                                {{ @$client->company->organisatie }} heeft nog een beschikbaar
                                opleidingsbudget van
                                {{ getNumberFormat($remaining_budget ?? 0) }}
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <label class="text-bold">{{ __('Datum bewerkt') }}</label>
                            <p>{{ @formatDate($course->updated_at) }}</p>
                        </div>
                        <div class="col-12 form-group">
                            <label class="text-bold">{{ __('Actueel budget') }}</label>
                            <p>{{ getNumberFormat($remaining_budget ?? 0) }}</p>
                        </div>
                        <div class="col-12 row">
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{ __('Aanvraag') }} <span class="text-danger">*</span></label>
                                @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                                    @foreach (\App\Course::APPROVED_LIST as $index => $approved)
                                        <label class="radio-inline">
                                            <input type="radio" name="is_approved" value="{{ $index }}"
                                                {{ @$course->is_approved == $index ? 'checked' : null }}>{{ __($approved) }}
                                        </label>
                                    @endforeach
                                @else
                                    <p>{{ @__(\App\Course::APPROVED_LIST[$course->is_approved]) }}</p>
                                @endif
                            </div>
                            <div class="col-2">
                                @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Opslaan') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        @if (@$course->type !== \App\Course::TYPE_LOONSOMOPGAVE)
                            <div class="col-6 form-group d-none" id="box-reden">
                                <label class="text-bold">{{ __('Reden') }}</label>
                                <p><input type="text" name="reden" id="reden" value="{{ @$course->reden }}"></p>
                            </div>
                        @endif
                        <div class="col-12 row">
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{ __('Amount Request') }}</label>
                                <p>{{ @getNumberFormat($course->amount_request ?? 0) }}</p>
                            </div>
                            <div class="col-2">
								@if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                                <a type="button" class="btn btn-info w-100 mt-3"
                                    href="{{ route('course.edit', ['id' => @$course->id]) }}">
                                    {{ __('Bewerken') }}
                                </a>
								@endif
                            </div>
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
                                        <p>{{ @formatDate($course->created_at) }}</p>
                                    </div>
                                @elseif($name === 'full_name')
                                    <div class="col-md-6 form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="text-bold">{{ __('Voornaam') }}</label>
                                                <p>{{ @$fields['first_name'] }}</p>
                                            </div>
                                            <div class="col-4">
                                                <label class="text-bold">{{ __('Tussenvoegsel') }}</label>
                                                <p>{{ @$fields['middle_name'] }}</p>
                                            </div>
                                            <div class="col-4">
                                                <label class="text-bold">{{ __('Achternaam') }}</label>
                                                <p>{{ @$fields['last_name'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($name === 'medewerker' && @$fields['medewerker'])
                                    <div class="col-md-6 form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="text-bold">{{ __('Voornaam') }}</label>
                                                <p>{{ @$fields['medewerker']['first_name'] }}</p>
                                            </div>
                                            <div class="col-4">
                                                <label class="text-bold">{{ __('Tussenvoegsel') }}</label>
                                                <p>{{ @$fields['medewerker']['middle_name'] }}</p>
                                            </div>
                                            <div class="col-4">
                                                <label class="text-bold">{{ __('Achternaam') }}</label>
                                                <p>{{ @$fields['medewerker']['last_name'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($name === 'first_name')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Voornaam') }}</label>
                                        <p>{{ @$fields['first_name'] }}</p>
                                    </div>
                                @elseif($name === 'middle_name')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Tussenvoegsel') }}</label>
                                        <p>{{ @$fields['middle_name'] }}</p>
                                    </div>
                                @elseif($name === 'last_name')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Achternaam') }}</label>
                                        <p>{{ @$fields['last_name'] }}</p>
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
                                        <p>{{ @$fields[$name] }}</p>
                                    </div>
                                @elseif($name === 'id')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Id') }}</label>
                                        <p>{{ @$course->id }}</p>
                                    </div>
                                @elseif($name === 'datum_tot')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Datum tot') }}</label>
                                        <p>{{ @formatDate(@$fields[$name]) }}</p>
                                    </div>
                                @elseif($name === 'datum_cursus_van')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __('Datum cursus van') }}</label>
                                        <p>{{ @formatDate(@$fields[$name]) }}</p>
                                    </div>
                                @elseif($name === 'subsidiepercentage_dat_van_toepassing_is')
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $name))) }}</label>
                                        <p>{{ @$fields[$name] . '%' }}</p>
                                    </div>
                                @elseif($name === 'deelnemerslijst' || $name === 'factuur' || $name === 'certificaat')
                                    <?php
                                    $deelnemerslijst = explode('/', @$fields[$name]);
                                    ?>
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $name))) }}</label>
                                        <p>
                                            <a target="_blank" href="{{ @$fields[$name] }}">{{ removeExtension($deelnemerslijst[count($deelnemerslijst) - 1]) }}</a>
                                        </p>
                                    </div>
                                @else
                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $name))) }}</label>
                                        <p>{{ @$fields[$name] }}</p>
                                    </div>
                                @endif
                            @endforeach
                            <div class="col-12">
                                @php
                                    $filedNameArray = 'data_deelnemerslijst';
                                    $key = 1;
                                @endphp
                                @foreach (@$fields[$filedNameArray] ?? [] as $arrayIndex => $arrayValue)
                                    
                                    <label
                                        class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $filedNameArray))) . ' ' . ($key) }}
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
                                    @php
                                    $key++;
                                    @endphp
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
        function showBoxReden() {
            var value = $("input[name=is_approved]:checked").val();
            if (value == 0) {
                $("#box-reden").removeClass('d-none');
            } else {
                $("#box-reden").addClass('d-none');
            }
        }
        showBoxReden();
        $("input[name=is_approved]").change(function() {
            showBoxReden();
        });
        $('#basic_sample_form').on('submit', function(event) {
            event.preventDefault();
            var attendance_type = $("#attendance_type").val();
            $.ajax({
                url: "{{ route('course.update', @$course->id) }}",
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
