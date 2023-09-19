  <!-- Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
      <form action="" method="post" id="createCheckformForm">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addModalLabel">Create Checkform</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-add">
                      <div class="modal-body">

                          <div class="alert alert-danger print-error-msg-checkform" style="display:none">
                              <ul></ul>
                          </div>

                          <input type="hidden" name="checksheet_name" id="checksheet_name"
                              value="{{ $checksheet_name }}">

                          <div class="form-group mt-2">
                              <strong for='checkform_name'>Checkform Name</strong>
                              <input type="text" class="form-control" name="checkform_name" id="checkform_name"
                                  placeholder="Checkform Name">
                          </div>

                          <div class="form-group mt-2">
                              <strong for='form_type'>Type</strong>
                              <select class="form-select form-select-lg mb-3" name="form_type" id="form_type"
                                  aria-label="Default select example">
                                  <option value="checklist">Checklist</option>
                                  <option value="fill_input">Fill Input</option>
                              </select>
                          </div>

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary create_checkform">Create Checkform</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
