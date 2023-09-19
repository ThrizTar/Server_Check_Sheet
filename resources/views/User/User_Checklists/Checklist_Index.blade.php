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
                </div>
                <div class="total-checklists">
                    <div class="text-center my-3">
                        <h3>Total Checklist: <span>{{ $total }}</span></h3>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body my-1">
                        <input type="text" name="search_checklist" id="search_checklist" class="form-control-search search_checklist"
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
                                    <a href=" {{ url('user/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) }} "
                                        class="px-3 py-5 bg-white shadow text-center d-block match-height">
                                        <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                                        <h3 class="mb-3 mt-0">{{ $checklist->checklist_name }}</h3>
                                        <h4 class="mb-3 mt-0">Organize: {{ $checksheet['organize'] }}</h4>
                                        <h6 class="mb-3 mt-0">({{ $checksheet_name }})</h6>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {!! $checklists->links() !!}
                </div>
            </div>
        </div>
        @include('User.User_Checklists.Checklist_Js')
        {!! Toastr::message() !!}
    </body>

    </html>
@endsection
