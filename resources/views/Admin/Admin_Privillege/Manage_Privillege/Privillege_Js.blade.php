<!-- jquiry -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

<!-- Main Script -->
<script src="/theme/assets/script.js"></script>

<!-- Toastr Message -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/37792c9d45.js" crossorigin="anonymous"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.grant_privillege', function(e) {
            e.preventDefault();
            var username = $('#username').val();

            $.ajax({
                method: "GET",
                url: "{{ route('admin.grant-privillege') }}",
                data: {
                    username: username,
                },
                success: function(res) {
                    if (res['status'] == 'success') {
                        // reset value in add modal
                        $('#grantPModal').modal('hide');
                        $('#grantPForm')[0].reset();

                        $('.card-body-checks').load(location.href + ' .card-body-checks');

                        Command: toastr["success"]("Grant privillege has been successfully",
                            "Success")
                        console.log(res['message']);

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        Command: toastr["error"]("Error",
                            [res.error])

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            })
        })

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }

        $(document).on('click', '.import_user', function(e) {
            e.preventDefault();
            var username = $(this).data('username_import')
            console.log("username: " + username);
            $.ajax({
                method: "GET",
                url: "{{ route('admin.grant-privillege') }}",
                data: {
                    username: username,
                },
                success: function(res) {
                    if (res['status'] == 'success') {

                        $('#grantP_userModal').modal('hide');
                        $('.card-body-checks').load(location.href + ' .card-body-checks');

                        Command: toastr["success"]("Grant privillege for " + username +
                            " has been successfully",
                            "Success")
                        console.log(res['message']);

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        Command: toastr["error"]("Error",
                            [res.error])

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            })
        })

        $(document).on('click', '.disallow_modal', function(e) {
            e.preventDefault();
            var username = $(this).data('username');

            var check = $('#disallowModal').modal('show');
            $('.disallow').on('click', function() {
                var confirm = $(this).data('confirm');

                if (confirm == true) {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('admin.disallow-privillege') }}",
                        data: {
                            username: username,
                        },
                        success: function(res) {
                            if (res['status'] == 'success') {
                                // reset value in add modal
                                $('#disallowModal').modal('hide');

                                $('.card-body-checks').load(location.href +
                                    ' .card-body-checks');

                                Command: toastr["success"](
                                    "Disallow this user from admin privillege",
                                    "Success")
                                console.log(res['message']);

                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            } else {
                                console.log(res['message']);

                                Command: toastr["error"](
                                    "Something Wrong??!"
                                )

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            }
                        }
                    })
                }
            })

        })

        // Pagination User Import
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            import_user(page)
        })

        function import_user(page) {
            $.ajax({
                url: "/admin/import-user/pagination/paginate-data?page=" + page,
                success: function(res) {
                    $('table#user_table').html(res);
                }
            })
        }

        // Search User Import
        $(document).on('keyup', '.search_user', function(e) {
            e.preventDefault();
            let search_string = $('#search_user').val();
            console.log(search_string);
            $.ajax({
                url: "{{ route('admin.search-users') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('table#user_table').html(res);
                }
            })
        })
    })
</script>
