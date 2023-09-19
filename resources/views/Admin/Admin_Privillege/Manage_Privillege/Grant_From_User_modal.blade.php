  <!-- Modal -->
  <div class="modal fade" id="grantP_userModal" tabindex="-1" aria-labelledby="grantP_userModalLabel" aria-hidden="true">
      <form action="" method="post" id="grantP_userForm">
          @csrf
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="grantP_userModalLabel">Grant Privillege</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-add">
                      <div class="modal-body">
                          <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                          </div>
                          <div class="table-responsive">
                              <input type="text" name="search_user" id="search_user" class="search_user"
                                  placeholder="Search User Here....">
                              <table id="user_table" class="table" width="100%">
                                  <thead class="text-center">
                                      <tr>
                                          <td>No.</td>
                                          <td>Username</td>
                                          <td>First Name</td>
                                          <td>Last Name</td>
                                          <td>Organize</td>
                                          <td>Action</td>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($users as $key => $user)
                                          <tr class="text-center">
                                              <td>{{ ++$key }}</td>
                                              <td>{{ $user->username }}</td>
                                              <td>{{ $user->first_name }}</td>
                                              <td>{{ $user->last_name }}</td>
                                              @if ($user->organize == null)
                                                  <td> - </td>
                                              @else
                                                  <td>{{ $user->organize }}</td>
                                              @endif
                                              <td>
                                                  <button type="button"class="btn btn-primary import_user" data-username_import="{{ $user->username }}">Grant</button>
                                              </td>
                                              <td>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              {{-- <div class="pagination justify-content-center">
                                  {!! $users->links() !!}
                              </div> --}}
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
