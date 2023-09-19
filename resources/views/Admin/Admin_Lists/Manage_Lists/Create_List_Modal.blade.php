  <!-- Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
      <form action="" method="post" id="createListForm">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="createModalLabel">Create List</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-add">
                      <div class="modal-body">

                          <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                          </div>

                          <input type="hidden" class="form-control" name="checklist_organize" id="checklist_organize"
                              value="{{ $checklist_organize }}">


                          <div class="form-group mt-2">
                              <strong for='detail'>Detail</strong>
                              <input type="text" class="form-control" name="detail" id="detail"
                                  placeholder="Detail">
                          </div>

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary create_list">Create List</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
