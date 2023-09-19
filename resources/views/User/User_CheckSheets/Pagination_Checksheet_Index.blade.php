<div class="whos-speaking-area speakers pad100">
    <div class="row mb50">
        @foreach ($checksheets as $checksheet)
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{ url('/user/checkforms/' . $checksheet->checksheet_name) }}"
                    class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                    <i class="fa-solid fa-file icon text-primary d-block mb-4"></i>
                    <h3 class="mb-3 mt-0">{{ $checksheet->checksheet_name }}</h3>
                    <p class="mb-0">Organize: {{ $checksheet->organize }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
<div class="pagination justify-content-center">
    {!! $checksheets->links() !!}
</div>
