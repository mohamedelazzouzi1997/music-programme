@extends('layouts.app')

@section('title')
    ARTISTS
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
                    <h2>All Artist Table</h2>
                    <ul class="header-dropdown">
                        {{-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right slideUp">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li> --}}
                        <li class="remove">
                            <a href="{{ route('artists.create') }}" class="btn btn-info">Add New Artiste</a>
                        </li>
                    </ul>
                </div>
                <div class="body ">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Music</th>
                                    {{-- <th>Artist Music</th> --}}
                                    <th>Disponible</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artists as $artist)
                                    {{-- @php
                                        $artist_music_category = App\Models\Music::select('category_id')
                                            ->whereIn('name', $artist->music_id)
                                            ->distinct('category_id')
                                            ->get();

                                        $artist_music = App\Models\Music::select('name', 'category_id')
                                            ->whereIn('name', $artist->music_id)
                                            ->get();
                                    @endphp
                                    @php
                                        $fixed_artist_music_category = App\Models\Music::select('category_id')
                                            ->whereIn('name', $artist->fixed_music_id)
                                            ->distinct('category_id')
                                            ->get();

                                        $fixed_artist_music = App\Models\Music::select('name', 'category_id')
                                            ->whereIn('name', $artist->fixed_music_id)
                                            ->get();
                                    @endphp --}}
                                    @php
                                        $music_ids = App\Models\MusicArtist::select('music_id')
                                            ->where('artist_id', $artist->id)
                                            ->get()
                                            ->toArray();
                                        $artist_music_categories = App\Models\Music::with('category')
                                            ->whereIn('id', $music_ids)
                                            ->get()
                                            ->groupBy('category.name');
                                        // dd($artist_music_categories);
                                    @endphp
                                    <tr>
                                        <td>{{ $artist->name }}</td>
                                        <td>
                                            @foreach ($artist_music_categories as $Category_name => $artist_music_By_category)
                                                <div class="mb-4 border-2 px-2 py-1 border-black bg-slate-300">
                                                    <div class="badge bg-warning text-sm block">
                                                        {{ $Category_name }}
                                                    </div>
                                                    @foreach ($artist_music_By_category as $musicName)
                                                        <span
                                                            class="badge bg-info text-sm rounded">{{ $musicName->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </td>
                                        {{-- <td>

                                            @foreach ($artist_music_category as $category)
                                                @php
                                                    // dd($category);
                                                    $category_name = App\Models\Category::select('name')
                                                        ->where('id', $category->category_id)
                                                        ->first();
                                                @endphp
                                                <div class="mb-4 border-2 px-2 py-1 border-black bg-slate-300">
                                                    <div class="badge bg-warning text-sm block">{{ $category_name->name }}
                                                    </div>
                                                    @foreach ($artist_music->where('category_id', $category->category_id) as $musicName)
                                                        <span
                                                            class="badge bg-info text-sm rounded">{{ $musicName->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>

                                            @foreach ($fixed_artist_music_category as $fixed_category)
                                                @php
                                                    // dd($category);
                                                    $fixed_category_name = App\Models\Category::select('name')
                                                        ->where('id', $fixed_category->category_id)
                                                        ->first();
                                                @endphp
                                                <div class="mb-4 border-2 px-2 py-1 border-black bg-blue-900">
                                                    <div class="badge bg-warning text-sm block">
                                                        {{ $fixed_category_name->name }}
                                                    </div>
                                                    @foreach ($fixed_artist_music->where('category_id', $fixed_category->category_id) as $fixed_musicName)
                                                        <span
                                                            class="badge bg-info text-sm rounded">{{ $fixed_musicName->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </td> --}}
                                        <td>
                                            @if ($artist->is_available)
                                                <span class="badge badge-success">Disponible</span>
                                            @else
                                                <span class="badge badge-danger">Pas Disponible</span>
                                            @endif
                                        </td>
                                        <td class="flex space-x-2"><a class="btn btn-primary"
                                                href="{{ route('artists.edit', $artist->id) }}">Edit</a>
                                            @if ($artist->is_available)
                                                <a class="btn btn-warning"
                                                    href="{{ route('artists.available', $artist->id) }}"><i
                                                        class="zmdi zmdi-block"></i></a>
                                            @else
                                                <a class="btn btn-success"
                                                    href="{{ route('artists.available', $artist->id) }}"><i
                                                        class="zmdi zmdi-check-circle"></i></a>
                                            @endif
                                            <form id="delete-form-{{ $artist->id }}"
                                                action="{{ route('artists.destroy', $artist->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button data-id="{{ $artist->id }}"
                                                    id="delete-button-{{ $artist->id }}" type="submit"
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
                content: 'Confirm pour supprimé L\'artiste',
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
