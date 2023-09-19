<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>View User Check</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="View User Check" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Main Stylesheet -->
    <link href="/theme/assets/check_css/stlye.css" rel="stylesheet" />

    <!-- Toastr Message -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite(['', '']) --}}

</head>

<body>
    @include('Sidebar.Admin.Admin_Sidebar')
    <div class="main-content">
        <main>
            <div class="button-export mb-3">
                <a class="btn btn-primary" href="{{ route('admin.export-pdf-server', ['checksheet_name' => $checksheet_name]) }}">Export to PDF</a>
                <a class="btn btn-primary" href="{{ route('admin.export-excel-server', ['checksheet_name' => $checksheet_name]) }}">Export to Excel</a>
            </div>
            <div class="recent-grid-export">
                <div class="checks">
                    <div class="card-c mb-4">
                        <div class="card-body-checks">
                            <div class="table-responsive">
                                <div class="month-name text-center m-3">
                                    <h3>Data in {{ $monthName }} {{ $year }}</h3>
                                </div>
                                @if ($checkform_inputs->count() >= 1)
                                    <table id="viewcheck_table" class="table" width="100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2" class="pb-4">Details</th>
                                                <th colspan="{{ $daysInMonth + 1 }}">Status</th>
                                            </tr>
                                            <tr>
                                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                                    <th>{{ $day }}</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody class="checklist-group">
                                            @foreach ($checkform_inputs as $checkform_input)
                                                <tr class="">
                                                    <td colspan="{{ $daysInMonth + 2 }}" class="checklist-name">
                                                        <span>
                                                            <h4>{{ $checkform_input->checkform_name }}</h4>
                                                        </span>
                                                    </td>
                                                </tr>
                                                @foreach ($periods as $period)
                                                    @if ($period->checkform_organize == $checkform_input->checkform_organize)
                                                        <tr>
                                                            <td>- {{ $period->option_detail }}</td>
                                                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                                                <td class="text-center">
                                                                    @foreach ($fill_inputs as $fill_input)
                                                                        @if ($period->form_fill_input == 'Period(TempChecking)')
                                                                            {{-- {{ $period->form_fill_input }} --}}
                                                                            @if (isset($groupedData[$fill_input->created_at][$day][$period->form_fill_input]))
                                                                                @if ($groupedData[$fill_input->created_at][$day][$period->form_fill_input]['Period'][0] == $period->option_detail)
                                                                                    @php
                                                                                        $humidityData = $groupedData[$fill_input->created_at][$day]['Humidity(TempChecking)']['Humidity'] ?? null;
                                                                                        $tempData = $groupedData[$fill_input->created_at][$day]['Temp(TempChecking)']['Temp'] ?? null;
                                                                                    @endphp
                                                                                    @if ($humidityData !== null && $tempData !== null)
                                                                                        <span
                                                                                            class="tp">{{ $tempData[0] }}/{{ $humidityData[0] }}</span>
                                                                                    @endif
                                                                                @break
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($period->form_fill_input == 'Period(LockChecking)')
                                                                            @if (isset($groupedData[$fill_input->created_at][$day][$period->form_fill_input]))
                                                                                @if ($groupedData[$fill_input->created_at][$day][$period->form_fill_input]['Period'][0] == $period->option_detail)
                                                                                    @php
                                                                                        $StatusData = $groupedData[$fill_input->created_at][$day]['Status(LockChecking)']['Status'] ?? null;
                                                                                    @endphp
                                                                                    @if ($StatusData !== null)
                                                                                        @if ($StatusData[0] == 'Locked')
                                                                                            <span
                                                                                                class="text-success fa-solid fa-check"></span>
                                                                                        @else
                                                                                            <span
                                                                                                class="text-danger fa-solid fa-xmark"></span>
                                                                                        @endif
                                                                                    @endif
                                                                                @break
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if ($checklists->count() >= 1)
                            <table id="viewcheck_table" class="table" width="100%">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2" class="pb-4">Details</th>
                                        {{-- <th>Status</th> --}}
                                        <th colspan="{{ $daysInMonth + 1 }}">Status</th>
                                    </tr>
                                    <tr>
                                        @for ($day = 1; $day <= $daysInMonth; $day++)
                                            <th>{{ $day }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="checklist-group">
                                    @foreach ($checklists as $checklist)
                                        <tr class="">
                                            <td colspan="{{ $daysInMonth + 2 }}" class="checklist-name">
                                                <span>
                                                    <h4>{{ $checklist->checklist_name }}</h4>
                                                </span>
                                            </td>
                                        </tr>
                                        @foreach ($lists as $list)
                                            @if ($list->checklist_organize == $checklist->checklist_organize)
                                                <tr>
                                                    <td>- {{ $list->list_detail }}</td>
                                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                                        <td>
                                                            @php
                                                                $status = null;
                                                                foreach ($userchecks as $usercheck) {
                                                                    if ($usercheck->checklist_organize == $checklist->checklist_organize && Carbon\Carbon::parse($usercheck->created_at)->format('d') == $day && $usercheck->list_detail == $list->list_detail) {
                                                                        $status = $usercheck->status;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($status === '1')
                                                                <span
                                                                    class="text-success fa-solid fa-check"></span>
                                                            @elseif ($status === '0')
                                                                <span
                                                                    class="text-danger fa-solid fa-xmark"></span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="comment m-2">
                                <div class="comment-header">
                                    <span>
                                        <h3>Comment From Users: </h3>
                                    </span>
                                </div>
                                @foreach ($userchecks as $usercheck)
                                    <div class="comment-detail-group">
                                        @if ($usercheck->comment != '' && Carbon\Carbon::parse($usercheck->created_at)->format('Y-m-d') == $todayDate)
                                            <div class="comment-detail">
                                                <span>
                                                    {{ $usercheck->list_detail }}:
                                                </span>
                                                <span>
                                                    {{ $usercheck->comment }}
                                                </span>

                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
@include('Admin.Admin_Dashboard.Dashboard_Js')
</body>
