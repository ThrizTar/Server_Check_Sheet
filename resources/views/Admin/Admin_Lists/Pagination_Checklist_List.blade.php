@foreach ($checklists as $key => $checklist)
    <a class="{{ Request::is('admin/lists/*' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) ? 'active' : '' }}"
        href="{{ url('admin/lists/' . $checksheet_name . '/' . $checkform_organize . '/' . $checklist->checklist_organize) }}">
        <div class="checklist">
            <div class="info">
                <div class="filter-checklists">
                    <h4>{{ $checklist->checklist_name }} </h4>
                    <small>Total: <span>{{ $checklist->lists->count() }}</span></small>
                    <input type="hidden" name="checkform_organize" id="checkform_organize"
                        value="{{ $checklist->checkform_organize }}">
                    <input type="hidden" name="checksheet_name" id="checksheet_name" value="{{ $checksheet_name }}">
                </div>
            </div>
            <div class="list">
                <span class="fa-solid fa-sheet-plastic"></span>
            </div>
        </div>
    </a>
@endforeach
<div class="pagination justify-content-center">
    {!! $checklists->links() !!}
</div>
