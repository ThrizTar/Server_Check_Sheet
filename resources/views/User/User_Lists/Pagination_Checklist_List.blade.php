<div class="search-body">
    @foreach ($checklists as $key => $checklist)
        <a class="{{ Request::is('user/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) ? 'active' : '' }}"
            href="{{ url('user/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) }}">
            <div class="checklist">
                <div class="info">
                    <div class="filter-checklists">
                        <h4>{{ $checklist->checklist_name }} </h4>
                        <small>Status:
                            <span>{{ $checklist->lists->count() }}</span></small>
                        <input type="hidden" name="checkform_organize"
                            id="checkform_organize"
                            value="{{ $checklist->checkform_organize }}">
                        <input type="hidden" name="checksheet_name" id="checksheet_name"
                            value="{{ $checksheet_name }}">
                        <input type="hidden" name="checklist_organize"
                            id="checklist_organize"
                            value="{{ $checklist->checklist_organize }}">
                    </div>
                </div>

                <div class="list">
                    <span class="fa-solid fa-sheet-plastic"></span>
                </div>
            </div>
        </a>
    @endforeach
</div>
<div class="pagination justify-content-center">
    {!! $checklists->links() !!}
</div>