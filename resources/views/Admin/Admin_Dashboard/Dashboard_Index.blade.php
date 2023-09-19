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
            <div class="recent-grid">
                <div class="checks">
                    <input type="hidden" name="checksheet_name" id="checksheet_name" value="{{ $checksheet_name }}">
                    @foreach ($checkforms as $checkform)
                        @if ($checkform->form_type == 'fill_input')
                            <div class="card-c mb-4">
                                <div class="card-header">
                                    <h3>{{ $checkform->checkform_name }}</h3>
                                </div>
                                <div class="card-body-checks">
                                    <div class="table-responsive">
                                        <table id="viewcheck_table" class="table" width="100%">
                                            <thead class="text-center">
                                                <tr>
                                                    <td>Date</td>
                                                    @foreach ($fill_lists as $fill_list)
                                                        @if ($fill_list->checkform_organize == $checkform->checkform_organize)
                                                            <td>{{ $fill_list->input_title }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($usernameInputs[$checkform->checkform_organize]) && !empty($usernameInputs[$checkform->checkform_organize]))
                                                    @php
                                                        $groupedInputs = collect($usernameInputs[$checkform->checkform_organize])->groupBy('created_at');
                                                    @endphp
                                                    @foreach ($groupedInputs as $date => $inputs)
                                                        <tr class="text-center">
                                                            <td>{{ date('d/m/Y', strtotime($date)) }}</td>
                                                            @foreach ($fill_lists as $fill_list)
                                                                @if ($fill_list->checkform_organize == $checkform->checkform_organize)
                                                                    <td>
                                                                        @php
                                                                            $inputValue = $inputs->where('form_fill_input', $fill_list->form_fill_input)->first();
                                                                            $stringValue = $inputValue->input;
                                                                            $numericValue = is_numeric($stringValue) ? floatval($stringValue) : $stringValue;
                                                                        @endphp
                                                                        @if ($inputValue)
                                                                            @if ($fill_list->input_title === 'Temp' && $numericValue >= 26)
                                                                                <span
                                                                                    class="text-danger">{{ $numericValue }}</span>
                                                                            @else
                                                                                @if ($numericValue == 'Unlock')
                                                                                    <span
                                                                                        class="text-danger">{{ $numericValue }}</span>
                                                                                @else
                                                                                    {{ $numericValue }}
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="{{ count($fill_lists) + 1 }}" class="text-center">
                                                            No
                                                            data available</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($checklists as $checklist)
                                <div class="card-c mb-4">

                                    <div class="card-header">
                                        <h3>{{ $checklist->checklist_name }}</h3>
                                    </div>
                                    <div class="card-body-checks">
                                        <div class="table-responsive">
                                            <table id="viewcheck_table" class="table" width="100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <td>No.</td>
                                                        <td>Date</td>
                                                        <td>Details</td>
                                                        <td>Status</td>
                                                    </tr>
                                                </thead>
                                                <tbody class="checklist-group">
                                                    @if ($userchecks->count())
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($userchecks as $key => $usercheck)
                                                            @if ($usercheck->checklist_organize == $checklist->checklist_organize)
                                                                <tr class="text-center">

                                                                    <td>{{ $i++ }}</td>

                                                                    <td class="date-cell"
                                                                        data-date="{{ Carbon\Carbon::parse($usercheck->created_at)->format('d/m/Y') }}">
                                                                        {{ Carbon\Carbon::parse($usercheck->created_at)->format('d/m/Y') }}
                                                                    </td>
                                                                    @if ($usercheck->comment != null)
                                                                        <td>{{ $usercheck->list_detail }}
                                                                            <span
                                                                                class="fa-solid fa-exclamation comment"></span>
                                                                            <div class="more-info">
                                                                                <h5>Comment: {{ $usercheck->comment }}
                                                                                </h5>
                                                                            </div>
                                                                        </td>
                                                                    @else
                                                                        <td>{{ $usercheck->list_detail }}</td>
                                                                    @endif

                                                                    @if ($usercheck->status == 1)
                                                                        <td><span class="status normal pulse"></span>N
                                                                        </td>
                                                                    @elseif ($usercheck->status == 0)
                                                                        <td><span class="status abnormal pulse"></span>A
                                                                        </td>
                                                                    @else
                                                                        <td></td>
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4" class="text-center">No
                                                                data available</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
                <div class="checklists">
                    <div class="card-c">
                        <div class="card-header">
                            <h5>Filter Date</h5>
                            <button type="button" class="filter filter_checks">Filter <span
                                    class="fa-solid fa-filter "></span></button>
                        </div>

                        <div class="card-body-checklists">
                            <div class="checklist">
                                <div class="info">
                                    <div class="filter-date">
                                        <h4> Start Date: </h4>
                                        <input type="date" name="start_date" id="start_date"
                                            value="{{ Request::get('start_date') ?? date('Y-m-d') }}"
                                            class="custom-date-form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="checklist">
                                <div class="info">
                                    <div class="filter-date">
                                        <h4> End Date: </h4>
                                        <input type="date" name="end_date" id="end_date"
                                            value="{{ Request::get('end_date') ?? date('Y-m-d') }}"
                                            class="custom-date-form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    @include('Admin.Admin_Dashboard.Dashboard_Js')
</body>
