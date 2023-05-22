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
        table,
        th,
        td {
            border: 1px solid black !important;
            text-align: center !important
        }

        .draggable {
            cursor: move !important;
        }

        .draggable.dragging {
            opacity: .5;
            background-color: rgb(5, 43, 49);
            color: white;
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
                    <a id="saveAsPdf" href="#" class="btn btn-primary">print this</a>
                </div>
                <div class="grid grid-cols-6">
                    <div id="result" class="body col-span-1">
                        <div class="table-responsive">
                            {{-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> --}}
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center ">
                                    @php
                                        $totalTime = Carbon\Carbon::createFromTime(20, 30, 0);
                                    @endphp
                                    @foreach ($Music_by_category_list as $key => $values)
                                        @php
                                            $musics = App\Models\Music::whereIn('id', $values)->get();
                                        @endphp
                                        <tr class="text-center">
                                            <td class="text-center uppercase text-xl font-bold bg-gray-300" colspan="6">
                                                <span class="opacity-0">
                                                    {{ $key }}
                                                </span>
                                            </td>
                                        </tr>
                                <tbody class="containers">
                                    @foreach ($musics as $music)
                                        <tr class="text-center draggable" draggable="true">
                                            @php
                                                $timeParts = explode(':', $music->time);
                                                $hours = intval($timeParts[0]);
                                                $minutes = intval($timeParts[1]);
                                                $seconds = intval($timeParts[2]);

                                                $totalTime->addHours($hours);
                                                $totalTime->addMinutes($minutes);
                                                $totalTime->addSeconds($seconds);
                                            @endphp
                                            <td class="text-center">{{ $totalTime->format('H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="result" class="body col-span-5">
                        <div class="table-responsive">
                            {{-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> --}}
                            <table class="table table-bordered table-hover text-center">
                                <thead class="text-center">
                                    <tr>
                                        <th>Capsules & Modules </th>
                                        <th>Musiciens</th>
                                        <th>Chanteurs</th>
                                        <th>Les coeurs</th>
                                        <th>Durée</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center ">
                                    @php
                                        $totalTime = Carbon\Carbon::createFromTime(20, 30, 0);
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
                                <tbody class="containers">
                                    @foreach ($musics as $music)
                                        <tr class="text-center draggable" draggable="true">
                                            {{-- @php
                                                $timeParts = explode(':', $music->time);
                                                $hours = intval($timeParts[0]);
                                                $minutes = intval($timeParts[1]);
                                                $seconds = intval($timeParts[2]);

                                                $totalTime->addHours($hours);
                                                $totalTime->addMinutes($minutes);
                                                $totalTime->addSeconds($seconds);
                                            @endphp
                                            <td class="text-center">{{ $totalTime->format('H:i:s') }}</td> --}}
                                            <td class="text-center">{{ $music->name }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center" contenteditable>
                                                @php
                                                    $artist = App\Models\Artist::whereIn('id', $music->artist_id)
                                                        ->get()
                                                        ->pluck('name')
                                                        ->toArray();

                                                    sort($artist);
                                                    // dd($artist);
                                                @endphp
                                                @foreach ($artist as $name_ar)
                                                    @if ($loop->last)
                                                        {{ $name_ar }}
                                                    @else
                                                        {{ $name_ar }} /
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ substr($music->time, 3) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    {{-- <div id="result" class="body col-span-5">
                        <div class="table-responsive">
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
                                <tbody class="text-center ">
                                    @php
                                        $totalTime = Carbon\Carbon::createFromTime(20, 30, 0);
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
                                <tbody class="containers">
                                    @foreach ($musics as $music)
                                        <tr class="text-center draggable" draggable="true">
                                            @php
                                                $timeParts = explode(':', $music->time);
                                                $hours = intval($timeParts[0]);
                                                $minutes = intval($timeParts[1]);
                                                $seconds = intval($timeParts[2]);

                                                $totalTime->addHours($hours);
                                                $totalTime->addMinutes($minutes);
                                                $totalTime->addSeconds($seconds);
                                            @endphp
                                            <td class="text-center">{{ $totalTime->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $music->name }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center" contenteditable>
                                                @php
                                                    $artist = App\Models\Artist::whereIn('id', $music->artist_id)
                                                        ->get()
                                                        ->pluck('name')
                                                        ->toArray();

                                                    sort($artist);
                                                @endphp
                                                @foreach ($artist as $name_ar)
                                                    @if ($loop->last)
                                                        {{ $name_ar }}
                                                    @else
                                                        {{ $name_ar }} /
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ substr($music->time, 3) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script> --}}
    {{-- <script src="{{ asset('confirm/jqueryConfirm.js') }}"></script> --}}
    {{-- <script src="{{ asset('printThis.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>

    <script>
        document.getElementById('saveAsPdf').addEventListener('click', function() {
            // Select the div element
            const divToPrint = document.getElementById('result');

            // Create a new jsPDF instance
            const pdf = new jsPDF();

            // Generate the PDF
            pdf.addHTML(divToPrint, function() {
                // Save the PDF file
                pdf.save('resulta.pdf');
            });
        });

        const draggables = document.querySelectorAll('.draggable')
        const containers = document.querySelectorAll('.containers')

        draggables.forEach(element => {
            element.addEventListener('dragstart', () => {
                element.classList.add('dragging');
            })

            element.addEventListener('dragend', () => {
                element.classList.remove('dragging');
            })
        });

        containers.forEach(element => {
            element.addEventListener('dragover', (e) => {
                e.preventDefault();
                const afterElement = getDragAfterElement(element, e.clientY)
                const draggable = document.querySelector('.dragging')
                if (afterElement == null) {
                    element.appendChild(draggable)

                } else {
                    element.insertBefore(draggable, afterElement)
                }
            })
        })

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]
            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect()
                const offset = y - box.top - box.height / 2

                if (offset < 0 && offset > closest.offset) {
                    return {
                        offset: offset,
                        element: child
                    }
                } else {
                    return closest
                }
            }, {
                offset: Number.NEGATIVE_INFINITY
            }).element
        }
    </script>
@endsection
