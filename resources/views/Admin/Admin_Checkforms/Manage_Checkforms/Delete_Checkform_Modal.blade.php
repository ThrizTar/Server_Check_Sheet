  <!-- Modal -->
  <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="delModalLabel">Delete this Checkform?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-contain-del">
                <div class="modal-body">
                    <input type="hidden" name="del_checkform_organize" id="del_checkform_organize">
                    <h6>Are you sure to delete this checkform?</h6>
                    <p>If you delete this checkform either as checklists or lists have been deleted completely.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete_checkform">Yes!</button>
            </div>
        </div>
    </div>
</div>
