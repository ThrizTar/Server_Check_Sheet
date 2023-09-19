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
                                @if ($checkform->form_type == 'checklist')
                                    <a href="{{ url('/user/checklists/' . $checksheet_name . '/' . $checkform->checkform_organize) }}"
                                        class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                                        <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                                        <h3 class="mb-3 mt-0">{{ $checkform->checkform_name }}</h3>
                                        <h4 class="mb-3 mt-0">Type: {{ $checkform->form_type }}</h4>
                                        <h6 class="mb-3 mt-0">({{ $checksheet_name }})</h6>
                                    </a>
                                @else
                                    @php
                                        $delspace_checkform_name = str_replace(' ', '-', $checkform->checkform_name);
                                    @endphp
                                    <a href=""
                                        class="px-3 py-5 bg-white shadow text-center d-block match-height check"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addFillInputModal-{{ $delspace_checkform_name }}">
                                        <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                                        <h3 class="mb-3 mt-0">{{ $checkform->checkform_name }}</h3>
                                        <h4 class="mb-3 mt-0">Type: {{ $checkform->form_type }}</h4>
                                        <h6 class="mb-3 mt-0">({{ $checksheet_name }})</h6>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {!! $checkforms->links() !!}
                </div>
            </div>
        </div>
        @foreach ($checkforms as $key => $checkform)
            @if ($checkform->form_type != 'checklist')
                @php
                    $delspace_checkform_name = str_replace(' ', '-', $checkform->checkform_name);
                @endphp
                @include('User.User_Input.Add_Input_Modal')
            @endif
        @endforeach

        @include('User.User_Checkforms.Checkform_Js')
        {!! Toastr::message() !!}
    </body>

    </html>
@endsection
