@extends('layouts.app')

@section('title')
    Music
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('confirm/jqueryConfirm.css') }}">
    <link rel="stylesheet" href="{{ asset('normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('skeleton.css') }}">
    <style>
        .text-center {
            text-align: center !important
        }
    </style>
@endsection

@section('content')
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-3">
                    <h2>Resulta</h2>
                    {{-- <ul class="header-dropdown">
                        <li class="remove">
                            <a href="{{ route('musics.create') }}" class="btn btn-info"> Add New Music</a>
                        </li>
                    </ul> --}}
                </div>
                <div class="my-2">
                    <a id="print" href="#" class="btn btn-primary">print this</a>
                </div>
                <div id="result" class="body ">
                    <div class="table-responsive">
                        {{-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> --}}
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Capsules & Modules </th>
                                    <th>Musiciens</th>
                                    <th>Chanteurs</th>
                                    <th>Les coeurs</th>
                                    <th>Durée</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php
                                    $all_seconds = 72000;
                                @endphp
                                @foreach ($Music_by_category_list as $key => $values)
                                    @php
                                        $musics = App\Models\Music::whereIn('id', $values)->get();
                                    @endphp
                                    <tr class="text-center">
                                        <td class="text-center uppercase text-xl font-bold bg-gray-300" colspan="6">
                                            {{ $key }}
                                        </td>
                                    </tr>
                                    @foreach ($musics as $music)
                                        <tr class="text-center">
                                            @php
                                                [$hour, $minute, $second] = explode(':', $music->time);
                                                // dd($hour);
                                                $all_seconds += $hour * 3600;
                                                $all_seconds += $minute * 60;
                                                $all_seconds += $second;
                                                $total_minutes = floor($all_seconds / 60);
                                                $seconds = $all_seconds % 60;
                                                $hours = floor($total_minutes / 60);
                                                $minutes = $total_minutes % 60;
                                                $timestamp1 = $hours . ':' . $total_minutes . ':' . $second;
                                            @endphp
                                            <td class="text-center">{{ $timestamp1 }}</td>
                                            <td class="text-center">{{ $music->name }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                @foreach ($music->artist_id as $artist_id)
                                                    @php
                                                        $artist = App\Models\Artist::where('id', $artist_id)->first()->name;

                                                    @endphp
                                                    {{ $artist }} /
                                                @endforeach
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ substr($music->time, 3) }}</td>
                                        </tr>
                                    @endforeach
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
    <script src="{{ asset('printThis.js') }}"></script>
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
        $('#print').click(function() {
            $("#result").printThis();
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
