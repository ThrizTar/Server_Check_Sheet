  <!-- Modal -->
  <div class="modal fade" id="addInputModal-{{ $delspace_checkform_name }}" tabindex="-1"
      aria-labelledby="addInputModalLabel" aria-hidden="true">
      <form action="" method="post" id="addInputFormcheckForm">
          @csrf
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addInputModalLabel">Add {{ $checkform->checkform_name }} Input</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-contain-Input-{{ $delspace_checkform_name }}">
                      {{-- <input type="hidden" name="checkform_name" id="checkform_name"> --}}
                      @php
                          $count = 0;
                      @endphp
                      <div class="add_remove_button">
                          <a class="btn btn-primary add_input text-light ml-1 mt-1" id="add"
                              data-key="{{ $count }}" data-checkform_name="{{ $delspace_checkform_name }}">
                              <span class="fa fa-plus"> Add New Input</span>
                          </a>
                          <a class="btn btn-danger remove_input text-light mr-1 mt-1" id="remove"
                              data-key="{{ $count }}" data-checkform_name="{{ $delspace_checkform_name }}">
                              <span class="fa fa-minus"> Remove Input</span>
                          </a>
                      </div>

                      <div class="modal-body" id="modal_body_{{ $count }}_{{ $delspace_checkform_name }}">

                          <div class="alert alert-danger print-error-msg-input" style="display:none">
                              <span class="error"></span>
                          </div>
                          
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif

                          <div class="form-group mt-2 " id="input_{{ $count }}_{{ $delspace_checkform_name }}">
                              <div class="inline-input-option"
                                  id="input_css_{{ $count }}_{{ $delspace_checkform_name }}">

                                  <input type="text" class="form-control"
                                      name="input_value_{{ $count }}_{{ $delspace_checkform_name }}"
                                      id="input_value_{{ $count }}_{{ $delspace_checkform_name }}"
                                      placeholder="Input">
                                  <div class="wrapper">
                                      <input type="radio"
                                          name="Radio-{{ $count }}_{{ $delspace_checkform_name }}"
                                          id="type-1-{{ $count }}-{{ $delspace_checkform_name }}"
                                          data-id="type-1-{{ $count }}-{{ $delspace_checkform_name }}"
                                          data-checkform_name="{{ $delspace_checkform_name }}" value="text"
                                          class="sub_chk" checked>
                                      <input type="radio"
                                          name="Radio-{{ $count }}_{{ $delspace_checkform_name }}"
                                          id="type-0-{{ $count }}-{{ $delspace_checkform_name }}"
                                          data-id="type-0-{{ $count }}-{{ $delspace_checkform_name }}"
                                          data-checkform_name="{{ $delspace_checkform_name }}" value="select"
                                          class="sub_chk">

                                      <label for="type-1-{{ $count }}-{{ $delspace_checkform_name }}"
                                          class="option option-1 ">
                                          <div class="dot"></div>
                                          <span>Text</span>
                                      </label>
                                      <label for="type-0-{{ $count }}-{{ $delspace_checkform_name }}"
                                          class="option option-0 ">
                                          <div class="dot"></div>
                                          <span>Select</span>
                                      </label>
                                  </div>

                              </div>

                              <div class="option_field"
                                  id="option_field_{{ $count }}_{{ $delspace_checkform_name }}">

                              </div>
                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary add_input_checkform"
                              data-key="{{ $count }}" data-checkform_name="{{ $delspace_checkform_name }}"
                              data-checkform_organize="{{ $checkform->checkform_organize }}">Add Input</button>
                          {{-- <button type="button" class="btn btn-primary add_option_checkform" data-key="{{ $key }}">Add Option</button> --}}
                      </div>
                  </div>
              </div>
          </div>
      </form>
  </div>
