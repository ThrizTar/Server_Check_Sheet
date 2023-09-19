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
        // Show button submit when checking all of check complete. 
        $(document).on('click', '.sub_chk', function() {
            // console.log("EIei");
            toggle_submit_data();
        })

        function toggle_submit_data() {
            let list_count = $('#list_count').val();
            let checklist_name = $('#checklist_name').val();
            console.log(list_count);

            if ($('.sub_chk:checked').length == list_count) {
                $('button#submit_data').text('Submit (' + $('.sub_chk:checked').length + ') Checks')
                    .removeClass(
                        'd-none');

            } else {
                $('button#submit_data').addClass('d-none');
            }

        }

        var stopExecution = false;

        // Submit all value 
        $(document).on('click', '.submit_form', function(e) {
            e.preventDefault();
            var allVals = [];
            var checklist_names = [];
            var list_ids = [];
            var details = [];
            var comments = [];
            var list_count = $('#list_count').val();
            var it = $('#it').val();
            var date_check = $(this).data('date')
            var checklist_organize = $('#checklist_organize').val()
            // console.log("date: " + date);

            for (var i = 1; i <= list_count; i++) {
                checklist_names.push($('#checklist_id-' + i).val());
                list_ids.push($('#check_id-' + i).val());
                details.push($('#details-' + i).val());
                // console.log("i: " + i + " comeent: " + $('#comment-' + i).val());
                comments.push($('#comment-' + i).val());
            }
            $(".sub_chk:checked").each(function() {

                allVals.push($(this).attr('value'));
            });

            allVals.forEach((i, index) => {
                console.log("comment in i = " + i + " is " + $('#comment-' + Number(index + 1))
                    .val());
                if (i == "0") {
                    if ($('#comment-' + Number(index + 1)).val() == "") {
                        Command: toastr["error"]("Error", "Please tell the problem in the comment box.")

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
                        stopExecution = true; // Set the flag to true to stop execution
                        return false; // Exit the forEach loop
                    } else {
                        stopExecution = false;
                    }
                }
            });

            if (stopExecution) {
                return; // Stop further execution of the click event handler
            }

            var join_list_ids = list_ids.join("|");
            var join_details = details.join("|");
            var join_comments = comments.join("|");
            var join_selected_values = allVals.join("|");

            console.log("join_list_ids: " + join_list_ids);
            console.log("join_comments: " + join_comments);
            console.log("join_selected_values: " + join_selected_values);
            console.log("it: " + it);

            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                var join_selected_values = allVals.join("|");
                // alert(join_selected_values);
                $.ajax({
                    method: 'POST',
                    url: "{{ route('user.add-status') }}",
                    data: {
                        status: join_selected_values,
                        list_ids: join_list_ids,
                        comments: join_comments,
                        it: it,
                        list_count: list_count,
                        date_check: date_check,
                        checklist_organize: checklist_organize,
                    },
                    success: function(data) {
                        if (data['status'] == "success") {
                            console.log('Success');
                            // $(".sub_chk:checked").each(function() {
                            $('.table-responsive').load(location.href +
                                ' .table-responsive');
                            // console.log(data.message);
                            // });
                            Command: toastr["success"](
                                "Your Data have been added successfully.",
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
                            Command: toastr["error"]("Error", data['message'])

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
                    error: function(data) {
                        console.log(data['message']);
                        // alert(data.responseText);
                    }
                });
            }
        })

        // Pagination Lists
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            let checkform_organize = $('#checkform_organize').val();
            let checksheet_name = $('#checksheet_name').val();
            let checklist_organize = $('#checklist_organize').val();


            console.log("checkform_organize: " + checkform_organize);
            console.log("checksheet_name: " + checksheet_name);

            checklists(page, checkform_organize, checksheet_name, checklist_organize)
        })

        function checklists(page, checkform_organize, checksheet_name, checklist_organize) {
            $.ajax({
                url: "/user/checklist-list/pagination/paginate-data?page=" + page,
                data: {
                    checkform_organize: checkform_organize,
                    checksheet_name: checksheet_name,
                    checklist_organize: checklist_organize
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
            let checklist_organize = $('#checklist_organize').val();

            // console.log(search_string);
            console.log("checkform_organize: " + checkform_organize);

            if (search_string === "") {
                search_string = null; // or set it to an empty string if needed
            }

            $.ajax({
                url: "{{ route('user.search-checklist-lists') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                    checkform_organize: checkform_organize,
                    checksheet_name: checksheet_name,
                    checklist_organize: checklist_organize,
                },
                success: function(res) {
                    if (res.status == "error") {
                        console.log(res.message);
                    } else {
                        $('.card-body-checklists').html(res);
                        console.log(res.message);
                    }
                }
            })
        })

        $(document).on('click', '.w-comment', function(e) {
            let key = $(this).data('key');
            let status = $(this).data('status')
            console.log(key);
            if (status == '0') {
                $("#comment-" + key).removeClass("d-none");
            } else {
                $("#comment-" + key).addClass("d-none");
            }
        })
    })
</script>
