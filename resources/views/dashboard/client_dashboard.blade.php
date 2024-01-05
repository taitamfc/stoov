@extends('layout.main')
@section('content')

<section>

    @include('shared.errors')
    @include('shared.flash_message')

    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-9 col-md-10 mb-3">
                <h1 class="tex-center">Welkom op de portal van STOOV.</h1>
                <h4 class="font-weight-bold">{{$client->first_name}} {{$client->last_name}} <span class="text-muted">({{$user->username}})</span>
                </h4>
                <!-- <div class="text-muted mb-2">{{__('Berdrijf')}}: {{$client->company_name}}</div> -->
                <!-- <p class="text-muted pb-0-5">{{__('Last Login')}}: {{$user->last_login_date}}</p> -->

                <a href="{{route('clientProfile')}}">
                    <button class="btn btn-primary btn-block text-uppercase" id="my_profile"><i class="ion-person"></i>{{__('Profile')}}</button>
                </a>
            </div>
        </div>
        @if(!$checkSubmitLoomsom)
        <div class="row">
            <div class="col-12">
                <!-- <p>Jaar, omschrijving {{ now()->year - 1  }} <a href="{{ route('client-get-loonsomopgave') }}">Loonsompgave</a></p> -->
            </div>
            
        </div>
        <div class="row">
            <div class="col-8">
                <div class="table-responsive">
                    <table id="table" class="table dataTable no-footer dt-checkboxes-select">
                        <thead>
                            <tr>
                                <th>{{ __('Tijdvak') }}</th>
                                <th>{{ __('Omschrijving') }}</th>
                                <th>{{ __('Link') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>{{ now()->year - 1 }}</td>
                            <td>Loonsomopgave {{ now()->year - 1 }}</td>
                            <td><a href="{{ route('client-get-loonsomopgave') }}">{{ __('Verwerken Aangifte') }}</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>


</section>

@endsection