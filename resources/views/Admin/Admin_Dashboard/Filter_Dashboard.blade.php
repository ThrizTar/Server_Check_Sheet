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
                                                            <span class="text-danger">{{ $numericValue }}</span>
                                                        @else
                                                            {{ $numericValue }}
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
                                                        <span class="fa-solid fa-exclamation comment"></span>
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
