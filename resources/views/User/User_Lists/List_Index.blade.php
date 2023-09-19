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

    <link href="/theme/assets/check_css/stlye.css" rel="stylesheet" />

    <!-- Toastr Message -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @vite(['', '']) --}}

</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = App\Models\Admin::where('username', $user->username)->first();
    @endphp
    @if ($isAdmin)
        @include('Sidebar.Admin.Admin_Sidebar')
    @else
        @include('Sidebar.User.User_Sidebar')
    @endif
    <div class="main-content">
        <main>
            <div class="recent-grid">
                <div class="checks pb-3">
                    <input type="hidden" name="checksheet_name" id="checksheet_name" value="{{ $checksheet_name }}">
                    <input type="hidden" name="checklist_organize" id="checklist_organize"
                        value="{{ $checklist_organize }}">

                    <div class="alert alert-danger print-error-msg-check" style="display:none">
                        <span class="error"></span>
                    </div>
                    <div class="card-checks">
                        <div class="card-header">
                            @php
                                $checklist_name = App\Models\Checklists::find($checklist_organize);
                            @endphp
                            @if ($checklist_name)
                                <h3 class="m-3">{{ $checklist_name['checklist_name'] }}</h3>
                            @else
                                <h3 class="m-3">What!!??</h3>
                            @endif
                            <button type="submit" id="submit_data" class="d-none submit_form m-3"
                                data-date="{{ Carbon\Carbon::today()->format('Y-m-d') }}">Submit <span
                                    class="fa fa-angles-right"></span></button>
                        </div>
                        <div class="card-body-checks">
                            <div class="table-responsive">
                                <input type="hidden" name="list_count" id="list_count" value="{{ $list_count }}">
                                @if ($lists->count())
                                    @foreach ($lists as $key => $list)
                                        <div class="flex-container">
                                            <div class="input-with-option">
                                                {{-- <div class="keys"> --}}
                                                {{ ++$key }}
                                                {{-- </div> --}}
                                                <input type="hidden" name="checklist_id-{{ $key }}"
                                                    id="checklist_id-{{ $key }}"
                                                    value="{{ $list->checklist_organize }}">
                                                <input type="hidden" name="check_id-{{ $key }}"
                                                    id="check_id-{{ $key }}"
                                                    value="{{ $list->list_detail }}">
                                                <input type="hidden" name="it" id="it"
                                                    value="{{ Auth::user()->username }}">
                                                {{ $list->list_detail }}
                                                <div class="details">
                                                    <input type="hidden" name="details-{{ $key }}"
                                                        id="details-{{ $key }}"
                                                        value="{{ $list->list_detail }}">
                                                </div>
                                            </div>
                                            <div class="wrapper">
                                                <input type="radio" name="status{{ $list->list_detail }}"
                                                    id="status-1-{{ $list->list_detail }}"
                                                    data-id="status-1-{{ $list->list_detail }}" value="1"
                                                    class="sub_chk">
                                                <input type="radio" name="status{{ $list->list_detail }}"
                                                    id="status-0-{{ $list->list_detail }}"
                                                    data-id="status-0-{{ $list->list_detail }}" value="0"
                                                    class="sub_chk">

                                                <label for="status-1-{{ $list->list_detail }}"
                                                    class="option option-1 w-comment" data-key="{{ $key }}"
                                                    data-status="1">
                                                    <div class="dot"></div>
                                                    <span>Normal</span>
                                                </label>
                                                <label for="status-0-{{ $list->list_detail }}"
                                                    class="option option-0 w-comment" data-key="{{ $key }}"
                                                    data-status="0">
                                                    <div class="dot"></div>
                                                    <span>Abnormal</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group py-2 px-4">

                                            <input type="text" class="form-control d-none"
                                                name="comment-{{ $key }}" id="comment-{{ $key }}"
                                                placeholder="Comment...">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center my-2">
                                        <h2>No data yet.</h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checklists">
                    <div class="card-checklists">
                        <div class="card-header">
                            <h3 class="m-3">All checklist</h3>
                            <input type="text" name="search_checklist_list" id="search_checklist_list"
                                class="search_checklist_list" placeholder="Search Checklist...">
                        </div>
                        <div class="card-body-checklists">
                            <div class="search-body">
                                @foreach ($checklists as $key => $checklist)
                                    <a class="{{ Request::is('user/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) ? 'active' : '' }}"
                                        href="{{ url('user/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) }}">
                                        <div class="checklist">
                                            <div class="info">
                                                <div class="filter-checklists">
                                                    <h4>{{ $checklist->checklist_name }} </h4>
                                                    <small>Status:
                                                        <span>{{ $checklist->lists->count() }}</span></small>
                                                    <input type="hidden" name="checkform_organize"
                                                        id="checkform_organize"
                                                        value="{{ $checklist->checkform_organize }}">
                                                    <input type="hidden" name="checksheet_name" id="checksheet_name"
                                                        value="{{ $checksheet_name }}">
                                                    <input type="hidden" name="checklist_organize"
                                                        id="checklist_organize"
                                                        value="{{ $checklist->checklist_organize }}">
                                                </div>
                                            </div>

                                            <div class="list">
                                                <span class="fa-solid fa-sheet-plastic"></span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="pagination justify-content-center">
                                {!! $checklists->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('User.User_Lists.List_Js')
    {{-- @include('user.lockcheck.lock_js') --}}

</body>
