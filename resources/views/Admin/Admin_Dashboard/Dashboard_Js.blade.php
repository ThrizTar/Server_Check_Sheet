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
        $(document).on('click', '.filter_checks', function(e) {
            e.preventDefault();

            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var checksheet_name = $('#checksheet_name').val();

            $.ajax({
                method: "GET",
                url: "{{ route('admin.filter-dashboard') }}",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    checksheet_name: checksheet_name,
                },
                success: function(res) {
                    $('.checks').html(res);
                    console.log("I'm working");

                    applyDateRowBorders();
                }
            });
        })

        function applyDateRowBorders() {
            $('.checklist-group').each(function() {
                let prevDate = null;

                $(this).find('.date-cell').each(function() {
                    const currentDate = $(this).data('date');
                    console.log("Yoyo");

                    if (prevDate !== null && currentDate !== prevDate) {
                        $(this).closest('tr').addClass('date-changed');
                    }

                    prevDate = currentDate;

                    console.log('prevDate: ' + prevDate);
                    console.log('currentDate: ' + currentDate);
                });
            });
        }

        applyDateRowBorders();

        // Show comment
        $(document).on("click", "tr", function() {
            if ($(this).find(".more-info").css('display') == 'none') {
                $(this).find(".more-info").show();
            } else {
                $(this).find(".more-info").hide();
            }

        });
    })
</script>
