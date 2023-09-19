<div class="whos-speaking-area speakers pad100">
    <div class="row mb50">
        @foreach ($checklists as $checklist)
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="speakers xs-mb30">
                    <div class="spk-img">
                        <a href="#"
                            class="px-3 py-5 bg-white shadow text-center d-block match-height check">
                            <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                            <h3 class="mb-3 mt-0">{{ $checklist->checklist_name }}</h3>
                            <h3 class="mb-3 mt-0">Organize: {{ $checksheet['organize'] }}</h3>
                            <h6 class="mb-3 mt-0">({{ $checkform_name['checkform_name'] }})</h6>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="fa fa-pen-to-square update_checklist_form"
                                    data-bs-toggle="modal" data-bs-target="#updateModal"
                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                    data-checklist_organize="{{ $checklist->checklist_organize }}"
                                    data-checklist_name="{{ $checklist->checklist_name }}">

                                </a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-trash delete_checklist_form"
                                    data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-placement="top"data-checklist_organize="{{ $checklist->checklist_organize }}"
                                    title="Delete">
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/lists/' . $checksheet_name . '/' . $checklist->checkform_organize . '/' . $checklist->checklist_name) }}"
                                    class="fa fa-circle-check" data-toggle="tooltip" data-placement="top"
                                    title="Lists">
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-lg-4 col-sm-6 mb-4">
            <a href="" class="px-3 py-5 bg-white shadow text-center d-block match-height "
                data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fa-regular fa-square-plus icon mt-0 mb-3"></i>
                <h3 class="mb-3 mt-0">Add new </h3>
                <h3 class="mb-3 mt-0">Check List </h3>
                <h3 class="mb-3 mt-0">Title</h3>
            </a>
        </div>
    </div>
</div>
<div class="pagination justify-content-center">
    {!! $checklists->links() !!}
</div>