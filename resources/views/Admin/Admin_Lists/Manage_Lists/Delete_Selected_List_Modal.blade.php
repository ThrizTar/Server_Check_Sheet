  <!-- Modal -->
  <div class="modal fade" id="deleteSelectedModal" tabindex="-1" aria-labelledby="deleteSelectedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteSelectedModalLabel">Delete this list?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-contain-del">
                <div class="modal-body">
                    <input type="hidden" name="del_list_id" id="del_list_id">
                    <h6>Are you sure to delete this list?</h6>
                    <p>If you delete this list this list has been deleted completely.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger confirm" data-confirm="true">Yes!</button>
            </div>
        </div>
    </div>
</div>
