@extends('layout.main')
@section('content')
<style>
    .nav-tabs li a {
        padding: 0.75rem 1.25rem;
    }

    .nav-tabs.vertical li {
        border: 1px solid #ddd;
        display: block;
        width: 100%
    }

    .tab-pane {
        padding: 15px 0
    }
</style>
<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h2>{{$employee->addition_name}}</h2>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="general-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">{{ $employee->initialen }} {{ $employee->achternaam }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Profile" role="tab" aria-controls="Profile" aria-selected="false">{{__('Vakcertificaat')}}</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="general-tab">



                        <!--Contents for General starts here-->
                        <span id="form_result"></span>
                        <form method="post" id="basic_sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Relaties</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Formulier: Organisatie</strong></div>
                                                <div class="col-md-6"> <input type="hidden" name="company_id_hidden" value="{{ implode(',', $employee->companies->pluck('id')->toArray()) }}" />
                                                    <select disabled name="company_ids[]" multiple id="company_id" class="form-control selectpicker dynamic" data-live-search="true" data-live-search-style="contains" data-dependent="department_name" data-shift_name="shift_name" title="{{__('Selecting',['key'=> __('Compan y')])}}...">
                                                        @foreach($companies as $company)
                                                        <option value="{{$company->id}}">{{$company->organisatie}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingOne" style="background: #31a836;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Medewerker gegevens</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Initialen </strong></div>
                                                <div class="col-md-6"><input type="text" name="initialen" id="initialen" placeholder="{{__('Initialen')}}" required class="form-control" value="{{ $employee->initialen }}"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Achternaam </strong></div>
                                                <div class="col-md-6"><input type="text" name="achternaam" id="achternaam" placeholder="{{__('achternaam')}}" required class="form-control" value="{{ $employee->achternaam }}"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Geboortedatum </strong></div>
                                                <div class="col-md-6"> <input type="text" name="geboortedatum" id="geboortedatum" required autocomplete="off" class="form-control date" value="{{ $employee->geboortedatum ? date(env('Date_Format'), strtotime($employee->geboortedatum)) : null }}"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Geboorteplaats </strong></div>
                                                <div class="col-md-6"><input type="text" name="geboorteplaats" id="geboorteplaats" placeholder="{{__('Geboorteplaats')}}" required class="form-control" value="{{ $employee->geboorteplaats }}"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Datum gegevens </strong></div>
                                                <div class="col-md-6"><input type="text" name="geboorteplaats" id="geboorteplaats" placeholder="{{__('Geboorteplaats')}}" required class="form-control" value="{{ $employee->geboorteplaats }}"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Actief</strong></div>
                                                <div class="col-md-6">
                                                    @if ($employee->aktief == 0)
                                                    <input type="checkbox" name="aktief" id="">
                                                    @else
                                                    <input type="checkbox" checked name="aktief" id="">
                                                    @endif
                                                    <!-- <label class="radio-inline">
                                                        <input type="radio" name="aktief" value="0" {{ $employee->aktief == 0 ? "checked" : null }}>{{__('No')}}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="aktief" value="1" {{ $employee->aktief == 1 ? "checked" : null }}>{{__('Yes')}}
                                                    </label> -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>In dienst</strong></div>
                                                <div class="col-md-6">
                                                    @if ($employee->in_dienst == 0)
                                                    <input type="checkbox" name="in_dienst" id="">
                                                    @else
                                                    <input type="checkbox" checked name="in_dienst" id="">
                                                    @endif
                                                    <!-- <label class="radio-inline">
                                                        <input type="radio" name="in_dienst" value="0" {{ $employee->in_dienst == 0 ? "checked" : null }}>{{__('No')}}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="in_dienst" value="1" {{ $employee->in_dienst == 1 ? "checked" : null }}>{{__('Yes')}}
                                                    </label> -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>onderaannemer</strong></div>
                                                <div class="col-md-6">
                                                    @if ($employee->is_onderaannemer == 0)
                                                    <input type="checkbox" name="is_onderaannemer" id="">
                                                    @else
                                                    <input type="checkbox" checked name="is_onderaannemer" id="">
                                                    @endif
                                                    <!-- <label class="radio-inline">
                                                        <input type="radio" name="is_onderaannemer" value="0" {{ $employee->is_onderaannemer == 0 ? "checked" : null }}>{{__('No')}}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_onderaannemer" value="1" {{ $employee->is_onderaannemer == 1 ? "checked" : null }}>{{__('Yes')}}
                                                    </label> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header" id="headingOne" style="background: #31a836;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Vervaldata</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldata VCA </strong></div>
                                                <div class="col-md-6"><input type="text" name="vevaldatum_vca" id="vevaldatum_vca" required autocomplete="off" class="form-control date" value="{{ $employee->vevaldatum_vca ? date(env('Date_Format'), strtotime($employee->vevaldatum_vca)) : null }}"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldatum glasmonteur</strong></div>
                                                <div class="col-md-6"> <input type="text" name="vervaldatum_glaszetter" id="vervaldatum_glaszetter" required autocomplete="off" class="form-control date" value="{{ $employee->vervaldatum_glaszetter ? date(env('Date_Format'), strtotime($employee->vervaldatum_glaszetter)) : null }}"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldata Glaszetter</strong></div>
                                                <div class="col-md-6"><input type="text" name="vervaldatum_glasmonteur" id="vervaldatum_glasmonteur" required autocomplete="off" class="form-control date" value="{{ $employee->vervaldatum_glasmonteur ? date(env('Date_Format'), strtotime($employee->vervaldatum_glasmonteur)) : null }}"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div> -->

                            </div>
                        </form>
                        <!--Contents for General Ends here-->
                    </div>
                    <div class="tab-pane fade" id="Profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div>
                            <div class="btn-pdf">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        @if (@$certifications[0]['vervaldatum_vca'] > \Carbon\Carbon::now()&& $certifications[0]['datum_uitgifte_vca'] < \Carbon\Carbon::now()) @if ($certifications[0]['gewenste_certificatie']==='Beide' ) 
                                            <a href="{{ route('glasMonteren', $certifications[0]['id']) }}" class="btn btn-primary">{{ __('GLAS MONTEREN') }}</a>
                                            <a href="{{ route('glaszetten', $certifications[0]['id']) }}" class="btn btn-primary">{{ __('GLASZETTEN') }}</a>
                                            @elseif (@$certifications[0]['gewenste_certificatie'] === 'Glasmonteur')
                                            <a href="{{ route('glasMonteren', $certifications[0]['id']) }}" class="btn btn-primary">{{ __('GLAS MONTEREN') }}</a>
                                            @elseif (@$certifications[0]['gewenste_certificatie'] === 'Glaszetter')
                                            <a href="{{ route('glaszetten', $certifications[0]['id']) }}" class="btn btn-primary">{{ __('GLASZETTEN') }}</a>
                                            @endif
                                            @if (@$certifications[0]['vervaldatum_vca'] < \Carbon\Carbon::now() ) 
                                            <div class="btn-empty">Let op certificaat verlopen. Download niet beschikbaar. </div>
                                            @endif
                                            @if (@$certifications[0]['vervaldatum_vca'] < \Carbon\Carbon::now() ) <div class="btn-empty">Let op certificaat verlopen. Download niet beschikbaar. </div>
                                            @endif
                                        @endif
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('employees.update',$employee->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Relaties</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Formulier: Medewerker</strong></div>
                                                <input class="col-md-6 form-control" name="initialen_achternaam" value="{{ $employee->initialen }} {{ $employee->achternaam }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne" style="background: #31a836;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">VCA</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Datum Uitgifte VCA</strong></div>
                                                <input class="col-md-6 form-control" name="datum_uitgifte_vca" value="{{ @date('d-m-Y',strtotime($certifications[0]['datum_uitgifte_vca']))}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"> <strong>Vervaldatum VCA</strong></div>
                                                <input class="col-md-6 form-control" name="vervaldatum_vca" value="{{ @date('d-m-Y',strtotime($certifications[0]['vervaldatum_vca']))}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"> <strong>Certificaatnummer</strong></div>
                                                <input class="col-md-6 form-control" name="certificaatnummer" value="{{ $certifications[0]['certificaatnummer'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header" id="headingOne" style="background: #31a836;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Certificaat</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Certificaatnummer </strong></div>
                                                <div class="col-md-6">{{ @$certifications[0]['certificaatnummer']}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"> <strong>Gewenste Certificatie </strong></div>
                                                <div class="col-md-6">{{ @$certifications[0]['gewenste_certificatie']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                @if( $certifications[0]['gewenste_certificatie'] == 'Beide'
                                    || $certifications[0]['gewenste_certificatie'] == 'Glasmonteur'
                                )

                                <!--
                                    Glasmonteur: L M N.= text above table  for table = O, P and Q
                                -->
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Glasmonteur</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Pasje gecertificeerd glasmonteur </strong></div>
                                                <input class="col-md-6 form-control" name="pasje_gecertificeerd_glasmonteur" value="{{@$certifications[0]['pasje_gecertificeerd_glasmonteur']}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Datum gecertificeerd glasmonteur</strong></div>
                                                <input class="col-md-6 form-control" name="pasje_gecertificeerd_glasmonteur" value="{{$certifications[0]['datum_gecertificeerd_glasmonteur'] ? @date('d-m-Y',strtotime($certifications[0]['datum_gecertificeerd_glasmonteur']))  : ''}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldatum certificering glasmonteur</strong></div>
                                                <input class="col-md-6 form-control" name="pasje_gecertificeerd_glasmonteur" value="{{$certifications[0]['vervaldatum_gecertificeerd_glasmonteur'] ? @date('d-m-Y',strtotime($certifications[0]['vervaldatum_gecertificeerd_glasmonteur']))  : ''}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table>
                                                        <caption>Examen Glasmonteur</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Examen glasmonteur</th>
                                                                <th>Examencode glasmonteur</th>
                                                                <th>Examencijfer glasmonteur</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($certifications as $key => $certification)
                                                            <tr>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="examen_glasmonteur[{{ $key }}]" value="{{$certification['examen_glasmonteur']}}">
                                                                </td>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="examencode_glasmonteur[{{ $key }}]" value="{{$certification['examencode_glasmonteur']}}">
                                                                </td>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="examencijfer_glasmonteur[{{ $key }}]" value="{{$certification['examencijfer_glasmonteur']}}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if( $certifications[0]['hercertificering_glasmonteur'] )
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Hercertificering glasmonteur</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Datum hercertificering glasmonteur</strong></div>
                                                <input class="col-md-6 form-control" name="datum_hercertificering_glasmonteur" value="{{@$certifications[0]['datum_hercertificering_glasmonteur']}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldatum hercertificering glasmonteur </strong></div>
                                                <input class="col-md-6 form-control" name="vervaldatum_hercertificering_glasmonteur" value="{{$certifications[0]['vervaldatum_hercertificering_glasmonteur'] ? @date('d-m-Y',strtotime($certifications[0]['vervaldatum_hercertificering_glasmonteur'])) : ''}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Hercertificeringscode glasmonteur</strong></div>
                                                <input class="col-md-6 form-control" name="pasje_gecertificeerd_glasmonteur" value="{{$certifications[0]['hercertificeringscode_glasmonteur'] ? @date('d-m-Y',strtotime($certifications[0]['hercertificeringscode_glasmonteur'])) : ''}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Hercertificeringscode glasmonteur</th>
                                                                <th>Hercertificeringscijfer glasmonteur</th>
                                                                <th>Hercertificeringspasnummer glasmonteur</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($certifications as $key => $certification)
                                                            <tr>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="hercertificeringscode_glasmonteur[{{ $key }}]" value="{{$certification['hercertificeringscode_glasmonteur']}}">
                                                                </td>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="hercertificeringscijfer_glasmonteur[{{ $key }}]" value="{{$certification['hercertificeringscijfer_glasmonteur']}}">
                                                                </td>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="hercertificeringspasnummer_glasmonteur[{{ $key }}]" value="{{$certification['hercertificeringspasnummer_glasmonteur']}}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if( $certifications[0]['gewenste_certificatie'] == 'Beide'
                                    || $certifications[0]['gewenste_certificatie'] == 'Glaszetter'
                                )
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Glaszetter</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Pasje gecertificeerd Glaszetter </strong></div>
                                                <input class="col-md-6 form-control" name="pasje_gecertificeerd_glaszetter" value="{{@$certifications[0]['pasje_gecertificeerd_glaszetter']}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Datum gecertificeerd Glaszetter </strong></div>
                                                <input class="col-md-6 form-control" name="datum_gecertificeerd_glaszetter" value="{{@date('d-m-Y',strtotime($certifications[0]['datum_gecertificeerd_glaszetter']))}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldatum certificering Glaszetter</strong></div>
                                                <input class="col-md-6 form-control" name="vervaldatum_gecertificeerd_glaszetter" value="{{@date('d-m-Y',strtotime($certifications[0]['vervaldatum_gecertificeerd_glaszetter']))}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table>
                                                        <caption>Examen Glaszetter</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Examen Glaszetter</th>
                                                                <th>Code Examen Glaszetter</th>
                                                                <th>Cijfer Examen Glaszetter</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($certifications as $key => $certification)
                                                            <tr>
                                                                <td>
                                                                <input class="col-md-6 form-control" name="examen_glaszetter[{{ $key }}]" value="{{$certification['examen_glaszetter']}}">
                                                                </td>
                                                                <td>
                                                                <input class="col-md-6 form-control" name="examencode_glaszetter[{{ $key }}]" value="{{$certification['examencode_glaszetter']}}">
                                                                </td>
                                                                <td>
                                                                <input class="col-md-6 form-control" name="examencijfer_glaszetter[{{ $key }}]" value="{{$certification['examencijfer_glaszetter']}}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-md-6"><strong>Hercertificering Glaszetter </strong></div>
                                                @if ( @$certifications[0]['hercertificering_glaszetter'] === 0)
                                                <div class="col-md-6"><input type="checkbox" name="" id=""></div>
                                                @else
                                                <div class="col-md-6"><input type="checkbox" checked name="" id=""></div>
                                                @endif
                                            </div> -->
                                            <!-- <div class="row">
                                                <div class="col-md-6"><strong>CertificaatMedewerkerInitialen</strong></div>
                                                <div class="col-md-6">{{ $employee->initialen }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>CertificaatMedewerkerAchternaam</strong></div>
                                                <div class="col-md-6">{{ $employee->achternaam }}</div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if( $certifications[0]['hercertificering_glaszetter'] )
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">Hercertificering glaszetter</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"><strong>Datum hercertificering glaszetter</strong></div>
                                                <input class="col-md-6 form-control" name="[{{ $key }}]" value="{{@$certifications[0]['datum_hercertificering_glaszetter']}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Vervaldatum hercertificering glaszetter </strong></div>
                                                <input class="col-md-6 form-control" name="[{{ $key }}]" value="{{$certifications[0]['vervaldatum_hercertificering_glaszetter'] ? @date('d-m-Y',strtotime($certifications[0]['vervaldatum_hercertificering_glaszetter'])) : ''}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><strong>Hercertificeringscode glaszetter</strong></div>
                                                <input class="col-md-6 form-control" name="[{{ $key }}]" value="{{$certifications[0]['hercertificeringscode_glaszetter'] ? @date('d-m-Y',strtotime($certifications[0]['hercertificeringscode_glaszetter'])) : ''}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Hercertificeringscode glaszetter</th>
                                                                <th>Hercertificeringscijfer glaszetter</th>
                                                                <th>Hercertificeringspasnummer glaszetter</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($certifications as $key => $certification)
                                                            <tr>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="hercertificeringscode_glaszetter[{{ $key }}]" value="{{$certification['hercertificeringscode_glaszetter']}}">
                                                                </td>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="hercertificeringscijfer_glaszetter[{{ $key }}]" value="{{$certification['hercertificeringscijfer_glaszetter']}}">
                                                                </td>
                                                                <td>
                                                                    <input class="col-md-6 form-control" name="hercertificeringspasnummer_glaszetter[{{ $key }}]" value="{{$certification['hercertificeringspasnummer_glaszetter']}}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="card float-right">
                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
</section>

@endsection


@push('scripts')
<script type="text/javascript">
    console.log($('input[name="company_id_hidden"]').val())
    $('select[name="gender"]').val($('input[name="gender_hidden"]').val());
    $('#role_users_id').selectpicker('val', $('input[name="role_user_hidden"]').val());
    $('#marital_status').selectpicker('val', $('input[name="marital_status_hidden"]').val());

    $('#company_id').selectpicker('val', $('input[name="company_id_hidden"]').val().split(","));
    $('#department_id').selectpicker('val', $('input[name="department_id_hidden"]').val());
    $('#designation_id').selectpicker('val', $('input[name="designation_id_hidden"]').val());

    $('#status_id').selectpicker('val', $('input[name="status_id_hidden"]').val());
    $('#office_shift_id').selectpicker('val', $('input[name="office_shift_id_hidden"]').val());


    $(document).ready(function() {

        let date = $('.date');
        date.datepicker({
            format: "{{ env('Date_Format_JS') }}",
            autoclose: true,
            todayHighlight: true
        });

        let month_year = $('.month_year');
        month_year.datepicker({
            format: "MM-yyyy",
            startView: "months",
            minViewMode: 1,
            autoclose: true,
        }).datepicker("setDate", new Date());
    });

    $('[data-table="immigration"]').one('click', function(e) {
        @include('employee.immigration.index_js')

    });

    $('[data-table="emergency"]').one('click', function(e) {
        @include('employee.emergency_contacts.index_js')
    });

    $('[data-table="document"]').one('click', function(e) {
        @include('employee.documents.index_js')
    });

    $('[data-table="qualification"]').one('click', function(e) {
        @include('employee.qualifications.index_js')
    });

    $('[data-table="work_experience"]').one('click', function(e) {
        @include('employee.work_experience.index_js')
    });

    $('[data-table="bank_account"]').one('click', function(e) {
        @include('employee.bank_account.index_js')
    });

    $('#profile-tab').one('click', function(e) {
        @include('employee.profile_picture.index_js')
    });

    $('#set_salary-tab').one('click', function(e) {
        @include('employee.salary.basic.index_js') //employee.salary.index_js.blade.php - both are same
    });

    $('#salary_allowance-tab').one('click', function(e) {
        @include('employee.salary.allowance.index_js')
    });

    $('#salary_commission-tab').one('click', function(e) {
        @include('employee.salary.commission.index_js')
    });

    $('#salary_loan-tab').one('click', function(e) {
        @include('employee.salary.loan.index_js')
    });

    $('#salary_deduction-tab').one('click', function(e) {
        @include('employee.salary.deduction.index_js')
    });

    $('#other_payment-tab').one('click', function(e) {
        @include('employee.salary.other_payment.index_js')
    });

    $('#salary_overtime-tab').one('click', function(e) {
        @include('employee.salary.overtime.index_js')
    });

    $('#salary_pension-tab').one('click', function(e) {
        @include('employee.salary.pension_amount_js')
    });


    $('#leave-tab').one('click', function(e) {
        @include('employee.leave.index_js')
    });


    $('#employee_core_hr-tab').one('click', function(e) {
        @include('employee.core_hr.award.index_js')
    });

    $('#employee_travel-tab').one('click', function(e) {
        @include('employee.core_hr.travel.index_js')
    });

    $('#employee_training-tab').one('click', function(e) {
        @include('employee.core_hr.training.index_js')
    });

    $('#employee_ticket-tab').one('click', function(e) {
        @include('employee.core_hr.ticket.index_js')
    });


    $('#employee_transfer-tab').one('click', function(e) {
        @include('employee.core_hr.transfer.index_js')
    });


    $('#employee_promotion-tab').one('click', function(e) {
        @include('employee.core_hr.promotion.index_js')
    });

    $('#employee_complaint-tab').one('click', function(e) {
        @include('employee.core_hr.complaint.index_js')
    });


    $('#employee_warning-tab').one('click', function(e) {
        @include('employee.core_hr.warning.index_js')
    });

    $('#employee_project_task-tab').one('click', function(e) {
        @include('employee.project_task.project.index_js')

    });

    $('#employee_task-tab').one('click', function(e) {
        @include('employee.project_task.task.index_js')
    });

    $('#employee_payslip-tab').one('click', function(e) {
        @include('employee.payslip.index_js')
    });


    $('#basic_sample_form').on('submit', function(event) {
        event.preventDefault();
        var attendance_type = $("#attendance_type").val();
        // console.log(attendance_type);

        $.ajax({
            url: "{{ route('employees_basicInfo.update',$employee->id) }}",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                console.log(data);
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    $('#remaining_leave').val(data.remaining_leave)
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                }
                $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
            }
        });
    });

    $('.dynamic').change(function() {
        if ($(this).val() !== '') {
            let value = $(this).val();
            let dependent = $(this).data('shift_name');
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('dynamic_office_shifts') }}",
                method: "POST",
                data: {
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('select').selectpicker("destroy");
                    $('#office_shift_id').html(result);
                    $('#designation_id').html('');
                    $('select').selectpicker();
                }
            });
        }
    });

    $('.dynamic').change(function() {
        if ($(this).val() !== '') {
            let value = $(this).val();
            let dependent = $(this).data('dependent');
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('dynamic_department') }}",
                method: "POST",
                data: {
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('select').selectpicker("destroy");
                    $('#department_id').html(result);
                    $('select').selectpicker();
                }
            });
        }
    });

    $('.designation').change(function() {
        if ($(this).val() !== '') {
            let value = $(this).val();
            let designation_name = $(this).data('designation_name');
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('dynamic_designation_department') }}",
                method: "POST",
                data: {
                    value: value,
                    _token: _token,
                    designation_name: designation_name
                },
                success: function(result) {
                    $('select').selectpicker("destroy");
                    $('#designation_id').html(result);
                    $('select').selectpicker();

                }
            });
        }
    });

    // Login Type Change
    // $('#login_type').change(function() {
    //     var login_type = $('#login_type').val();
    //     if (login_type=='ip') {
    //         data = '<label class="text-bold">{{__("IP Address")}} <span class="text-danger">*</span></label>';
    //         data += '<input type="text" name="ip_address" id="ip_address" placeholder="Type IP Address" required class="form-control">';
    //         $('#ipField').html(data)
    //     }else{
    //         $('#ipField').empty();
    //     }
    // });
</script>
@endpush