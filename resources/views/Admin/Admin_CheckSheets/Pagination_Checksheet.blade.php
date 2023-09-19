<div class="whos-speaking-area speakers pad100">
    <div class="row mb50">
        @foreach ($checksheets as $checksheet)
            @if (Auth::user()->organize == $checksheet->organize)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="speakers xs-mb30">
                        <div class="spk-img">
                            <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                                <i class="fa-solid fa-file icon text-primary d-block mb-4"></i>
                                <h3 class="mb-3 mt-0">{{ $checksheet->checksheet_name }}</h3>
                                <p class="mb-0">Organize: {{ $checksheet->organize }}</p>
                            </a>
                            <ul>
                                <li>
                                    <a href="" class="fa fa-pen-to-square update_checksheet_form"
                                        data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Edit"
                                        data-bs-target="#updateModal"
                                        data-checksheet_name="{{ $checksheet->checksheet_name }}"
                                        data-organize="{{ $checksheet->organize }}">
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="fa fa-trash del_checksheet_form" data-toggle="tooltip"
                                        data-placement="top" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#delModal"
                                        data-checksheet_name="{{ $checksheet->checksheet_name }}">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/checkforms/' . $checksheet->checksheet_name) }}"
                                        class="fa fa-list" data-toggle="tooltip" data-placement="top"
                                        title="Check Form">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="col-lg-4 col-sm-6 mb-4">
            <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height " data-bs-toggle="modal"
                data-bs-target="#addModal">
                <i class="fa-solid fa-file-circle-plus icon mt-0 mb-4"></i>
                <h3 class="mb-3 mt-0">Add New</h3>
                <h3 class="mb-3 mt-0">Checksheet</h3>
            </a>
        </div>
    </div>
</div>
<div class="pagination justify-content-center">
    {!! $checksheets->links() !!}
</div>
