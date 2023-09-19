<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<!-- Totastr message -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<!-- ** JS Plugins Needed for the Project ** -->
<!-- jquiry -->
<script src="/theme/plugins/jquery/jquery-1.12.4.js"></script>
<!-- Bootstrap JS -->
<script src="/theme/plugins/bootstrap/bootstrap.min.js"></script>
<!-- match-height JS -->
<script src="/theme/plugins/match-height/jquery.matchHeight-min.js"></script>
<!-- Main Script -->
<script src="/theme/assets/script.js"></script>

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

        // Add checksheet
        $(document).on('click', '.create_checksheet', function(e) {
            e.preventDefault();
            let checksheet_name = $('#checksheet_name').val();
            let organize = $('#organize').val();

            $.ajax({
                url: "{{ route('admin.create-checksheet') }}",
                method: 'POST',
                data: {
                    checksheet_name: checksheet_name,
                    organize: organize,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        // reset value in add modal
                        $('#addModal').modal('hide');
                        $('#addCheckSheetForm')[0].reset();
                        $('.modal-contain-add').load(location.href + ' .modal-contain-add');

                        // reset data in whos-speaking and total-checksheets section
                        $('.whos-speaking').load(location.href + ' .whos-speaking');
                        $('.total-checksheets span').load(location.href +
                            ' .total-checksheets span');

                        // reset value in del checksheet form
                        $('.modal-contain-del').load(location.href + ' .modal-contain-del');

                        Command: toastr["success"](
                            "Checksheet has been created successfully",
                            "Success")

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
                            res.error)

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
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span>' + '<br>');
                    });

                }

            });
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }

        // Show checksheet value in update form
        $(document).on('click', '.update_checksheet_form', function() {
            let checksheet_name = $(this).data('checksheet_name');
            let old_checksheet_name = $(this).data('checksheet_name');
            let organize = $(this).data('organize');

            $('#up_checksheet_name').val(checksheet_name);
            $('#old_checksheet_name').val(old_checksheet_name);
            $('#up_organize').val(organize);
        });

        // Update checksheet
        $(document).on('click', '.update_checksheet', function(e) {
            e.preventDefault();
            let up_checksheet_name = $('#up_checksheet_name').val();
            let up_organize = $('#up_organize').val();
            let old_checksheet_name = $('#old_checksheet_name').val();

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.update-checksheet') }}",
                data: {
                    up_checksheet_name: up_checksheet_name,
                    old_checksheet_name: old_checksheet_name,
                    up_organize: up_organize
                },

                success: function(res) {
                    if (res.status == 'success') {
                        console.log(res['message']);
                        $('#updateModal').modal('hide');
                        $('#updateCheckSheetForm')[0].reset();
                        $('.whos-speaking').load(location.href +
                            ' .whos-speaking');
                        Command: toastr["success"](
                            "Checksheet has been updated successfully",
                            "Success")

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
                            res.error)

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
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span>' + '<br>');
                    });

                }

            })


        });

        // Show value in del checklist form
        $(document).on('click', '.del_checksheet_form', function() {
            let checksheet_name = $(this).data('checksheet_name');

            $('#del_checksheet_name').val(checksheet_name);

        });

        // Delete checksheet
        $(document).on('click', '.del_checksheet', function(e) {
            e.preventDefault();
            let checksheet_name = $('#del_checksheet_name').val();
            console.log(checksheet_name);

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.delete-checksheet') }}",
                data: {
                    checksheet_name: checksheet_name,
                },

                success: function(res) {
                    if (res.status == 'success') {
                        // reset value in del modal
                        $('#delModal').modal('hide');
                        $('.modal-contain-del').load(location.href + ' .modal-contain-del');

                        // reset value in add modal
                        $('.modal-contain-add').load(location.href + ' .modal-contain-add');

                        // // reset data in whos-speaking and total-checksheets section
                        $('.whos-speaking').load(location.href + ' .whos-speaking');
                        $('.total-checksheets span').load(location.href +
                            ' .total-checksheets span');

                        Command: toastr["success"](
                            "Checksheet has been deleted successfully",
                            "Success")

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
                    }
                },
            })

        });

        // Pagination Checksheet
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            checksheet(page)
        })

        function checksheet(page) {
            $.ajax({
                url: "/admin/checksheet/pagination/paginate-data?page=" + page,
                success: function(res) {
                    $('.whos-speaking').html(res);
                }
            })
        }

        // Search Checksheet
        $(document).on('keyup', '.search_checksheet', function(e) {
            e.preventDefault();
            let search_string = $('#search_checksheet').val();
            console.log(search_string);
            $.ajax({
                url: "{{ route('admin.search-checksheets') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('.whos-speaking').html(res);
                }
            })
        })

    })
</script>
