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
        $(document).on('click', '.create_checkform', function(e) {
            e.preventDefault();
            let checksheet_name = $('#checksheet_name').val();
            let checkform_name = $('#checkform_name').val();
            let form_type = $('#form_type').val();
            let checkform = $('#checkform_name').val() + "(" + $('#organize').val() + ")";
            let checkform_organize = checkform.replace(/\s+/g, '');

            // console.log(checklist_type);

            $.ajax({
                url: "{{ route('admin.create-checkform') }}",
                method: 'POST',
                data: {
                    checksheet_name: checksheet_name,
                    checkform_organize: checkform_organize,
                    checkform_name: checkform_name,
                    form_type: form_type,
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

                        Command: toastr["success"](
                            "Checkform has been created successfully",
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
                        Command: toastr["error"]("Error", res.error)

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

        function printErrorMsg_Checkform(msg) {
            $(".print-error-msg-checkform").find("ul").html('');
            $(".print-error-msg-checkform").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg-checkform").find("ul").append('<li>' + value + '</li>');
            });
        }

        // Show Formcheck value in update form
        $(document).on('click', '.update_checkform_form', function() {
            let up_form_type = $(this).data('form_type');
            let checkform_organize = $(this).data('checkform_organize')
            let up_checkform_name = $(this).data('checkform_name');
            let form_type_ini = $(this).data('form_type');

            $('#checkform_organize').val(checkform_organize);
            $('#up_form_type').val(up_form_type);
            $('#form_type_ini').val(form_type_ini);
            $('#up_checkform_name').val(up_checkform_name);

        });

        // Update Formcheck
        $(document).on('click', '.update_checkform', function(e) {
            e.preventDefault();
            if ($('#up_checkform_name').val() !== "") {
                var up_checkform = $('#up_checkform_name').val() + "(" + $('#organize').val() +
                    ")";
                var up_checkform_organize = up_checkform.replace(/\s+/g, '');
            } else {
                var up_checkform = $('#up_checkform_name').val();
                var up_checkform_organize = up_checkform.replace(/\s+/g, '');
            }
            let up_checkform_name = $('#up_checkform_name').val();

            let checkform_organize = $('#checkform_organize').val();

            var newType = $('#up_form_type').val();
            var originalType = $('#form_type_ini').val()
            var trigger = "not_change_type";

            if (newType !== originalType) {
                var check = confirm(
                    "If you change checkform's type the data into this checkform will be deleted.");
                if (check == true) {
                    var trigger = "change_type";
                    var up_form_type = newType;
                    $('#up_form_type').val(newType);



                } else {
                    var up_form_type = originalType;
                    $('#up_form_type').val(originalType);
                }
            }
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.update-checkform') }}",
                data: {
                    up_checkform_organize: up_checkform_organize,
                    up_checkform_name: up_checkform_name,
                    up_form_type: up_form_type,
                    checkform_organize: checkform_organize,
                    trigger: trigger,
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateFormcheckForm')[0].reset();
                        $('.whos-speaking').load(location.href +
                            ' .whos-speaking');
                        Command: toastr["success"](
                            "Checkform has been updated successfully",
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
                        Command: toastr["error"]("Error", res.error)

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
                        $('.errMsgContainer').append(
                            '<span class="text-danger">' +
                            value + '</span>' + '<br>');
                    });

                }

            })



        });

        // Show Formcheck value in Delete form
        $(document).on('click', '.delete_checkform_form', function() {
            let del_checkform_organize = $(this).data('checkform_organize');

            $('#del_checkform_organize').val(del_checkform_organize);

        });

        // Delete Formcheck
        $(document).on('click', '.delete_checkform', function(e) {
            e.preventDefault();
            let del_checkform_organize = $('#del_checkform_organize').val();

            console.log("del_checkform_organize: " + del_checkform_organize);

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.delete-checkform') }}",
                data: {
                    del_checkform_organize: del_checkform_organize
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#delModal').modal('hide');
                        $('.whos-speaking').load(location.href +
                            ' .whos-speaking');
                        $('.total-checklists span').load(location.href +
                            ' .total-checklists span');
                        Command: toastr["success"](
                            "Checkform has been deleted successfully",
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

        // Pagination Checkform
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            let checksheet_name = $('#checksheet_name').val();
            checkform(page, checksheet_name)
        })

        function checkform(page, checksheet_name) {
            $.ajax({
                url: "/admin/checkform/pagination/paginate-data?page=" + page,
                data: {
                    checksheet_name: checksheet_name
                },

                success: function(res) {
                    $('.whos-speaking').html(res);
                }
            })
        }

        // Search Checkforms
        $(document).on('keyup', '.search_checkforms', function(e) {
            e.preventDefault();
            let search_string = $('#search_checkforms').val();
            let checksheet_name = $('#checksheet_name').val();

            console.log(search_string);
            $.ajax({
                url: "{{ route('admin.search-checkforms') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                    checksheet_name: checksheet_name,
                },
                success: function(res) {
                    $('.whos-speaking').html(res);
                }
            })
        })


    })
</script>
