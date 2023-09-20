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

        <!-- themefy-icon -->
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
                    <input type="hidden" name="organize" id="organize" value="{{ $checksheet['organize'] }}">
                </div>
                <div class="total-checklists text-center my-3">
                    <h3>Total Checkform: <span>{{ $total }}</span></h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body my-1">
                        <input type="text" name="search_checkforms" id="search_checkforms"
                            class="form-control-search search_checkforms" placeholder="Search Here...">
                    </div>
                </div>
            </div>

            <div class="whos-speaking">
                <div class="whos-speaking-area speakers pad100">
                    <div class="row mb50">
                        @foreach ($checkforms as $key => $checkform)
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="speakers xs-mb30">
                                    <div class="spk-img">
                                        <a href="#"
                                            class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                                            <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                                            <h3 class="mb-3 mt-0">{{ $checkform->checkform_name }}</h3>
                                            <h4 class="mb-3 mt-0">Type: {{ $checkform->form_type }}</h4>
                                            <h6 class="mb-3 mt-0">( Organize: {{ $checksheet['organize'] }})</h6>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#" class="fa fa-pen-to-square update_checkform_form"
                                                    data-bs-toggle="modal" data-bs-target="#updateModal"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    data-checkform_organize = "{{ $checkform->checkform_organize }}"
                                                    data-checkform_name = " {{ $checkform->checkform_name }} "
                                                    data-form_type="{{ $checkform->form_type }}">

                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="fa fa-trash delete_checkform_form"
                                                    data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#delModal"
                                                    data-placement="top"
                                                    data-checkform_organize="{{ $checkform->checkform_organize }}" title="Delete">
                                                </a>
                                            </li>
                                            @php
                                                $delspace_checkform_name = str_replace(' ', '-', $checkform->checkform_name);
                                            @endphp
                                            @if ($checkform->form_type == 'checklist')
                                                <li>
                                                    <a href="{{ url('admin/checklists/' . $checksheet_name . '/' . $checkform->checkform_organize) }}"
                                                        class="fa fa-list-ul" data-toggle="tooltip"
                                                        data-placement="top" title="Checklist">
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="" class="fa fa-plus pass_name" data-bs-toggle="modal"
                                                        data-bs-target="#addInputModal-{{ $delspace_checkform_name }}"
                                                        data-checkform_name="{{ $checkform->checkform_name }}"
                                                        data-toggle="tooltip" data-placement="top" title="Add input">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fa fa-file-pen update_input_form"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateInputModal-{{ $delspace_checkform_name }}"
                                                        data-checkform_name="{{ $checkform->checkform_name }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Input">
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                        @include('Admin.Admin_Checkforms.Manage_Checkforms_Input.Create_Input_Modal')
                                        @include('Admin.Admin_Checkforms.Manage_Checkforms_Input.Update_Input_Modal')
                                        @include('Admin.Admin_Checkforms.Manage_Checkforms_Input.Delete_Input_Modal')
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height "
                                data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="fa-regular fa-square-plus icon mt-0 mb-3"></i>
                                <h3 class="mb-3 mt-0">Add new </h3>
                                <h3 class="mb-3 mt-0">Checkform </h3>
                                <h3 class="mb-3 mt-0">Title</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {!! $checkforms->links() !!}
                </div>
            </div>
        </div>
        @include('Admin.Admin_Checkforms.Manage_Checkforms.Checkform_Js')
        @include('Admin.Admin_Checkforms.Manage_Checkforms.Create_Checkform_Modal')
        @include('Admin.Admin_Checkforms.Manage_Checkforms.Update_Checkform_Modal')
        @include('Admin.Admin_Checkforms.Manage_Checkforms.Delete_Checkform_Modal')
        
        
        @include('Admin.Admin_Checkforms.Manage_Checkforms_Input.Input_Js')

        {!! Toastr::message() !!}
    </body>

    </html>
@endsection
