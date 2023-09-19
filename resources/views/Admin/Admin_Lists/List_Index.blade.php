<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Check Manage</title>
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
    @include('Sidebar.Admin.Admin_Sidebar')
    <div class="main-content">
        <main>

            <div class="cards-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#createModal">
                    <div class="card-single-normal">
                        <div>
                            <h1>Create</h1>
                            <span>Create new list</span>
                        </div>
                        <div>
                            <div class="normal">
                                <span class="fa-solid fa-plus fa-fade"></span>
                            </div>
                        </div>
                    </div>
                </button>
                <div class="card-single-total">
                    <div>
                        <h1>{{ $lists->count() }}</h1>
                        <span>Total Lists</span>
                    </div>
                    <div>
                        <span class="fa-solid fa-list-ol"></span>
                    </div>
                </div>
            </div>

            <div class="recent-grid">
                <div class="checks pb-3">
                    <div class="card-c">
                        <div class="card-header">
                            @php
                                $checklist_name = App\Models\Checklists::find($checklist_organize);
                            @endphp
                            <h3>{{ $checklist_name['checklist_name'] }}</h3>
                            <button type="button" class="d-none del delete_selected_lists" id="deleteSelectedBtn"
                                data-bs-toggle="modal" data-bs-target="#deleteSelectedModal"><span
                                    class="fa fa-angles-right"></span></button>
                        </div>
                        <div class="card-body-checks">
                            <div class="table-responsive">
                                <table id="check_table" class="table" width="100%">
                                    <thead class="text-center">
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="main_checkbox_check"
                                                    id="main_checkbox_check">
                                                <label for="main_checkbox_check"></label>
                                            </td>
                                            <td>No.</td>
                                            <td>Details</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($lists->count())
                                            @foreach ($lists as $key => $list)
                                                <tr class="text-center" id="tr_{{ $list->list_detail }}">
                                                    <td>
                                                        <input type="checkbox" class="sub_chk"
                                                            data-id="{{ $list->list_detail }}">
                                                    </td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $list->list_detail }}</td>

                                                    <td>
                                                        <a href=""
                                                            class="text text-warning mr-1 update_list_form"
                                                            data-bs-toggle="modal" data-bs-target="#updateModal"
                                                            data-list_id="{{ $list->list_detail }}">
                                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="" class="text text-danger delete_list_form"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-list_id="{{ $list->list_detail }}">
                                                            <i class="fa-solid fa-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <div class="text-center">
                                                <h2>No data yet.</h2>
                                            </div>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checklists">
                    <div class="card-c">
                        <div class="card-header">
                            <h3 class="text-center">All checklist</h3>
                            <input type="text" name="search_checklist_list" id="search_checklist_list"
                                class="search_checklist_list" placeholder="Search Checklist...">
                        </div>
                        <div class="card-body-checklists">
                            @foreach ($checklists as $key => $checklist)
                                <a class="{{ Request::is('admin/lists/*' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) ? 'active' : '' }}"
                                    href="{{ url('admin/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) }}">
                                    <div class="checklist">
                                        <div class="info">
                                            <div class="filter-checklists">
                                                <h4>{{ $checklist->checklist_name }} </h4>
                                                <small>Total: <span>{{ $checklist->lists->count() }}</span></small>
                                                <input type="hidden" name="checkform_organize" id="checkform_organize"
                                                    value="{{ $checklist->checkform_organize }}">
                                                <input type="hidden" name="checksheet_name" id="checksheet_name"
                                                    value="{{ $checksheet_name }}">
                                            </div>
                                        </div>
                                        <div class="list">
                                            <span class="fa-solid fa-sheet-plastic"></span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="pagination justify-content-center">
                                {!! $checklists->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('Admin.Admin_Lists.Manage_Lists.Create_List_Modal')
    @include('Admin.Admin_Lists.Manage_Lists.Update_List_Modal')
    @include('Admin.Admin_Lists.Manage_Lists.Delete_List_Modal')
    @include('Admin.Admin_Lists.Manage_Lists.Delete_Selected_List_Modal')
    @include('Admin.Admin_Lists.Manage_Lists.List_Js')
</body>

</html>
