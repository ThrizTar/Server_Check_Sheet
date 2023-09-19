<div class="whos-speaking-area speakers pad100">
    <div class="row mb50">
        @foreach ($checkforms as $key => $checkform)
            <div class="col-lg-4 col-sm-6 mb-4">
                @if ($checkform->form_type == 'checklist')
                    <a href="{{ url('/user/checklists/' . $checksheet_name . '/' . $checkform->checkform_name) }}"
                        class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                        <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                        <h3 class="mb-3 mt-0">{{ $checkform->checkform_name }}</h3>
                        <h4 class="mb-3 mt-0">Type: {{ $checkform->form_type }}</h4>
                        <h6 class="mb-3 mt-0">({{ $checksheet_name }})</h6>
                    </a>
                @else
                    <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height check"
                        data-bs-toggle="modal" data-bs-target="#addFillInputModal-{{ $key }}">
                        <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                        <h3 class="mb-3 mt-0">{{ $checkform->checkform_name }}</h3>
                        <h4 class="mb-3 mt-0">Type: {{ $checkform->form_type }}</h4>
                        <h6 class="mb-3 mt-0">({{ $checksheet_name }})</h6>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
<div class="pagination justify-content-center">
    {!! $checkforms->links() !!}
</div>
