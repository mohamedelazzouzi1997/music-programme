@extends('layouts.app')

@section('title')
    Edit Artist
@endsection

@section('page-style')
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
    <style>
        .form-control {
            height: auto !important;
        }
    </style>
@endsection

@section('content')
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Edit Artist</strong></h2>
                </div>
                <div class="body shadow-md">
                    <form autocomplete="off" action="{{ route('artists.update', $artist->id) }}" id="form_validation"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group form-float">
                            <input type="text" class="form-control" value="{{ $artist->name }}" placeholder="Artist Name"
                                name="name" required>
                        </div>
                        {{-- <div class="form-group form-float">

                            <select name="music_id[]" class="form-control show-tick ms select2" multiple
                                data-placeholder="Select Artist Music" required>
                                @foreach ($musics as $music)
                                    <option value="{{ $music->name }}"
                                        {{ in_array($music->name, $artist->music_id) ? 'selected' : '' }}>
                                        {{ $music->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <select name="fixed_music_id[]" class="form-control show-tick ms select2" multiple
                            data-placeholder="Select Artist Music" required>
                            @foreach ($musics as $music)
                                <option value="{{ $music->name }}"
                                    {{ in_array($music->name, $artist->fixed_music_id) ? 'selected' : '' }}>
                                    {{ $music->name }}
                                </option>
                            @endforeach
                        </select> --}}
                        <button class="btn btn-raised btn-primary waves-effect bg-blue-900" type="submit">Edit
                            Artist</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.js') }}"></script>

    <script src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
@endsection
