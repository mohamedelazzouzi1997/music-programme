@extends('layouts.app')

@section('title')
    Categories
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('confirm/jqueryConfirm.css') }}">
@endsection

@section('content')
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-3">
                    <h2>All Music Categories Table</h2>
                    <ul class="header-dropdown">
                        <li class="remove">
                            <a href="{{ route('categories.create') }}" class="btn btn-info">Add New Category</a>
                        </li>
                    </ul>
                </div>
                <div class="body ">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <span class="badge bg-warning text-xl text-white">
                                                {{ \Carbon\Carbon::createFromFormat('G:i:s', $category->start_time)->format('H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-xl text-white">
                                                {{ \Carbon\Carbon::createFromFormat('G:i:s', $category->end_time)->format('H:i') }}

                                            </span>
                                        </td>
                                        {{-- <td>{{ $category->end_time }}</td> --}}
                                        <td class="flex space-x-2"><a class="btn btn-primary"
                                                href="{{ route('categories.edit', $category->id) }}">Edit</a>

                                            <form id="delete-form-{{ $category->id }}"
                                                action="{{ route('categories.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-id="{{ $category->id }}"
                                                    id="delete-button-{{ $category->id }}" type="submit"
                                                    class="delete-btn btn btn-danger bg-red-500">Delete</button>
                                            </form>
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
@endsection

@section('scripts')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('confirm/jqueryConfirm.js') }}"></script>
    <script>
        $('.delete-btn').click(function(event) {

            event.preventDefault();
            var id = $(this).data('id');
            $.confirm({
                title: 'Confirm pour supprimé',
                content: 'Confirm pour supprimé Category',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'DELETE',
                        btnClass: 'btn-red',
                        action: function() {

                            $('#delete-form-' + id).submit();
                        }
                    },
                    close: function() {}
                }
            });
        });
    </script>
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
