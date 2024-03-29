@extends('layouts.app')

@section('title')
    Edit Category
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
                    <h2><strong>Edit Music</strong></h2>
                </div>
                <div class="body shadow-md">
                    <form autocomplete="off" action="{{ route('musics.update', $music->id) }}" id="form_validation"
                        method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group form-float">
                            <input value="{{ $music->name }}" type="text" class="form-control" placeholder="music Name"
                                name="name" required>
                        </div>
                        <div class="form-group form-float">
                            <input value="{{ $music->time }}" type="text" class="form-control" placeholder="Start Time"
                                name="time" required>
                        </div>
                        <div class="form-group form-float">
                            <select name="category_id" class="form-control " data-placeholder="Select Music Category"
                                required>
                                <option disabled selected>
                                    <---- select music category ---->
                                </option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $music->category_id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group form-float">

                            <select name="artist_id[]" class="form-control show-tick ms select2" multiple
                                data-placeholder="Select Artist Music" required>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"
                                        {{ in_array($artist->id, $music->artist_id) ? 'selected' : '' }}>
                                        {{ $artist->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-float">
                            <select name="coeurs[]" class="form-control show-tick ms select2" multiple
                                data-placeholder="Select coeurs Music" required>
                                @foreach ($artists as $artist_coeur)
                                    <option value="{{ $artist_coeur->id }}"
                                        {{ in_array($artist_coeur->id, $music->coeurs) ? 'selected' : '' }}>
                                        {{ $artist_coeur->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-float">
                            <input value="{{ $music->type }}" type="text" class="form-control" placeholder="Music Type"
                                name="type">
                        </div>
                        <div class="form-group form-float">
                            <input value="{{ $music->comment }}" type="text" class="form-control"
                                placeholder="Music comment" name="comment">
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect bg-blue-900" type="submit">Edit
                            music</button>
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
    <script>
        const ToasterOptions = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
            toastr.options = ToasterOptions;
        </script>
    @endif
    @if (Session::has('fail'))
        <script>
            toastr.error("{{ Session::get('fail') }}");
            toastr.options = ToasterOptions;
        </script>
    @endif
@endsection
