<?php

namespace App\Http\Controllers;

use App\Models\Checkforms;
use App\Models\Checklists;
use App\Models\Checksheets;
use App\Models\Fill_Lists;
use App\Models\Fill_Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckformController extends Controller
{
    // Create Checkform
    public function Create_Checkform(Request $request)
    {
        // Validate checkforms input
        $validator = Validator::make(
            $request->all(),
            [
                'checkform_organize' => 'required|unique:checkforms',
                'checkform_name' => 'required',
            ],
            [
                'checkform_name.required' => 'Please enter the Checkform name before creating.',
                'checkform_organize.unique' => 'The Checkform name has already been taken.'
            ]
        );

        // Error when validate  fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Create checkforms in database
        Checkforms::create([
            'checkform_organize' => $request->checkform_organize,
            'checksheet_name' => $request->checksheet_name,
            'checkform_name' => $request->checkform_name,
            'form_type' => $request->form_type,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    // Update Checkform
    public function Update_Checkform(Request $request)
    {

        // Validate all input
        $validator = Validator::make(
            $request->all(),
            [
                'up_checkform_name' => 'required',
            ],
            [
                'up_checkform_name.required' => 'Please enter the Checkform name before updating.',
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Search checkforms and update
        Checkforms::where('checkform_organize', $request->checkform_organize)
            ->update([
                'checkform_name' => $request->up_checkform_name,
                'checkform_organize' => $request->up_checkform_organize,
                'form_type' => $request->up_form_type
            ]);

        if ($request->trigger == 'change_type') {
            if ($request->up_form_type == 'fill_input') {
                Checklists::where('checkform_organize', $request->checkform_organize)->delete();
            } elseif ($request->up_form_type == 'checklist') {
                Fill_Lists::where('checkform_organize', $request->checkform_organize)->delete();
            }
        }

        return response()->json([
            'status' => 'success',
            'messaage' => $request->trigger,
        ]);
    }

    // Delete Checkform
    public function Delete_Checkform(Request $request)
    {
        // Search checkforms and delete 
        Checkforms::where('checkform_organize', $request->del_checkform_organize)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    // Add Input to Checkform
    public function Add_input_Checkform(Request $request)
    {

        // Receive all input and transform to array
        $all_input_ids = explode(",", $request->join_input_ids);
        $all_inputs = explode(",", $request->join_inputs);
        $all_types = explode(",", $request->join_types);
        $all_options = explode(",", $request->join_options);
        $all_form_fill_input = explode(",", $request->join_form_fill_inputs);
        $all_input_options = explode(",", $request->join_input_options);

        // Check for duplicate values in the arrays
        if (count(array_unique($all_input_ids)) !== count($all_input_ids)) {
            return response()->json([
                'status' => 'dup',
                'errors' => 'Please do not fill the duplicate input title.'
            ]);
        } elseif (count(array_unique($all_input_options)) !== count($all_input_options)) {
            return response()->json([
                'status' => 'dup',
                'errors' => 'Please do not fill the duplicate options value.'
            ]);
        }

        // Check for conflicts with existing data
        foreach ($all_input_ids as $input_id) {
            if (Fill_Lists::where('form_fill_input', $input_id)->exists()) {
                return response()->json([
                    'errors' => 'The input title has already been taken in this checkform.'
                ]);
            }
        }

        // Loop for create input title (checkforms type fill input)
        for ($i = 0; $i < count($all_inputs); $i++) {

            Fill_Lists::create([
                'form_fill_input' => $all_input_ids[$i],
                'input_title' => $all_inputs[$i],
                'input_type' => $all_types[$i],
                'checkform_organize' => $request->checkform_organize,
            ]);
        }

        // Loop for create options if exist (input title type select)
        if (count($all_options) > 1) {
            for ($j = 0; $j < count($all_options); $j++) {
                if ($all_form_fill_input[$j] != "") {
                    Fill_Options::create([
                        'input_option' => $all_input_options[$j],
                        'form_fill_input' => $all_form_fill_input[$j],
                        'option_detail' => $all_options[$j],
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => array_unique($all_inputs)
        ]);
    }

    // Update input title (checkforms type fill input)
    public function Update_Input_Checkform(Request $request)
    {
        // Receive all input and transform to array
        $all_input_ids = explode(",", $request->join_input_ids);
        $all_new_input_ids = explode(",", $request->join_new_input_ids);
        $all_inputs = explode(",", $request->join_inputs);
        $all_types = explode(",", $request->join_types);
        $all_options = explode(",", $request->join_options);
        $all_option_ids = explode(",", $request->join_option_ids);
        $all_input_options = explode(",", $request->join_input_options);
        $all_up_option_ids = explode(",", $request->p_allup_option_ids);

        // Check for duplicate values in the arrays
        if (count(array_unique($all_new_input_ids)) !== count($all_new_input_ids)) {
            return response()->json([
                'status' => 'dup',
                'errors' => 'Please do not fill the duplicate input title.'
            ]);
        } elseif (count(array_unique($all_up_option_ids)) !== count($all_up_option_ids)) {
            return response()->json([
                'status' => 'dup',
                'errors' => 'Please do not fill the duplicate options value.'
            ]);
        }

        // Loop for update input title
        for ($i = 0; $i < count($all_input_ids); $i++) {

            // Find for each input id
            $input_id = Fill_Lists::find($all_input_ids[$i]);

            // If exist update input title
            if ($input_id) {
                Fill_Lists::where('form_fill_input', '=', $all_input_ids[$i])->update([
                    'form_fill_input' => $all_new_input_ids[$i],
                    'input_title' => $all_inputs[$i],
                    'input_type' => $all_types[$i],
                ]);
            }
        }

        // Loop for update options
        if (count($all_option_ids) > 1) {
            for ($j = 0; $j < count($all_options); $j++) {

                // Find for each options id
                $check_notempty = Fill_Options::find($all_option_ids[$j]);

                // If exist update options
                if ($check_notempty) {
                    DB::table('fill__options')->where('input_option', '=', $all_option_ids[$j])->update([
                        'input_option' => $all_up_option_ids[$j],
                        'option_detail' => $all_options[$j],
                    ]);

                    // If not exist create new options in database
                } else {
                    Fill_Options::create([
                        'input_option' => $all_up_option_ids[$j],
                        'form_fill_input' => $all_input_options[$j],
                        'option_detail' => $all_options[$j],
                    ]);
                }
            }
        }
        return response()->json([
            'message' => count($all_option_ids),
            'status' => 'success',
        ]);
    }

    // Delete input title (checkform type fill input)
    public function Delete_Input_Checkform(Request $request)
    {
        // Find input id and delete
        Fill_Lists::find($request->del_input_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    // Delete options (input title type select)
    public function Delete_Option_Checkform(Request $request)
    {
        // Find options id and delete
        Fill_Options::find($request->del_option_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    // Delete all options when change input tile type select to text
    public function Delete_Change_Type(Request $request)
    {
        // Receive all options id
        $all_option_ids = $request->join_option_ids;

        // Transfrom all options id to array and delete
        DB::table('fill__options')->whereIn('input_option', explode(",", $all_option_ids))->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    // Pagination checkforms page
    public function Admin_Pagination_Checkforms(Request $request)
    {
        $checksheet_name = $request->checksheet_name;
        $checksheet = Checksheets::find($checksheet_name);
        $checkforms = Checkforms::where('checksheet_name', '=', $checksheet_name)->orderBy('created_at', 'desc')->paginate(8);
        $fill_inputs = Fill_Lists::orderBy('created_at', 'desc')->get();
        $fill_options = Fill_Options::orderBy('created_at', 'desc')->get();
        $total = Checkforms::all()->count();

        return view('Admin.Admin_Checkforms.Pagination_Checkform', compact('checkforms', 'checksheet_name', 'fill_inputs', 'fill_options', 'total', 'checksheet'))->render();
    }

    // Search checkforms for admin
    public function Admin_Search_Checkforms(Request $request)
    {
        $checksheet_name = $request->checksheet_name;
        $checksheet = Checksheets::find($checksheet_name);
        $fill_inputs = Fill_Lists::orderBy('created_at', 'desc')->get();
        $fill_options = Fill_Options::orderBy('created_at', 'desc')->get();

        $checkforms = Checkforms::where('checkforms.checksheet_name', '=', $checksheet_name)
            ->where(function ($query) use ($request) {
                $query->where('checkform_name', 'LIKE', '%' . $request->search_string . '%')
                    ->orWhere('form_type', 'LIKE', '%' . $request->search_string . '%');
            })
            ->orderBy('created_at', 'asc')->orderBy('created_at', 'desc')->paginate(8);
        if ($checkforms) {
            return view('Admin.Admin_Checkforms.Pagination_Checkform', compact('checkforms', 'checksheet_name', 'fill_inputs', 'fill_options', 'checksheet'))->render();
            // return dd($request);
        } else {
            return response()->json([
                'status' => 'Nothing Found',
            ]);
        }
    }

    // Pagination checkforms for user
    public function User_Pagination_Checkforms(Request $request)
    {
        $checksheet_name = $request->checksheet_name;
        $checkforms = Checkforms::where('checksheet_name', '=', $checksheet_name)->orderBy('created_at', 'desc')->paginate(9);
        $fill_inputs = Fill_Lists::orderBy('created_at', 'desc')->get();
        $fill_options = Fill_Options::orderBy('created_at', 'desc')->get();
        $total = Checkforms::where('checksheet_name', '=', $checksheet_name)->count();

        return view('User.User_Checkforms.Pagination_Checkform_Index', compact('checkforms', 'checksheet_name', 'fill_inputs', 'fill_options', 'total'))->render();
    }

    // Search checkforms page for user 
    public function User_Search_Checkforms(Request $request)
    {
        $checksheet_name = $request->checksheet_name;
        $fill_inputs = Fill_Lists::orderBy('created_at', 'desc')->get();
        $fill_options = Fill_Options::orderBy('created_at', 'desc')->get();

        $checkforms = Checkforms::where('checkforms.checksheet_name', '=', $checksheet_name)
            ->where(function ($query) use ($request) {
                $query->where('checkform_name', 'LIKE', '%' . $request->search_string . '%')
                    ->orWhere('form_type', 'LIKE', '%' . $request->search_string . '%');
            })
            ->orderBy('created_at', 'asc')->orderBy('created_at', 'desc')->paginate(8);
        if ($checkforms) {
            return view('User.User_Checkforms.Pagination_Checkform_Index', compact('checkforms', 'checksheet_name', 'fill_inputs', 'fill_options'))->render();
            // return dd($request);
        } else {
            return response()->json([
                'status' => 'Nothing Found',
            ]);
        }
    }
}
