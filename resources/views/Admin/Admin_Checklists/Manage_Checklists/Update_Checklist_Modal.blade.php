  <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
      <form action="" method="post" id="updateChecklistForm">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="updateModalLabel">Update Checklist</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-update">
                      <div class="modal-body">

                          <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                          </div>

                          <input type="hidden" name="checkform_organize" id="checkform_organize"
                              value="{{ $checkform_organize }}">
                          <input type="hidden" name="up_checklist_organize" id="up_checklist_organize">
                          <input type="hidden" name="checklist_organize" id="checklist_organize">


                          <div class="form-group mt-2">
                              <strong for='checklist_name'>Checklist Name</strong>
                              <input type="text" class="form-control" name="up_checklist_name" id="up_checklist_name"
                                  placeholder="Checkform Name">
                          </div>


                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary update_checklist">Update Checklist</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
