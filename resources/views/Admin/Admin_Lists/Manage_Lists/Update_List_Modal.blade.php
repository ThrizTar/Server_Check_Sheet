  <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
      <form action="" method="post" id="updateListForm">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="updateModalLabel">Update List</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-update">
                      <div class="modal-body">

                          <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                          </div>

                          <input type="hidden" name="old_up_list_detail" id="old_up_list_detail">

                          <div class="form-group mt-2">
                              <strong for='up_detail'>Detail</strong>
                              <input type="text" class="form-control" name="up_detail" id="up_detail"
                                  placeholder="Detail">
                          </div>

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary update_list">Update List</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
