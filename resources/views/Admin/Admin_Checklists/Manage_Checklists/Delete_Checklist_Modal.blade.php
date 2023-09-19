  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete this checklist?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-contain-del">
                <div class="modal-body">
                    <input type="hidden" name="del_checklist_organize" id="del_checklist_organize">
                    <h6>Are you sure to delete this checklist?</h6>
                    <p>If you delete this checklist either as checklists or lists have been deleted completely.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete_checklist">Yes!</button>
            </div>
        </div>
    </div>
</div>
