  <!-- Modal -->
  <div class="modal fade" id="grantPModal" tabindex="-1" aria-labelledby="grantPModalLabel" aria-hidden="true">
      <form action="" method="post" id="grantPForm">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="grantPModalLabel">Grant Privillege</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-add">
                      <div class="modal-body">

                          <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                          </div>

                          <div class="form-group mt-2">
                              <strong for='username'>Username</strong>
                              <input type="text" class="form-control" name="username" id="username"
                                  placeholder="Username">
                          </div>

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary grant_privillege">Grant Privillege</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
