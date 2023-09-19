    <div class="modal fade" id="addFillInputModal-{{ $delspace_checkform_name }}" tabindex="-1"
        aria-labelledby="addFillInputModalLabel" aria-hidden="true">
        <form action="" method="post" id="AddUser_InputForm_{{ $delspace_checkform_name }}">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFillInputModalLabel">Add Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-contain-add">
                        <div class="modal-body" id="modal-body-add-input-{{ $delspace_checkform_name }}"">
                            <input type="hidden" name="checkform_organize" id="checkform_organize" value="{{ $checkform->checkform_organize }}">

                            <div class="alert alert-danger print-error-msg-input" style="display:none">
                                <span class="error"></span>
                            </div>
                            
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($fill_lists as $key_list => $fill_list)
                                @if ($fill_list->checkform_organize == $checkform->checkform_organize)
                                    @if ($fill_list->input_type == 'text')
                                        <div class="form-group mt-2 ml-3 mr-3">
                                            <strong for='{{ $fill_list->input_title }}'>
                                                {{ $fill_list->input_title }} </strong>
                                            <input type="text" class="form-control user-input"
                                                name="user_input_{{ $key_list }}_{{ $delspace_checkform_name }}"
                                                id="user_input_{{ $key_list }}_{{ $delspace_checkform_name }}"
                                                placeholder="{{ $fill_list->input_title }}">
                                            <input type="hidden" class="form-control user-input-id"
                                                name="input_id_{{ $key_list }}_{{ $delspace_checkform_name }}" id="input_id_{{ $key_list }}_{{ $delspace_checkform_name }}"
                                                value="{{ $fill_list->form_fill_input }}">
                                        </div>
                                    @else
                                        <div class="form-group mt-2 ml-3 mr-3">
                                            <strong for='{{ $fill_list->input_title }}'>
                                                {{ $fill_list->input_title }} </strong>
                                            <select class="form-select form-select-lg mb-3 user-input"
                                                name="user_input_{{ $key_list }}_{{ $delspace_checkform_name }}"
                                                id="user_input_{{ $key_list }}_{{ $delspace_checkform_name }}"
                                                aria-label="Default select example">
                                                @foreach ($fill_options as $fill_option)
                                                    @if ($fill_option->form_fill_input == $fill_list->form_fill_input)
                                                        <option value="{{ $fill_option->option_detail }}">
                                                            {{ $fill_option->option_detail }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" class="form-control user-input-id"
                                            name="input_id_{{ $key_list }}_{{ $delspace_checkform_name }}" id="input_id_{{ $key_list }}_{{ $delspace_checkform_name }}"
                                            value="{{ $fill_list->form_fill_input }}">
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            <input type="hidden" class="form-control" name="it" id="it"
                                value="{{ Auth::user()->username }}" placeholder="Organize">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add_input"
                            data-checkform_name="{{ $delspace_checkform_name }}" data-key="{{ $key }}"
                            data-checkform_organize = "{{ $checkform->checkform_organize }}"
                            data-date_check="{{ Carbon\Carbon::today()->format('Y-m-d') }}">Add Status</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
