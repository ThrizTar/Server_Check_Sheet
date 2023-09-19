  <!-- Modal -->
  <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="delModalLabel">Delete this checksheet?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-contain-del">
                <div class="modal-body">
                    <input type="hidden" name="del_checksheet_name" id="del_checksheet_name">
                    <h6>Are you sure to delete this checksheet?</h6>
                    <p>If you delete this checksheet either as checklists or checks have been deleted completely.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger del_checksheet">Yes!</button>
            </div>
        </div>
    </div>
</div>
