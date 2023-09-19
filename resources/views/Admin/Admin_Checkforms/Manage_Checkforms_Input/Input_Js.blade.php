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

        // Create option input
        $(document).on('change', '.sub_chk', function(e) {
            e.preventDefault();
            var type_id = $(this).data('id')
            var split_id = type_id.split('-');
            var curr_id = split_id[2]
            var checkform_name = $(this).data('checkform_name');
            console.log("type_id: " + type_id + " curr_id: " + curr_id + " checkform_name: " +
                checkform_name);

            if ($('#type-0-' + curr_id + '-' + checkform_name).prop('checked')) {

                console.log("I'm in if!!");
                $("#option_field_" + curr_id + '_' + checkform_name).append(
                    '<div class="option_input" id="option_' + curr_id +
                    '_' + checkform_name + '"></div>')
                $("#option_" + curr_id + '_' + checkform_name).append(
                    '<div class="add_remove_option_button" id="button_' + curr_id +
                    '"><a class="btn btn-primary add_option text-light mr-1 mt-1" data-checkform_name="' +
                    checkform_name +
                    '" id="add" ><span class="fa fa-plus"> Add Option</span></a><a class="btn btn-danger remove_option text-light mt-1" id="remove" data-checkform_name="' +
                    checkform_name + '" data-key ="' +
                    curr_id +
                    '"><span class="fa fa-minus"> Remove Option</span></a></div> <div class="sub_option_field" id="sub_option_field_' +
                    curr_id + '_0_' + checkform_name +
                    '"> </div> <div class="sub_option_field" id="sub_option_field_' +
                    curr_id + '_1_' + checkform_name + '"> </div>');
                $("#sub_option_field_" + curr_id + '_0_' + checkform_name).append(
                    '<input type="text" name="option_' +
                    curr_id +
                    '_sub_options_0_' + checkform_name +
                    '" class="form-control form-control-input-option" id="option_' +
                    curr_id +
                    '_sub_options_0_' + checkform_name + '" placeholder="Option..">')
                $("#sub_option_field_" + curr_id + '_1_' + checkform_name).append(
                    '<input type="text" name="option_' +
                    curr_id +
                    '_sub_options_1_' + checkform_name +
                    '" class="form-control form-control-input-option" id="option_' +
                    curr_id +
                    '_sub_options_1_' + checkform_name + '" placeholder="Option..">')
            } else {
                console.log("I'm in else!!");
                $('#option_' + curr_id + '_' + checkform_name).remove();
            }
        })

        // Create new input field
        $(document).on('click', '.add_input', function(e) {
            e.preventDefault();
            var checkform_key = $(this).data('key');
            var checkform_name = $(this).data('checkform_name');
            // Finding total number of elements added
            var total_element = $("#modal_body_" + checkform_key + "_" + checkform_name +
                " .form-group").length;

            // last <div> with element class id
            var lastid = $("#modal_body_" + checkform_key + "_" + checkform_name + " .form-group:last")
                .attr("id");
            var split_id = lastid.split("_");
            var nextindex = Number(split_id[1]) + 1;
            var max = 10;
            console.log("lastid:" + lastid);

            // Check total number elements
            if (total_element < max) {
                // Adding new div container after last occurance of element class
                $("#modal_body_" + checkform_key + "_" + checkform_name + " .form-group:last").after(
                    '<div class="form-group mt-2" id="input_' +
                    nextindex + '_' + checkform_name +
                    '"> <div class="inline-input-option" id="input_css_' + nextindex +
                    '_' + checkform_name + '" ></div> <div class="option_field" id="option_field_' +
                    nextindex +
                    '_' + checkform_name + '" > </div> </div> ');

                // Adding element to <div>
                $("#input_css_" + nextindex + '_' + checkform_name).append(
                    '<input type="text" class="form-control" name="input_value_' +
                    nextindex + '_' + checkform_name + '" id="input_value_' + nextindex +
                    '_' + checkform_name +
                    '" placeholder="Input"> <div class="wrapper"><input type="radio" name="Radio-' +
                    nextindex + '_' + checkform_name + '" id="type-1-' +
                    nextindex + '-' + checkform_name + '"data-id="type-1-' + nextindex +
                    '-' + checkform_name + '" data-checkform_name="' + checkform_name +
                    '" value="text" class="sub_chk" checked> <input type="radio" name="Radio-' +
                    nextindex + '_' + checkform_name + '" id="type-0-' +
                    nextindex + '-' + checkform_name + '" data-id="type-0-' +
                    nextindex + '-' + checkform_name + '" data-checkform_name="' + checkform_name +
                    '" value="select" class="sub_chk"> <label for="type-1-' +
                    nextindex +
                    '-' + checkform_name +
                    '" class="option option-1 "> <div class="dot"></div> <span>Text</span> </label> <label for="type-0-' +
                    nextindex +
                    '-' + checkform_name +
                    '" class="option option-0"> <div class="dot"></div> <span>Select</span> </label> </div> <input type="hidden" name="fill_list_id_' +
                    nextindex + '_' + checkform_name + '" id="fill_list_id_' + nextindex + '_' +
                    checkform_name + '" value="' +
                    checkform_name + '-FID_' + nextindex + '_' + checkform_name + '"> '
                );

            } else {
                Command: toastr["error"]("Error", "Over input title limit.")

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
        })

        // Add new option
        $(document).on('click', '.add_option', function(e) {
            e.preventDefault()
            var curr_id_option = $(".modal-body .option_input:hover").attr("id");
            var split_curr_id_option = curr_id_option.split('_'); // เพิ่ม checkform_name add option
            var curr_index_option = split_curr_id_option[1];
            var checkform_name = $(this).data('checkform_name');
            // console.log(curr_id_option);

            var last_id_option = $(".modal-body #option_" + curr_index_option + "_" + checkform_name +
                " .sub_option_field:last").attr("id");
            var split_last_id_option = last_id_option.split('_');
            var curr_index_input = split_last_id_option[3];
            var curr_index_option = split_last_id_option[4];
            var next_index_option = Number(split_last_id_option[4]) + 1;
            var total_element = $("#option_" + curr_index_input + "_" + checkform_name +
                " .sub_option_field").length;

            var max = 10;

            if (total_element < max) {

                $("#option_" + curr_index_input + "_" + checkform_name).append(
                    '<div class="sub_option_field" id="sub_option_field_' + curr_index_input +
                    '_' + next_index_option + '_' + checkform_name + '"> </div>');
                $("#sub_option_field_" + curr_index_input + "_" + next_index_option + "_" +
                        checkform_name)
                    .append(
                        '<input type="text" name="option_' +
                        curr_index_input +
                        '_sub_options_' + next_index_option +
                        '_' + checkform_name +
                        ' " class="form-control form-control-input-option" id="option_' +
                        curr_index_input +
                        '_sub_options_' + next_index_option + '_' + checkform_name +
                        '" placeholder="Option..">')
            } else {
                Command: toastr["error"]("Error", "Over options limit.")

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

        })

        // Remove option
        $(document).on('click', '.remove_option', function(e) {
            e.preventDefault();
            var key = $(this).data('key');
            var checkform_name = $(this).data('checkform_name');
            // console.log(key);

            var total_element_options = $(".modal-body .option_input:hover .sub_option_field").length;
            console.log("total_element_options: " + total_element_options);
            // console.log("key: " + key + " checkform_name: " + checkform_name);

            var curr_id_option = $(".modal-body .option_input:hover").attr("id");
            var split_curr_id_option = curr_id_option.split('_');
            var curr_index_option = split_curr_id_option[1];
            // console.log(curr_id_option);

            var last_id_input = $(".modal-body #option_" + curr_index_option + "_" + checkform_name +
                " .sub_option_field:last").attr("id");
            var split_id = last_id_input.split("_");
            var deleteindex = split_id[4];
            console.log("last_id_input: " + last_id_input);

            // Remove <div> with id
            if (total_element_options > 2) {
                $("#sub_option_field_" + curr_index_option + "_" + deleteindex + '_' + checkform_name)
                    .remove();
                // $("#option_id_" + curr_index_option + "_" + deleteindex).remove();

            } else {
                Command: toastr["error"]("Error", "Options must have atleast 2 choices.")

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

        })

        // Remove input
        $(document).on('click', '.remove_input', function(e) {
            e.preventDefault();
            var key = $(this).data('key');
            var checkform_name = $(this).data('checkform_name')
            var total_element = $("#modal_body_" + key + "_" + checkform_name +
                ".modal-body .form-group").length;
            var lastid = $("#modal_body_" + key + "_" + checkform_name + ".modal-body .form-group:last")
                .attr("id");
            var split_id = lastid.split("_");
            var deleteindex = split_id[1];
            console.log(lastid);

            // Remove <div> with id
            if (total_element > 1) {
                $("#input_" + deleteindex + "_" + checkform_name).remove();
                console.log("Here");

            } else {
                Command: toastr["error"]("Error", "Please remain atleast 1 input title.")

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

        });

        // Checkform_name for add input
        $(document).on('click', '.pass_name', function() {
            var checkform_name = $(this).data('checkform_name')

            $('#checkform_name').val(checkform_name);
        })

        // Add Input to Database
        $(document).on('click', '.add_input_checkform', function(e) {
            e.preventDefault();
            var key = $(this).data('key');
            var key_count = $(this).data('key');
            var checkform_name = $(this).data('checkform_name');
            var checkform_organize = $(this).data('checkform_organize');
            var checkform_name_og = $('#checkform_name').val();
            var all_input_ids = [];
            var all_inputs = [];
            var all_types = [];
            var all_options = [];
            var all_form_fill_input = [];
            var all_input_option = [];
            var total_element = $("#modal_body_" + key + "_" + checkform_name + " .form-group").length;

            console.log("total_element: " + total_element);

            for (var i = 0; i < total_element; i++) {
                if ($('#input_value_' + key_count + '_' + checkform_name).val() !== "") {

                    all_input_ids.push($('#input_value_' + key_count + '_' + checkform_name).val() +
                        "(" +
                        checkform_name_og + ")");

                    all_inputs.push($('#input_value_' + key_count + '_' + checkform_name).val());

                    for (var j = 0; j < $('#option_' + key_count + '_' + checkform_name +
                            ' .sub_option_field').length; j++) {
                        if ($('#option_' + key_count + '_' + checkform_name + ' .sub_option_field')
                            .length >
                            1 && $('#option_' + key_count + '_sub_options_' + j + '_' +
                                checkform_name).val() !== "") {

                            all_form_fill_input.push($('#input_value_' + key_count + '_' +
                                    checkform_name)
                                .val() + "(" +
                                checkform_name_og + ")");

                            all_options.push($('#option_' + key_count + '_sub_options_' + j + '_' +
                                checkform_name).val());

                            all_input_option.push(($('#option_' + key_count + '_sub_options_' + j +
                                    '_' +
                                    checkform_name).val()) + "(" + $('#input_value_' + key_count +
                                    '_' + checkform_name).val() +
                                "(" +
                                checkform_name_og + ")" + ")");

                        } else {
                            Command: toastr["error"]("Error",
                                "Please fill the options field completely.")

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
                } else {
                    Command: toastr["error"]("Error", "Please fill the input field completely.")

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
                key_count++;
            }

            $("#modal_body_" + key + "_" + checkform_name + " .sub_chk:checked").each(function() {
                all_types.push($(this).attr('value'));
            });

            njoin_input_ids = all_input_ids.join(",");
            join_inputs = all_inputs.join(",");
            join_types = all_types.join(",");
            njoin_form_fill_inputs = all_form_fill_input.join(",");
            join_options = all_options.join(",");
            njoin_input_options = all_input_option.join(',');

            var join_input_ids = njoin_input_ids.replace(/\s+/g, '');
            var join_input_options = njoin_input_options.replace(/\s+/g, '');
            var join_form_fill_inputs = njoin_form_fill_inputs.replace(/\s+/g, '');

            console.log("join_input_ids: " + join_input_ids);
            console.log("join_inputs: " + join_inputs);
            console.log("join_form_fill_inputs: " + join_form_fill_inputs);
            console.log("join_input_options: " + join_input_options);
            console.log("join_options: " + join_options);
            console.log("join_input_options: " + join_input_options);

            $.ajax({
                method: "POST",
                url: " {{ route('admin.add-input-checkform') }} ",
                data: {
                    checkform_organize: checkform_organize,
                    join_input_ids: join_input_ids,
                    join_inputs: join_inputs,
                    join_types: join_types,
                    join_options: join_options,
                    join_form_fill_inputs: join_form_fill_inputs,
                    join_input_options: join_input_options,
                },
                success: function(res) {
                    if (res['status'] == 'success') {
                        console.log(res['message']);

                        $('#addInputModal-' + key).modal('hide');
                        $('#addInputFormcheckForm')[0].reset();
                        location.reload(true);

                        Command: toastr["success"](
                            "Your input title have been created successfully",
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
                        Command: toastr["error"]("Error", res.errors)

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

        function printErrorMsg_input(msg) {
            $(".print-error-msg-input").find("span.error").html('');
            $(".print-error-msg-input").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg-input").find("span.error").append('<li>' + value + '</li>');
            });
        }


        // Update Input Checkform
        $(document).on('click', '.update_input_option', function(e) {
            e.preventDefault();
            var key = $(this).data('key')
            var checkform_name = $(this).data('checkform_name');
            var delspace_checkform_name = checkform_name.replace(/\s+/g, '-');

            var allup_input_ids = [];

            var new_allup_input_ids = [];
            var allup_inputs = [];
            var allup_types = [];

            var allup_options = [];

            var all_option_ids = [];
            var allup_option_ids = [];

            var allup_input_options = [];

            var last_element = $("#modal_body_update_" + key + ".modal-body .form-group:last").attr(
                'id');
            var split_last_element = last_element.split('_');
            var last_element_index = split_last_element[1];

            var total_element_input = $("#modal_body_update_" + key + ".modal-body .form-group").length;
            console.log("total_element_input: " + total_element_input);

            for (var i = 0; i < total_element_input; i++) {
                if ($('#up_input_value_' + i + '_' + delspace_checkform_name).val() !== "") {

                    allup_input_ids.push($('#up_fill_list_id_' + i + '_' + delspace_checkform_name)
                        .val());

                    new_allup_input_ids.push($('#up_input_value_' + i + '_' +
                        delspace_checkform_name).val() + "(" + checkform_name + ")");

                    allup_inputs.push($('#up_input_value_' + i + '_' + delspace_checkform_name).val());
                } else {
                    Command: toastr["error"]("Error", "Please fill the input field completely.")

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
                if ($('#up_option_' + i + '_' + delspace_checkform_name + ' .sub_option_field').length >
                    1) {
                    for (var j = 0; j < $('#up_option_' + i + "_" + delspace_checkform_name +
                            ' .sub_option_field').length; j++) {
                        if ($('#up_option_' + i + "_" + j + '_' +
                                delspace_checkform_name + '_sub_options').val() !== "") {

                            all_option_ids.push($('#up_option_id_' + i + "_" + j + '_' +
                                delspace_checkform_name).val())

                            allup_options.push($('#up_option_' + i + "_" + j + '_' +
                                delspace_checkform_name + '_sub_options').val())

                            allup_input_options.push($('#up_input_value_' + i + "_" +
                                delspace_checkform_name).val() + "(" + checkform_name + ")");

                            allup_option_ids.push($('#up_option_' + i + "_" + j + '_' +
                                    delspace_checkform_name + '_sub_options').val() + "(" + $(
                                    '#up_input_value_' + i + "_" +
                                    delspace_checkform_name).val() + "(" + checkform_name + ")" +
                                ")")

                        } else {
                            Command: toastr["error"]("Error",
                                "Please fill the options field completely.")

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
                }
            }

            $("#modal_body_update_" + key + " .up_sub_chk:checked").each(function() {
                allup_types.push($(this).attr('value'));
            });


            join_input_ids = allup_input_ids.join(",");
            njoin_new_input_ids = new_allup_input_ids.join(",");
            join_inputs = allup_inputs.join(",");
            join_types = allup_types.join(",");
            join_option_ids = all_option_ids.join(",");
            join_allup_option_ids = allup_option_ids.join(",");
            join_options = allup_options.join(",");
            join_allup_input_options = allup_input_options.join(",");

            var p_allup_option_ids = join_allup_option_ids.replace(/\s+/g, '');
            var join_new_input_ids = njoin_new_input_ids.replace(/\s+/g, '');

            console.log("join_input_ids: " + join_input_ids);
            console.log("join_new_input_ids: " + join_new_input_ids);
            console.log("join_inputs: " + join_inputs);
            console.log("join_option_ids: " + join_option_ids);
            console.log("join_allup_option_ids: " + join_allup_option_ids);
            console.log("join_options: " + join_options);
            console.log("join_allup_input_options: " + join_allup_input_options);
            console.log("p_allup_option_ids: " + p_allup_option_ids);

            if (allup_inputs < 1) {
                console.log("Please fill atleast 1 input");
            } else {
                $.ajax({
                    method: "POST",
                    url: " {{ route('admin.update-input-checkform') }} ",
                    data: {
                        checkform_name: checkform_name,
                        join_input_ids: join_input_ids,
                        join_inputs: join_inputs,
                        join_types: join_types,
                        join_options: join_options,
                        join_option_ids: join_option_ids,
                        join_input_options: join_allup_input_options,
                        join_new_input_ids: join_new_input_ids,
                        p_allup_option_ids: p_allup_option_ids,
                    },
                    success: function(res) {
                        if (res['status'] == 'success') {
                            console.log(res['message']);

                            $('#updateInputModal-' + delspace_checkform_name).modal('hide');
                            $('#UpdateInputCheckformForm-' + delspace_checkform_name)[0]
                                .reset();
                            location.reload(true);

                            Command: toastr["success"](
                                "Your data have been updated successfully",
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
                                res.errors)

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
            }
        })


        // Remove Option
        $(document).on('click', '.up_del_option', function(e) {
            e.preventDefault();
            let del_option_id = $(this).data('fill_id')
            let checkform_name = $(this).data('checkform_name')
            let key_input = $(this).data('key_input');
            let key = $(this).data('key');
            let i = $(this).data('i');

            // let split_del_option_id = del_option_id.split('_');
            // let mid_del_index = split_del_option_id[1]
            // let del_index = split_del_option_id[2]
            console.log("key_input: " + key_input + " i: " + i + " checkform_name: " + checkform_name);
            // console.log($('.sub_option_field:hover'));

            var check = confirm("Are you sure to delete??")
            if (check == true) {
                $.ajax({
                    method: "get",
                    url: "{{ route('admin.delete-option-checkform') }}",
                    data: {
                        del_option_id: del_option_id,
                    },

                    success: function(res) {
                        if (res['status'] == 'success') {
                            $('.sub_option_field#up_sub_option_' + key_input + '_' + i +
                                '_' + checkform_name).remove();
                            // console.log($('.sub_option_field:hover'));
                        }
                    }
                })
            }

        })

        // Remove Option
        $(document).on('click', '.up_del_input', function(e) {
            e.preventDefault();
            let del_input_id = $(this).data('form_fill_input')
            let key_input = $(this).data('key_input');
            let key = $(this).data('key');
            var checkform_name = $(this).data('checkform_name');
            var delspace_checkform_name = checkform_name.replace(/\s+/g, '-');

            // console.log(del_input_id);
            // console.log("key_input: " + key_input);


            var check = confirm("Are you sure to delete??")
            if (check == true) {
                $.ajax({
                    method: "get",
                    url: "{{ route('admin.delete-input-checkform') }}",
                    data: {
                        del_input_id: del_input_id,
                    },

                    success: function(res) {
                        if (res['status'] == 'success') {
                            $('#modal_body_update_' + key + ' .input-field#input_' +
                                key_input).remove();
                            // location.reload(true)
                        }
                    }
                })
            }

        })

        // Create option input
        $(document).on('change', '.up_sub_chk', function(e) {
            e.preventDefault();
            // console.log("up up up!!!");
            var checkform_name = $(this).data('checkform_name');

            var type_id = $(this).data('id')
            console.log(type_id);
            var split_id = type_id.split('-');
            // var curr_middle_id = split_id[1]
            var curr_id = split_id[2]
            var key = $(this).data('key');
            var allup_option_ids = [];
            var keep_allup_option_ids = [];

            console.log("checkform_name: " + checkform_name + " type_id: " + type_id + " curr_id: " +
                curr_id);

            if ($('#up_type-0-' + curr_id + '-' + checkform_name).prop('checked')) {

                console.log("I'm in if!!");
                $("#up_option_field_" + curr_id + '_' + checkform_name).append(
                    '<div class="option_input" id="up_option_' +
                    curr_id + '_' + checkform_name + '"></div>');
                $("#up_option_" + curr_id + '_' + checkform_name).append(
                    '<div class="add_remove_option_button" id="up_button_' + curr_id +
                    '"><a class="btn btn-primary up_add_option text-light my-1 ml-4" data-checkform_name = "' +
                    checkform_name + '" data-key="' +
                    key +
                    '"><span class="fa fa-plus"> Add Option</span></a></div> <div class="sub_option_field" id="up_sub_option_' +
                    curr_id + '_0_' + checkform_name +
                    '"> </div><div class="sub_option_field" id="up_sub_option_' +
                    curr_id + '_1_' + checkform_name + '"> </div>');
                $("#up_sub_option_" + curr_id + '_0_' + checkform_name).append(
                    '<span class="up_del_new_option fa fa-square-xmark" data-checkform_name="' +
                    checkform_name + '" data-key="' + key +
                    '"></span> <input type="text" name="up_option_' + curr_id + '_0_' +
                    checkform_name +
                    '_sub_options" class="form-control form-control-input-option sub-option" id="up_option_' +
                    curr_id + '_0_' +
                    checkform_name +
                    '_sub_options" placeholder="Option..">')
                $("#up_sub_option_" + curr_id + '_1_' + checkform_name).append(
                    '<span class="up_del_new_option fa fa-square-xmark" data-checkform_name="' +
                    checkform_name + '" data-key="' + key +
                    '"></span> <input type="text" name="up_option_' + curr_id + '_1_' +
                    checkform_name +
                    '_sub_options" class="form-control form-control-input-option sub-option" id="up_option_' +
                    curr_id + '_1_' +
                    checkform_name +
                    '_sub_options" placeholder="Option..">')
            } else {
                console.log("I'm in else!!");
                if ($("#modal_body_update_" + key + " #up_option_" + curr_id + '_' + checkform_name +
                        " .sub-option-id")
                    .length > 1) {
                    var check = confirm(
                        "Are you sure to change?? If you change your all sub check will be deleted completely!"
                    );
                    if (check) {
                        $("#modal_body_update_" + key + " #up_option_" + curr_id + '_' +
                                checkform_name + " .sub-option-id")
                            .each(function() {
                                keep_allup_option_ids.push($(this).attr('id'));
                            });

                        for (var j = 0; j < $("#modal_body_update_" + key + " #up_option_" + curr_id +
                                '_' + checkform_name +
                                " .sub-option-id").length; j++) {
                            allup_option_ids.push($('#' + keep_allup_option_ids[j]).val());
                        }

                        join_option_ids = allup_option_ids.join(",");

                        console.log('allup_option_ids: ', allup_option_ids);

                        $.ajax({
                            method: 'GET',
                            url: "{{ route('admin.delete-change-type') }}",
                            data: {
                                join_option_ids: join_option_ids,
                            },
                            success: function(res) {
                                if (res['status'] == 'success') {
                                    $('#up_option_' + curr_id + '_' + checkform_name)
                                        .remove();
                                    $('#up_type-1-' + curr_id + '-' + checkform_name).prop(
                                        'checked', true)
                                }
                            }
                        })
                    } else {
                        $('#up_type-0-' + curr_id + '-' + checkform_name).prop('checked', true)
                    }
                } else {
                    $('#up_option_' + curr_id + '_' + checkform_name).remove();
                    $('#up_type-1-' + curr_id + '-' + checkform_name).prop('checked', true)
                }

            }
        })

        // Add new option in update form
        $(document).on('click', '.up_add_option', function(e) {
            e.preventDefault();
            var checkform_name = $(this).data('checkform_name');
            var key = $(this).data('key');
            var curr_id_option = $("#modal_body_update_" + key + " .option_input:hover").attr("id");
            var split_curr_id_option = curr_id_option.split('_');
            var curr_index_option = split_curr_id_option[2];

            var last_id_option = $("#modal_body_update_" + key + " #up_option_" + curr_index_option +
                "_" +
                checkform_name +
                " .sub_option_field:last").attr("id");
            // console.log("curr_index_option: " + curr_index_option);
            // console.log("last_id_option: " + last_id_option);
            var split_last_id_option = last_id_option.split('_');
            var curr_index_input = split_last_id_option[3];
            var curr_index_option = split_last_id_option[4];
            var next_index_option = Number(split_last_id_option[4]) + 1;

            console.log("curr_index_input: " + curr_index_input);

            $("#up_option_" + curr_index_input + '_' + checkform_name).append(
                '<div class="sub_option_field" id="up_sub_option_' + curr_index_input +
                '_' + next_index_option + '"> </div>');
            $("#up_sub_option_" + curr_index_input + "_" + next_index_option).append(
                '<span class="up_del_new_option fa fa-square-xmark" data-checkform_name="' +
                checkform_name + '" data-key="' + key +
                '"></span> <input type="text" name="up_option_' + curr_index_input + '_' +
                next_index_option + '_' + checkform_name +
                '_sub_options" class="form-control form-control-input-option sub-option" id="up_option_' +
                curr_index_input + '_' + next_index_option + '_' + checkform_name +
                '_sub_options" placeholder="Option..">')

            // console.log("curr_index_input: " + curr_index_input);
            // console.log("curr_index_option: " + curr_index_option);

        })

        // Remove Option
        $(document).on('click', '.up_del_new_option', function(e) {
            e.preventDefault();
            var key = $(this).data('key')
            var checkform_name = $(this).data('checkform_name');
            var total_element_options = $("#modal_body_update_" + key +
                " .option_input:hover input.form-control-input-option").length;



            var curr_id_option = $("#modal_body_update_" + key + " .option_input:hover").attr("id");
            var split_curr_id_option = curr_id_option.split('_');
            var curr_index_option = split_curr_id_option[2];
            // // var up_formcheck_id = $(this).data('formcheck_id');

            var last_id_input = $("#modal_body_update_" + key + " #up_option_" + curr_index_option +
                "_" + checkform_name + " input.form-control-input-option:last").attr("id");
            // console.log("checkform_name: " + checkform_name);
            var split_id = last_id_input.split("_");
            var deleteindex = split_id[3];
            // console.log(last_id_input);

            // Remove <div> with id
            if (total_element_options > 1) {
                $('#up_sub_option_' + curr_index_option + '_' + deleteindex).remove();
                // $("#up_option_" + curr_index_option + "_sub_options_" + deleteindex).remove();
                // $("#up_option_id_" + curr_index_option + "_" + deleteindex).remove();

            } else {
                console.log("Please remain 1 input");
            }
            // console.log("last_id_input: " + last_id_input);

        })
    })
</script>
