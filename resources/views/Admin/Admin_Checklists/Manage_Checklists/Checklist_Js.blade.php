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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    $(document).ready(function() {
        // Add Formcheck
        $(document).on('click', '.create_checklist', function(e) {
            e.preventDefault();
            let checklist_name = $('#checklist_name').val();
            let checkform_organize = $('#checkform_organize').val();
            let checklist = $('#checklist_name').val() + "(" + $('#organize').val() + ")";
            var checklist_organize = checklist.replace(/\s+/g, '');

            console.log("checkform_organize: " + checkform_organize);

            $.ajax({
                url: "{{ route('admin.create-checklist') }}",
                method: 'POST',
                data: {
                    checklist_name: checklist_name,
                    checkform_organize: checkform_organize,
                    checklist_organize: checklist_organize,
                },
                success: function(res) {
                    if (res['status'] == 'success') {
                        // reset value in add modal
                        $('#createModal').modal('hide');
                        $('#createCheckformForm')[0].reset();
                        // $('.modal-contain-add').load(location.href + ' .modal-contain-add');

                        // reset data in whos-speaking and total-checksheets section
                        $('.whos-speaking').load(location.href + ' .whos-speaking');
                        $('.modal-contain-add').load(location.href + ' .modal-contain-add');

                        // reset value in del checksheet form
                        $('.modal-contain-del').load(location.href + ' .modal-contain-del');

                        $('.total-checklists span').load(location.href +
                            ' .total-checklists span');
                        $(".print-error-msg").css('display', 'none');

                        Command: toastr["success"](
                            "Checklist has been created successfully",
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

        // Show Formcheck value in update form
        $(document).on('click', '.update_checklist_form', function() {
            let up_checklist_organize = $(this).data('checklist_organize');
            let up_checklist_name = $(this).data('checklist_name')
            let checklist_organize = $(this).data('checklist_organize');

            $('#up_checklist_organize').val(up_checklist_organize);
            $('#up_checklist_name').val(up_checklist_name);
            $('#checklist_organize').val(checklist_organize);

        });

        // Update Formcheck
        $(document).on('click', '.update_checklist', function(e) {
            e.preventDefault();
            let up_checklist_name = $('#up_checklist_name').val();
            let checklist_organize = $('#checklist_organize').val();

            if ($('#up_checklist_name').val() !== "") {
                var up_checklist = $('#up_checklist_name').val() + "(" + $('#organize').val() +
                    ")";
                var up_checklist_organize = up_checklist.replace(/\s+/g, '');
                console.log("1");
                console.log("up_checklist_organize: " + up_checklist_organize);
                console.log("checklist_organize: " + checklist_organize);
            } else {
                var up_checklist_organize = $('#up_checklist_name').val();
                console.log("0");
                console.log("up_checklist_organize: " + up_checklist_organize);
            }

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.update-checklist') }}",
                data: {
                    up_checklist_name: up_checklist_name,
                    up_checklist_organize: up_checklist_organize,
                    checklist_organize: checklist_organize
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateChecklistForm')[0].reset();
                        $('.whos-speaking').load(location.href +
                            ' .whos-speaking');

                        $(".print-error-msg").css('display', 'none');
                        Command: toastr["success"](
                            "Checklist has been updated successfully",
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
                // error: function(err) {
                //     let error = err.responseJSON;
                //     $.each(error.errors, function(index, value) {
                //         $('.errMsgContainer').append('<span class="text-danger">' +
                //             value + '</span>' + '<br>');
                //     });

                // }

            })


        });

        // Show Formcheck value in Delete form
        $(document).on('click', '.delete_checklist_form', function() {
            let del_checklist_organize = $(this).data('checklist_organize');

            $('#del_checklist_organize').val(del_checklist_organize);

        });

        // Delete Formcheck
        $(document).on('click', '.delete_checklist', function(e) {
            e.preventDefault();
            let del_checklist_organize = $('#del_checklist_organize').val();

            console.log("del_checklist_organize: " + del_checklist_organize);

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.delete-checklist') }}",
                data: {
                    del_checklist_organize: del_checklist_organize
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#deleteModal').modal('hide');
                        $('.whos-speaking').load(location.href +
                            ' .whos-speaking');

                        $('.total-checklists span').load(location.href +
                            ' .total-checklists span');
                        $(".print-error-msg").css('display', 'none');
                        Command: toastr["success"](
                            "Checklist has been deleted successfully",
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
                        console.log(res['message']);
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

        // Pagination Checklists
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            let checksheet_name = $('#checksheet_name').val();
            let checkform_organize = $('#checkform_organize').val();

            console.log("page: " + page);
            console.log("checksheet_name: " + checksheet_name);
            console.log("checkform_organize: " + checkform_organize);

            checklists(page, checksheet_name, checkform_organize)
        })

        function checklists(page, checksheet_name, checkform_organize) {
            $.ajax({
                url: "/admin/checklist/pagination/paginate-data?page=" + page,
                data: {
                    checksheet_name: checksheet_name,
                    checkform_organize: checkform_organize,
                },
                success: function(res) {
                    $('.whos-speaking').html(res);
                    console.log(res['message']);
                }
            })
        }

        // Search Checklists
        $(document).on('keyup', '.search_checklists', function(e) {
            e.preventDefault();
            let search_string = $('#search_checklists').val();
            let checksheet_name = $('#checksheet_name').val();
            let checkform_organize = $('#checkform_organize').val();
            console.log(search_string);
            $.ajax({
                url: "{{ route('admin.search-checklists') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                    checksheet_name: checksheet_name,
                    checkform_organize: checkform_organize,
                },
                success: function(res) {
                    $('.whos-speaking').html(res);
                }
            })
        })
    })
</script>
