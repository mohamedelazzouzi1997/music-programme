@extends('layouts.app')

@section('title')
    Music
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
                    <h2>All Music Table</h2>
                    <ul class="header-dropdown">
                        <li class="remove">
                            <a href="{{ route('musics.create') }}" class="btn btn-info"> Add New Music</a>
                        </li>
                    </ul>
                </div>
                <div class="body ">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Durée</th>
                                    <th>Category</th>
                                    <th>Artists</th>
                                    <th>Musiciens</th>
                                    <th>coeurs</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($musics as $music)
                                    @php
                                        $artist_By_Music = App\Models\Artist::whereIn('id', $music->artist_id)->get();
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $music->name }}</td>
                                        <td>
                                            <span class="badge bg-danger text-xl text-white">
                                                {{ substr($music->time, 3) }}
                                            </span>
                                        </td>
                                        <td>{{ $music->category->name }}</td>
                                        <td>
                                            @foreach ($artist_By_Music as $artist)
                                                <span class="badge bg-warning text-sm text-white">{{ $artist->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $music->coeurs }}</td>
                                        <td>{{ $music->type }}</td>

                                        <td class="flex space-x-2"><a class="btn btn-primary"
                                                href="{{ route('musics.edit', $music->id) }}">Edit</a>

                                            <form id="delete-form-{{ $music->id }}"
                                                action="{{ route('musics.destroy', $music->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-id="{{ $music->id }}"
                                                    id="delete-button-{{ $music->id }}" type="submit"
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
                content: 'Confirm pour supprimé Music',
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
