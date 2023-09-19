@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en-us">

    <head>
        <meta charset="utf-8">
        <title>Admin Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- theme meta -->
        <meta name="theme-name" content="Admin Home" />

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/theme/plugins/bootstrap/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <!-- Main Stylesheet -->
        <link href="/theme/assets/style.css" rel="stylesheet" media="screen" />

        <!-- Toastr message -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body>
        <div class="container">
            <div class="row mb50">
                <div class="total-checksheets text-center my-3">
                    <h3>Total Checksheet: <span>{{ $total }}</span> EiEi </h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body my-1">
                        <input type="text" name="search_checksheet" id="search_checksheet"
                            class="form-control-search search_checksheet" placeholder="Search Here...">
                    </div>
                </div>
            </div>
            <div class="whos-speaking">
                <div class="whos-speaking-area speakers pad100">
                    <div class="row mb50">
                        @foreach ($checksheets as $checksheet)
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="speakers xs-mb30">
                                    <div class="spk-img">
                                        <a href=""
                                            class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                                            <i class="fa-solid fa-file icon text-primary d-block mb-4"></i>
                                            <h3 class="mb-3 mt-0">{{ $checksheet->checksheet_name }}</h3>
                                            <p class="mb-0">Organize: {{ $checksheet->organize }}</p>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="" class="fa fa-pen-to-square update_checksheet_form"
                                                    data-bs-toggle="modal" data-toggle="tooltip" data-placement="top"
                                                    title="Edit" data-bs-target="#updateModal"
                                                    data-checksheet_name="{{ $checksheet->checksheet_name }}"
                                                    data-organize="{{ $checksheet->organize }}">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="fa fa-trash del_checksheet_form"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    data-bs-toggle="modal" data-bs-target="#delModal"
                                                    data-checksheet_name="{{ $checksheet->checksheet_name }}">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/checkforms/' . $checksheet->checksheet_name) }}"
                                                    class="fa fa-wpforms" data-toggle="tooltip" data-placement="top"
                                                    title="Checkforms">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height "
                                data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fa-solid fa-file-circle-plus icon mt-0 mb-4"></i>
                                <h3 class="mb-3 mt-0">Add New</h3>
                                <h3 class="mb-3 mt-0">Checksheet</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {!! $checksheets->links() !!}
                </div>
            </div>
        </div>

        @include('Admin.Admin_CheckSheets.Manage_CheckSheets.Create_Checksheet_Modal')
        @include('Admin.Admin_CheckSheets.Manage_CheckSheets.Update_Checksheet_Modal')
        @include('Admin.Admin_CheckSheets.Manage_CheckSheets.Delete_Checksheet_Modal')
        @include('Admin.Admin_CheckSheets.Manage_CheckSheets.Checksheet_Js')
        {!! Toastr::message() !!}
    </body>

    </html>
@endsection
