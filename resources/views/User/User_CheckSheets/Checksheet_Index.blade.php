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
                    <h3>Total Checksheet: <span>{{ $total }}</span></h3>
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
                                <a href="{{ url('/user/checkforms/'. $checksheet->checksheet_name) }}" class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                                    <i class="fa-solid fa-file icon text-primary d-block mb-4"></i>
                                    <h3 class="mb-3 mt-0">{{ $checksheet->checksheet_name }}</h3>
                                    <p class="mb-0">Organize: {{ $checksheet->organize }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {!! $checksheets->links() !!}
                </div>
            </div>
        </div>

        @include('User.User_CheckSheets.Checksheet_Js')
        {!! Toastr::message() !!}
    </body>

    </html>
@endsection
