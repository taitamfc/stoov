@extends('layout.main')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('Import EXCEL/CSV file (Manual)')}}</h3>
                </div>
                <div class="card-body">
                    <h6><a href="{{url('sample_file/sample_attendance.xlsx')}}" class="btn btn-primary"> <i
                        class="fa fa-download"></i> {{__('Voorbeeldbestand downloaden')}} </a></h6>
                    <p class="card-text">De eerste regel in het gedownloade voorbeeldbestand moet blijven zoals hij is. Verander alstublieft niet de volgorde van de kolommen in het bestand.</p>
                    <p class="card-text">De juiste volgorde van de kolommen is (personeels-id, aanwezigheidsdatum, inklok, uitklok).</p>
                    <ul>
                        <li>Het formaat van de datum moet zijn (volgens de algemene instellingen)</li>
                        <li>U moet het bestand volgen, anders krijgt u een foutmelding bij het importeren van het bestand.</li>
                    </ul>

                    <form action="{{ route('attendances.importPost') }}" autocomplete="off" enctype="multipart/form-data"
                          method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <fieldset class="form-group">
                                    <label for="logo">{{ __('Bestand uploaden') }}</label>
                                        <input type="file" class="form-control-file" id="file" name="file"
                                               accept=".xlsx, .xls, .csv">
                                        <small>{{__('Selecteer excel/csv')}} bestand (toegestane bestandsgrootte 2MB)</small>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1">
                            <div class="form-actions box-footer">
                                <button name="import_form" type="submit" class="btn btn-primary"><i
                                            class="fa fa fa-check-square-o"></i> {{trans('Save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
