@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en-us">

    <head>
        <meta charset="utf-8">
        <title>Admin Checklist</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- theme meta -->
        <meta name="theme-name" content="Admin Checklist" />

        <!-- ** CSS Plugins Needed for the Project ** -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="/theme/plugins/bootstrap/bootstrap.min.css">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <!-- Main Stylesheet -->
        <link href="/theme/assets/style.css" rel="stylesheet" media="screen" />

        <!-- Totastr Message -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body>
        <div class="container">
            <div class="row mb50">
                <div class="checklist-header text-center mb-5">
                    <h1>{{ $checksheet_name }}</h1>
                    <input type="hidden" name="checksheet_name" id="checksheet_name" value="{{ $checksheet_name }}">
                    <input type="hidden" name="checkform_organize" id="checkform_organize" value="{{ $checkform_organize }}">
                    <input type="hidden" name="organize" id="organize" value=" {{ $checksheet['organize'] }} ">
                </div>
                <div class="total-checklists text-center my-3">
                    <h3>Total Checklist: <span>{{ $total }}</span></h3> 
                </div>
                <div class="panel panel-default">
                    <div class="panel-body my-1">
                        <input type="text" name="search_checklists" id="search_checklists" class="form-control-search search_checklists"
                            placeholder="Search Here...">
                    </div>
                </div>
            </div>

            <div class="whos-speaking">
                <div class="whos-speaking-area speakers pad100">
                    <div class="row mb50">
                        @foreach ($checklists as $checklist)
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="speakers xs-mb30">
                                    <div class="spk-img">
                                        <a href="#"
                                            class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                                            <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                                            <h3 class="mb-3 mt-0">{{ $checklist->checklist_name }}</h3>
                                            <h3 class="mb-3 mt-0">Organize: {{ $checksheet['organize'] }}</h3>
                                            @php
                                                $checkform_name = App\Models\checkforms::find($checkform_organize);
                                            @endphp
                                            <h6 class="mb-3 mt-0">({{ $checkform_name['checkform_name'] }})</h6>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#" class="fa fa-pen-to-square update_checklist_form"
                                                    data-bs-toggle="modal" data-bs-target="#updateModal"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    data-checklist_organize="{{ $checklist->checklist_organize }}"
                                                    data-checklist_name="{{ $checklist->checklist_name }}">

                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="fa fa-trash delete_checklist_form"
                                                    data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-placement="top"data-checklist_organize="{{ $checklist->checklist_organize }}"
                                                    title="Delete">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/lists/' . $checksheet_name . '/' . $checklist->checkform_organize . '/' . $checklist->checklist_organize) }}"
                                                    class="fa fa-circle-check" data-toggle="tooltip" data-placement="top"
                                                    title="Lists">
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height "
                                data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="fa-regular fa-square-plus icon mt-0 mb-3"></i>
                                <h3 class="mb-3 mt-0">Add new </h3>
                                <h3 class="mb-3 mt-0">Check List </h3>
                                <h3 class="mb-3 mt-0">Title</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {!! $checklists->links() !!}
                </div>
            </div>
        </div>
        @include('Admin.Admin_Checklists.Manage_Checklists.Create_Checklist_Modal')
        @include('Admin.Admin_Checklists.Manage_Checklists.Update_Checklist_Modal')
        @include('Admin.Admin_Checklists.Manage_Checklists.Delete_Checklist_Modal')
        @include('Admin.Admin_Checklists.Manage_Checklists.Checklist_Js')
        {!! Toastr::message() !!}
    </body>

    </html>
@endsection
