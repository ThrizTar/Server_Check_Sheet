  <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
      <form action="" method="post" id="updateCheckSheetForm">
          @csrf
          <input type="hidden" id="up_id">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="updateModalLabel">Update Check Sheet</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                      <div class="alert alert-danger print-error-msg" style="display:none">
                          <ul></ul>
                      </div>

                      <input type="hidden" name="old_checksheet_name" id="old_checksheet_name">

                      <div class="form-group mt-2">
                          <strong for='checksheet_name'>Check Sheet Name</strong>
                          <input type="text" class="form-control" name="up_checksheet_name" id="up_checksheet_name"
                              placeholder="Check Sheet Name">
                      </div>

                      {{-- <div class="form-group mt-2"> --}}
                      {{-- <strong for='organize'>Organize</strong> --}}
                      <input type="hidden" class="form-control" name="up_organize" id="up_organize"
                          placeholder="Organize">
                      {{-- </div> --}}

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary update_checksheet">Update Check Sheet</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
