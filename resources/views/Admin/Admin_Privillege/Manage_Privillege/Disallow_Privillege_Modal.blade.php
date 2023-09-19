  <!-- Modal -->
  <div class="modal fade" id="disallowModal" tabindex="-1" aria-labelledby="disallowModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="disallowModalLabel">Are you sure to disallow privillege from this User?</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-contain-del">
                  <div class="modal-body">
                      <input type="hidden" name="del_list_id" id="del_list_id">
                      <p>If you disallow privillege from this user he/she is not admin anymore untill you grant he/she
                          again.</p>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-danger disallow" data-confirm="true">Yes!</button>
              </div>
          </div>
      </div>
  </div>
