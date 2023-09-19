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

    <!-- Main Stylesheet -->
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
                <button type="button" data-bs-toggle="modal" data-bs-target="#grantPModal">
                    <div class="card-single-normal">
                        <div>
                            <h1>From Server</h1>
                            <span>Grant new privillege to user in server</span>
                        </div>
                        <div>
                            <div class="normal">
                                <span class="fa-solid fa-plus fa-fade"></span>
                            </div>
                        </div>
                    </div>
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#grantP_userModal">
                    <div class="card-single-import">
                        <div>
                            <h1>From Login</h1>
                            <span>Grant new privillege to user from login</span>
                        </div>
                        <div>
                            <span class="fa-solid fa-user-plus"></span>
                        </div>
                    </div>
                </button>
            </div>

            <div class="recent-grid-export mt-3 px-5">
                <div class="checks pb-3">
                    <div class="card-c">
                        <div class="card-header">
                            <h3>Administrator</h3>
                            <button type="button" class="d-none del delete_selected_lists" id="deleteSelectedBtn"
                                data-bs-toggle="modal" data-bs-target="#deleteSelectedModal"><span
                                    class="fa fa-angles-right"></span></button>
                        </div>
                        <div class="card-body-checks">
                            <div class="table-responsive">
                                <table id="check_table" class="table" width="100%">
                                    <thead class="text-center">
                                        <tr>
                                            <td>No.</td>
                                            <td>Username</td>
                                            <td>First Name</td>
                                            <td>Last Name</td>
                                            <td>Organize</td>
                                            <td>Department</td>
                                            {{-- <td>Is Admin</td> --}}
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $key => $admin)
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $admin->username }}</td>
                                                <td>{{ $admin->first_name }}</td>
                                                <td>{{ $admin->last_name }}</td>
                                                <td>{{ $admin->organize }}</td>
                                                <td>{{ $admin->department }}</td>
                                                <td><button type="button" class="btn btn-danger disallow_modal" data-username="{{ $admin->username }}" ><span class="fa-solid fa-user-minus"></span></button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('Admin.Admin_Privillege.Manage_Privillege.Privillege_Js')
    @include('Admin.Admin_Privillege.Manage_Privillege.Grant_Privillege_Modal')
    @include('Admin.Admin_Privillege.Manage_Privillege.Grant_From_User_Modal')
    @include('Admin.Admin_Privillege.Manage_Privillege.Disallow_Privillege_Modal')
</body>

</html>
