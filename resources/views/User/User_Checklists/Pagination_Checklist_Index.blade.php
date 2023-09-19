<div class="whos-speaking-area speakers pad100">
    <div class="row mb50">
        @foreach ($checklists as $checklist)
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="speakers xs-mb30">
                    <a href=" {{ url('user/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) }} "
                        class="px-3 py-5 bg-white shadow text-center d-block match-height">
                        <i class="fa fa-list-check icon text-primary d-block mb-4"></i>
                        <h3 class="mb-3 mt-0">{{ $checklist->checklist_name }}</h3>
                        <h4 class="mb-3 mt-0">Organize: {{ $checksheet['organize'] }}</h4>
                        <h6 class="mb-3 mt-0">({{ $checksheet_name }})</h6>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="pagination justify-content-center">
    {!! $checklists->links() !!}
</div>