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
        // Pagination Checksheet
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            checksheet(page)
        })

        function checksheet(page) {
            $.ajax({
                url: "user/checksheet/pagination/paginate-data?page=" + page,
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
                url: "{{ route('user.search-checksheets') }}",
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
