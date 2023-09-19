<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>View User Check</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="View User Check" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }


        td,
        h3 {
            font-family: "THSarabunNew";
        }

        .checklist-name h3,
        .checklist-name h4 {
            margin-bottom: 0rem;
            margin-top: 0rem
        }

        .text-center {
            text-align: center;
        }

        td span.tp {
            font-size: .8rem;
            display: inline-block;
            margin-left: -0.4rem;
            margin-right: -0.4rem;
        }

        table#viewcheck_table thead {
            border-right: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table#viewcheck_table tbody {
            border-right: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table#viewcheck_table tbody td {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }

        table#viewcheck_table thead th.detail-1 {
            border-right: 1px solid #ccc;
        }

        table#viewcheck_table thead th.detail-2 {
            border-right: 1px solid #ccc;
        }

        table#viewcheck_table thead th.status {
            border-bottom: 1px solid #ccc;
        }

        table#viewcheck_table thead th.border-right {
            border-right: 1px solid #ccc;
        }
    </style>

</head>

<body>
    <div class="main-content">
        <main>

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
                                                <th rowspan="2" class="detail-1">Details</th>
                                                <th colspan="{{ $daysInMonth + 1 }}" class="status">Status</th>
                                            </tr>
                                            <tr>
                                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                                    <th class="day{{ $day !== $daysInMonth ? ' border-right' : '' }}">
                                                        {{ $day }}</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody class="checklist-group">
                                            @foreach ($checkform_inputs as $checkform_input)
                                                <tr class="">
                                                    <td colspan="{{ $daysInMonth + 2 }}" class="checklist-name">
                                                        <h4>{{ $checkform_input->checkform_name }}</h4>
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
                                                                                                class="text-success fa-solid fa-check">L</span>
                                                                                        @else
                                                                                            <span
                                                                                                class="text-danger fa-solid fa-xmark">U</span>
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
                                        <th rowspan="2" class="detail-2">Details</th>
                                        <th colspan="{{ $daysInMonth + 1 }}" class="status">Status</th>
                                    </tr>
                                    <tr>
                                        @for ($day = 1; $day <= $daysInMonth; $day++)
                                            <th class="day{{ $day !== $daysInMonth ? ' border-right' : '' }}">
                                                {{ $day }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="checklist-group">
                                    @foreach ($checklists as $checklist)
                                        <tr class="">
                                            <td colspan="{{ $daysInMonth + 2 }}" class="checklist-name">
                                                <span>
                                                    <h3>{{ $checklist->checklist_name }}</h3>
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
                                                                <span class="status">N</span>
                                                            @elseif ($status === '0')
                                                                <span class="status">A</span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="comment">
                                <div class="comment-header ml-2">
                                    <span>
                                        <h3>Comment From Users: </h3>
                                    </span>
                                </div>
                                @foreach ($userchecks as $usercheck)
                                    <div class="comment-detail-group ml-2 mb-2">
                                        @if ($usercheck->comment != null && Carbon\Carbon::parse($usercheck->created_at)->format('Y-m-d') == $todayDate)
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
</body>
