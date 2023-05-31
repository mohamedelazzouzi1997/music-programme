@extends('layouts.app')

@section('title')
    Musics
@endsection

@section('page-style')
    {{-- <link rel="stylesheet"
        href="{{ asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" /> --}}
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
                    <h2><strong>Add New Music</strong></h2>
                </div>
                <div class="body shadow-md">
                    <form autocomplete="off" action="{{ route('musics.store') }}" id="form_validation" method="POST">
                        @csrf
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="form-group form-float">
                            <input type="text" class="form-control" placeholder="Music Name" name="name" required>
                        </div>
                        @error('time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="form-group form-float">
                            <input type="text" class="form-control" placeholder="Music Time" name="time" required>
                        </div>
                        @error('category_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="form-group form-float">
                            <select name="category_id" class="form-control " data-placeholder="Select Music Category"
                                required>
                                <option disabled selected>
                                    <---- select music category ---->
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('artist_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="form-group form-float">
                            <select name="artist_id[]" class="form-control show-tick ms select2" multiple
                                data-placeholder="Select Artists " required>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group form-float">
                            <select name="coeurs[]" class="form-control show-tick ms select2" multiple
                                data-placeholder="Select Coeurs " required>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" class="form-control" placeholder="Music Type" name="type">
                        </div>
                        <div class="form-group form-float">
                            <input type="text" class="form-control" placeholder="Music comment" name="comment">
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect bg-blue-900" type="submit">Add
                            Music</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script defer src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.js') }}"></script>

    <script defer src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>
    <script defer src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script defer src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

    <script defer src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
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
