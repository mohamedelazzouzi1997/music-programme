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
            border: 2px solid black !important;
            text-align: center !important;
            font-size: 18px;
            font-weight: bolder;
        }

        th {
            background-color: rgb(11, 36, 59) !important;
            color: white;
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
                    <h2 class="uppercase font-bold">Programe Music Resulta</h2>

                </div>
                <div class="my-2">
                    <a id="btnSave" href="#" class="btn btn-primary">print this PDF</a>
                </div>
                <div class="my-2">
                    <a href="#" onclick="exportToExcel()" class="btn btn-muted">export this xlsx</a>
                </div>
                <div class="my-2">
                    <a href="#" onclick="fixDurationTimeCalc()" class="btn btn-muted">fix time</a>
                </div>
                <div id="result" class=" my-4">
                    <div class=" shadow-lg">

                        <div class="body col-span-5">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover text-center font-sans">
                                    <thead class="text-center">
                                        <tr>
                                            <th contenteditable colspan="6"
                                                style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold uppercase">Programme
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold">Time
                                            </th>
                                            <th style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold">
                                                Capsules & Modules </th>
                                            <th style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold">
                                                Musiciens</th>
                                            <th style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold">
                                                Chanteurs</th>
                                            <th style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold">Les
                                                coeurs</th>
                                            <th style="background-color: #FF0000;text-align: center; font-weight: bolder;"
                                                class="font-extrabold">
                                                Durée
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-center ">
                                        @php
                                            $i = 0;
                                            $totalTime = Carbon\Carbon::createFromTime(20, 30, 0);
                                        @endphp
                                        @foreach ($Music_by_category_list as $key => $values)
                                            @php
                                                $musics = App\Models\Music::whereIn('id', $values)->get();
                                            @endphp
                                            <tr class="text-center">
                                                <td style="font-size: 24px"
                                                    class="text-center uppercase text-2xl font-extrabold bg-gray-300"
                                                    colspan="6">
                                                    {{ $key }}
                                                </td>
                                            </tr>
                                    <tbody class="containers">

                                        @foreach ($musics as $music)
                                            <tr class="text-center draggable" draggable="true">
                                                <td id="time{{ $i }}" class="text-center time-calc">
                                                    {{ $totalTime->format('H:i:s') }}
                                                </td>

                                                @php
                                                    $timeParts = explode(':', $music->time);
                                                    $hours = intval($timeParts[0]);
                                                    $minutes = intval($timeParts[1]);
                                                    $seconds = intval($timeParts[2]);
                                                    
                                                    $totalTime->addHours($hours);
                                                    $totalTime->addMinutes($minutes);
                                                    $totalTime->addSeconds($seconds);
                                                @endphp
                                                <td class="text-center">{{ $music->name }}</td>
                                                <td class="text-center">{{ $music->type }}</td>
                                                <td class="text-center" contenteditable>
                                                    @php
                                                        $artist = App\Models\Artist::whereIn('id', $music->artist_id)->get();
                                                    @endphp
                                                    @foreach ($artist as $name_ar)
                                                        @if ($name_ar->is_available)
                                                            @if (isset($artist[$loop->index + 1]['is_available']) && $artist[$loop->index + 1]['is_available'] == 1)
                                                                {{ $name_ar->name }} /
                                                            @else
                                                                {{ $name_ar->name }}
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center" contenteditable>{{ $music->coeurs }}</td>
                                                <td id="duration" class="text-center">{{ substr($music->time, 3) }}</td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('printThis.js') }}"></script>
    <script src="{{ asset('html2canvas.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
    <script>
        $(document).ready(function() {
            $('#btnSave').click(function() {
                $('#result').printThis({
                    importCSS: false,
                    loadCSS: "",
                    pageTitle: "Page title",
                    importStyle: true, // import style tags
                    printContainer: true, // print outer container/$.selector
                });

            })
        })

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
    {{-- <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script> --}}
    <script src="{{ asset('xlsx.js') }}"></script>
    <script>
        // function exportToExcel() {
        //     // Get the HTML table element
        //     var table = document.getElementById("myTable");

        //     // Create a new workbook
        //     var wb = XLSX.utils.table_to_book(table);

        //     // Modify the header cell styles in the workbook
        //     var sheetName = wb.SheetNames[0];
        //     var ws = wb.Sheets[sheetName];
        //     var headerRange = XLSX.utils.decode_range(ws["!ref"]);
        //     for (var col = headerRange.s.c; col <= headerRange.e.c; col++) {
        //         var cellAddress = XLSX.utils.encode_cell({
        //             r: headerRange.s.r,
        //             c: col
        //         });
        //         var headerCell = ws[cellAddress];
        //         headerCell.s = {
        //             fill: {
        //                 fgColor: {
        //                     rgb: "FFFF0000"
        //                 }
        //             }, // Change the background color here
        //             alignment: {
        //                 horizontal: "center"
        //             },
        //             font: {
        //                 bold: true
        //             }
        //         };
        //     }

        //     // Convert the workbook to an Excel file
        //     var wbout = XLSX.write(wb, {
        //         bookType: "xlsx",
        //         type: "array"
        //     });

        //     // Create a Blob object for the workbook data
        //     var blob = new Blob([wbout], {
        //         type: "application/octet-stream"
        //     });

        //     // Generate a download link
        //     var url = URL.createObjectURL(blob);
        //     var link = document.createElement("a");
        //     link.href = url;
        //     link.download = "table.xlsx";

        //     // Trigger the download
        //     link.click();
        // }

        function exportToExcel() {
            // Get the HTML table element
            var table = document.getElementById("myTable");

            // Create a new workbook
            var wb = XLSX.utils.table_to_book(table);

            // Convert the workbook to an Excel file
            var wbout = XLSX.write(wb, {
                bookType: "xlsx",
                type: "array"
            });

            // Create a Blob object for the workbook data
            var blob = new Blob([wbout], {
                type: "application/octet-stream"
            });

            // Generate a download link
            var url = URL.createObjectURL(blob);
            var link = document.createElement("a");
            link.href = url;
            link.download = "Music-Programme.xlsx";

            // Trigger the download
            link.click();
        }
    </script>
    <script>
        function fixDurationTimeCalc() {
            const duration = document.querySelectorAll('#duration')
            const divs = document.querySelectorAll('.time-calc')
            const times = ['00:00:00'];

            duration.forEach(element => {
                times.push('00:' + element.innerHTML)
            });



            // Initialize total time in seconds
            let totalTime = parseInt(20) * 3600 + parseInt(30) * 60 + parseInt(0);
            let i = 1;
            let j = 0;

            // Sum the array of time values
            divs.forEach(div => {
                var [hours, minutes, seconds] = times[j].split(':');
                totalTime += parseInt(hours) * 3600 + parseInt(minutes) * 60 + parseInt(seconds);

                // Convert total time back to readable formatx
                var hours = Math.floor(totalTime / 3600);
                var minutes = Math.floor((totalTime % 3600) / 60);
                var seconds = totalTime % 60;


                // Create a <div> element to display the result
                // var resultDiv = document.getElementById('time' + i);
                div.innerHTML =
                    ` ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                console.log(i++);
                j++;

            });

        }
    </script>
@endsection
