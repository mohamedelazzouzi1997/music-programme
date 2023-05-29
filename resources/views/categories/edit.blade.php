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
@endsection

@section('content')
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Edit Category</strong></h2>
                </div>
                <div class="body shadow-md">
                    <form action="{{ route('categories.update', $category->id) }}" id="form_validation" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group form-float">
                            <input value="{{ $category->name }}" type="text" class="form-control"
                                placeholder="Category Name" name="name" required>
                        </div>
                        <div class="form-group form-float">
                            <input value="{{ $category->start_time }}" type="time" class="form-control"
                                placeholder="Start Time" name="start_time" required>
                        </div>
                        <div class="form-group form-float">
                            <input value="{{ $category->end_time }}" type="time" class="form-control"
                                placeholder="End Time" name="end_time" required>
                        </div>
                        <div class="form-group form-float">
                            <input value="{{ $category->category_order }}" type="text" class="form-control"
                                placeholder="Category Order" name="category_order" required>
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect bg-blue-900" type="submit">Edit
                            Category</button>
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
