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
        $(document).on('click', '.add_input', function(e) {
            e.preventDefault();
            var it = $('#it').val();

            var keep_input = [];
            var all_inputs = [];

            var keep_input_list_id = [];
            var all_input_list_ids = [];

            var key = $(this).data('key');
            var checkform_name = $(this).data('checkform_name');
            var checkform_organize = $(this).data('checkform_organize');
            var total_element = $("#modal-body-add-input-" + checkform_name + " .form-group").length;

            var date_check = $(this).data('date_check');

            $("#modal-body-add-input-" + checkform_name + " .user-input").each(function() {
                keep_input.push($(this).attr('id'));
            });
            $("#modal-body-add-input-" + checkform_name + " .user-input-id").each(function() {
                keep_input_list_id.push($(this).attr('id'));
            });

            for (var i = 0; i < total_element; i++) {
                if ($('#' + keep_input[i]).val() != "") {
                    all_inputs.push($('#' + keep_input[i]).val());
                    all_input_list_ids.push($('#' + keep_input_list_id[i]).val());
                } else {
                    Command: toastr["error"]("Error", "Please complete the form.")

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
                    return;
                }
            }

            // console.log("all_inputs: " + all_inputs);
            // console.log("all_ids: " + all_ids);
            join_input_list_ids = all_input_list_ids.join(",");
            join_inputs = all_inputs.join(",");

            console.log("join_input_list_ids: " + join_input_list_ids);
            console.log("join_inputs: " + join_inputs);
            console.log("IT: " + it);
            console.log("checkform_organize: " + checkform_organize);

            if (all_input_list_ids < 1) {
                console.log("Please fill atleast 1 input");
            } else {
                $.ajax({
                    method: "POST",
                    url: " {{ route('user.add-input') }} ",
                    data: {
                        it: it,
                        join_input_list_ids: join_input_list_ids,
                        join_inputs: join_inputs,
                        total_element: total_element,
                        checkform_organize: checkform_organize
                    },
                    success: function(res) {
                        if (res['status'] == 'success') {
                            console.log(res['message']);

                            $('#addFillInputModal-' + checkform_name).modal('hide');
                            $('#AddUser_InputForm_' + checkform_name)[0].reset();
                            $(".print-error-msg-input").css('display', 'none');
                            location.reload(true)

                            Command: toastr["success"](
                                "Your data have been added successfully",
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
                            // console.log(res.message);
                            printErrorMsg_input_user(res.message)
                        }
                    }
                })
            }
        })

        function printErrorMsg_input_user(msg) {
            $(".print-error-msg-input").find("span.error").html('');
            $(".print-error-msg-input").css('display', 'block');
            $(".print-error-msg-input").find("span.error").append('<li>' + msg + '</li>');
        }

        // Pagination Checksheet
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            let checksheet_name = $('#checksheet_name').val();
            checkform(page, checksheet_name)
        })

        function checkform(page, checksheet_name) {
            $.ajax({
                url: "/user/checkforms/pagination/paginate-data?page=" + page,
                data: {
                    checksheet_name: checksheet_name,
                },
                success: function(res) {
                    $('.whos-speaking').html(res);
                }
            })
        }

        // Search Checksheet
        $(document).on('keyup', '.search_checkforms', function(e) {
            e.preventDefault();
            let search_string = $('#search_checkforms').val();
            let checksheet_name = $('#checksheet_name').val();
            $.ajax({
                url: "{{ route('user.search-checkforms') }}",
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
