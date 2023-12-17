@extends('layout.main')
@section('content')
    <section>
        <div class="card animated fadeInRight mr-5 ml-5">
            <div class="card-header  with-border">
                <h3 class="card-title">{{__('Verletvergoeding importeren') }}</h3>
                @include('shared.flash_message')
                <div id="form_result"></div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('course.post-verletvergoeding-importeren') }}" autocomplete="off"
                    enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <fieldset class="form-group">
                                    <label for="logo">{{ __('Bestand uploaden') }}</label>
                                    <input type="file" class="form-control-file" id="file" name="file"
                                        accept=".xlsx, .xls, .csv">
                                    <small>{{ __('Selecteer excel/csv') }} bestand (toegestane bestandsgrootte 2MB)</small>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="form-actions box-footer">
                            <button name="import_form" type="submit" class="btn btn-primary"><i
                                    class="fa fa fa-check-square-o"></i> {{ trans('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
