  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <form action="" method="post" id="addCheckSheetForm">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addModalLabel">Create Check Sheet</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-add">
                      <div class="modal-body">

                          <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                          </div>

                          <div class="form-group mt-2">
                              <strong for='checksheet_name'>Check Sheet Name</strong>
                              <input type="text" class="form-control" name="checksheet_name" id="checksheet_name"
                                  placeholder="Check Sheet Name">
                          </div>

                          <input type="hidden" class="form-control" name="organize" id="organize"
                              value="{{ Auth::user()->organize }}" placeholder="Organize">

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary create_checksheet">Create Check Sheet</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
