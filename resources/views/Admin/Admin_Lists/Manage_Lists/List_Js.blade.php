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
        //Add Checklist
        $(document).on('click', '.create_list', function(e) {
            e.preventDefault();
            let checklist_organize = $('#checklist_organize').val();
            let list_detail = $('#detail').val();

            console.log(checklist_organize);
            console.log(list_detail);

            $.ajax({
                url: "{{ route('admin.create-list') }}",
                method: 'post',
                data: {
                    checklist_organize: checklist_organize,
                    list_detail: list_detail,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        // reset value in add modal
                        $('#createModal').modal('hide');
                        $('#createListForm')[0].reset();

                        // reset checklist index page 
                        $('.whos-speaking').load(location.href + ' .whos-speaking');
                        $('.card-single-total h1').load(location.href +
                            ' .card-single-total h1');


                        // reset tabel
                        $('.card-body-checks').load(location.href + ' .card-body-checks');

                        Command: toastr["success"](
                            "List detail has been created successfully",
                            "Success")
                        console.log(res.message);

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
        $(document).on('click', '.update_list_form', function() {
            let up_detail = $(this).data('list_id');
            let old_up_list_detail = $(this).data('list_id');

            $('#up_detail').val(up_detail)
            $('#old_up_list_detail').val(old_up_list_detail)

        });

        // Update Formcheck
        $(document).on('click', '.update_list', function(e) {
            e.preventDefault();
            let up_detail = $('#up_detail').val();
            let old_up_list_detail = $('#old_up_list_detail').val();

            console.log("up_detail: " + up_detail);
            console.log("old_up_list_detail: " + old_up_list_detail);

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.update-list') }}",
                data: {
                    up_detail: up_detail,
                    old_up_list_detail: old_up_list_detail,
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateListForm')[0].reset();

                        // reset tabel
                        $('.card-body-checks').load(location.href + ' .card-body-checks');

                        Command: toastr["success"](
                            "List detail has been updated successfully",
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

        // Show Formcheck value in Delete form
        $(document).on('click', '.delete_list_form', function() {
            let del_list_id = $(this).data('list_id');

            $('#del_list_id').val(del_list_id);

        });

        // Delete Formcheck
        $(document).on('click', '.delete_list', function(e) {
            e.preventDefault();
            let del_list_id = $('#del_list_id').val();

            console.log("del_list_id: " + del_list_id);

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.delete-list') }}",
                data: {
                    del_list_id: del_list_id
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#deleteModal').modal('hide');

                        // reset tabel
                        $('.card-body-checks').load(location.href + ' .card-body-checks');
                        $('.card-single-total h1').load(location.href +
                            ' .card-single-total h1');

                        Command: toastr["success"](
                            "List detail has been deleted successfully",
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

        // Selected All Value
        $(document).on('click', '.main_checkbox_check', function() {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
            // console.log("I'm In!!");
            toggledelete_all_selected();
        });

        // Change to select all value
        $(document).on('change', '.sub_chk', function() {
            if ($('.sub_chk').length == $('.sub_chk:checked').length) {
                $('#main_checkbox_check').prop('checked', true);
            } else {
                $('#main_checkbox_check').prop('checked', false);
            }
            toggledelete_all_selected();
        })

        // Toggle when select
        function toggledelete_all_selected() {
            if ($('.sub_chk:checked').length > 0) {
                $('button#deleteSelectedBtn').text('Delete (' + $('.sub_chk:checked').length + ')').removeClass(
                    'd-none');

            } else {
                $('button#deleteSelectedBtn').addClass('d-none');
            }
        }

        // Delete Selected Value
        $('.delete_selected_lists').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                // alert("Deleted all");
                var check = $('#deleteSelectedModal').modal('show');
                $('.confirm').on('click', function() {
                    let confirm = $(this).data('confirm');
                    console.log(confirm);

                    if (confirm == true) {
                        var join_selected_values = allVals.join(",");
                        // alert(join_selected_values);
                        $.ajax({
                            url: "{{ route('admin.delete-selected-list') }}",
                            type: 'delete',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $('.card-body-checks').load(location
                                            .href + ' .card-body-checks'
                                        );

                                    });

                                    $('#deleteSelectedModal').modal('hide');
                                    $('.card-single-total h1').load(location.href +
                                        ' .card-single-total h1');

                                    Command: toastr["success"](
                                        "Check has been deleted successfully.",
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
                                } else if (data['error']) {
                                    alert(data['error'])
                                } else {
                                    alert("Something Wrong")
                                }

                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });

                    } else {
                        console.log("Rai Waaa");
                    }
                })
            }
        });

        // Pagination Lists
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            let checkform_organize = $('#checkform_organize').val();
            let checksheet_name = $('#checksheet_name').val();

            console.log("page: " + page);
            console.log("checkform_organize: " + checkform_organize);
            console.log("checksheet_name: " + checksheet_name);

            checklists(page, checkform_organize, checksheet_name)
        })

        function checklists(page, checkform_organize, checksheet_name) {
            $.ajax({
                url: "/admin/checklist-list/pagination/paginate-data?page=" + page,
                data: {
                    checkform_organize: checkform_organize,
                    checksheet_name: checksheet_name,
                },
                success: function(res) {
                    $('.card-body-checklists').html(res);
                }
            })
        }

        // Search Lists
        $(document).on('keyup', '.search_checklist_list', function(e) {
            e.preventDefault();
            let search_string = $('#search_checklist_list').val();
            let checkform_organize = $('#checkform_organize').val();
            let checksheet_name = $('#checksheet_name').val();

            console.log("checkform_organize: " + checkform_organize);
            console.log("checksheet_name: " + checksheet_name);
            $.ajax({
                url: "{{ route('admin.search-checklist-lists') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                    checkform_organize: checkform_organize,
                    checksheet_name: checksheet_name,
                },
                success: function(res) {
                    if (res.status = "error")
                        $('.card-body-checklists').html(res);
                    else
                        console.log(res.message);
                }
            })
        })
    })
</script>
