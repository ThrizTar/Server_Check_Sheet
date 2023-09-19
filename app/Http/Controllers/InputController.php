<?php

namespace App\Http\Controllers;

use App\Models\Check_Input;
use App\Models\Checkforms;
use App\Models\Checklists;
use App\Models\Fill_Input;
use App\Models\Fill_Lists;
use App\Models\Lists;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InputController extends Controller
{
    // Add check result from user (checkforms type checklists)
    public function Add_Checklist_Status(Request $request)
    {
        // Receive Input form and transfrom to array
        $all_list_ids = explode("|", $request->list_ids);
        $all_status = explode("|", $request->status);
        $all_comments = explode("|", $request->comments);
        $date_check = $request->date_check;
        $checklist_organize = $request->checklist_organize;

        // Validate that that checklists checked?
        $checklist_checkinputs = Check_Input::join('lists', 'check__inputs.list_detail', '=', 'lists.list_detail')
            ->select('check__inputs.created_at', 'lists.checklist_organize')
            ->where('lists.checklist_organize', '=', $checklist_organize)
            ->where('check__inputs.created_at', 'LIKE', '%' . $date_check . '%')
            ->orderBy('created_at', 'asc')
            ->get();

        // Error when validate fails
        if ($checklist_checkinputs->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This Checklist was checked today.'
            ]);

            // Add check result when not check
        } else {
            for ($i = 0; $i < $request->list_count; $i++) {
                if ($all_comments[$i] !== "") {
                    Check_Input::create([
                        'username' => $request->it,
                        'list_detail' => $all_list_ids[$i],
                        'status' => $all_status[$i],
                        'comment' => $all_comments[$i]
                    ]);
                } else {
                    Check_Input::create([
                        'username' => $request->it,
                        'list_detail' => $all_list_ids[$i],
                        'status' => $all_status[$i],
                    ]);
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => $checklist_checkinputs
            ]);
        }
    }

    // Add input from user (checkforms type fill input)
    public function Add_Fill_Input(Request $request)
    {

        // Receive all input and transfrom to array
        $all_input_list_ids = explode(",", $request->join_input_list_ids);
        $all_input = explode(",", $request->join_inputs);

        // Check if an entry for the same period and day already exists
        $existingEntry = Fill_Input::join('fill__lists', 'fill__inputs.form_fill_input', 'fill__lists.form_fill_input')
            ->select('fill__inputs.*', 'fill__lists.checkform_organize', 'fill__lists.input_title')
            ->whereDate('fill__inputs.created_at', now()->format('Y-m-d'))
            ->where('checkform_organize', $request->checkform_organize)
            ->where('fill__lists.input_title', 'LIKE', '%Period%')
            ->orWhere('fill__lists.input_title', 'LIKE', '%Time%')
            ->get();

        // Error when data filled in the same day and same period if period is exist
        if ($existingEntry) {
            foreach ($existingEntry as $input) {
                if (in_array($input['input'], $all_input)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data for this period has already been input for today.'
                    ]);
                }
            }
        }

        // Add fill input when not data not exist
        for ($i = 0; $i < $request->total_element; $i++) {
            Fill_Input::create([
                'username' => $request->it,
                'form_fill_input' => $all_input_list_ids[$i],
                'input' => $all_input[$i],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => $existingEntry
        ]);
    }

    // Filter Date in Dashboard
    public function Date_Filter_Dashboard(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $todayDate = Carbon::today()->format('Y-m-d');
        $checksheet_name = $request->checksheet_name;

        $checklists = Checklists::orderBy('created_at', 'asc')->get();
        $checkforms = Checkforms::orderBy('created_at', 'asc')->get();
        $fill_lists = Fill_Lists::all();

        // Find all checked data between start date and end date from user (checkforms type checklists)
        $userchecks = Lists::join('check__inputs', 'lists.list_detail', '=', 'check__inputs.list_detail')
            ->select('lists.checklist_organize', 'lists.list_detail', 'check__inputs.status', 'check__inputs.comment', 'check__inputs.created_at')
            ->when($start_date !== null && $end_date !== null, function ($q) use ($start_date, $end_date) {
                return $q->whereDate('check__inputs.created_at', '>=', $start_date)
                    ->whereDate('check__inputs.created_at', '<=', $end_date);
            }, function ($q) {
                $todayDate = Carbon::today()->format('Y-m-d');
                return $q->whereDate('check__inputs.created_at', $todayDate);
            })
            ->orderBy('created_at', 'asc')->get();

        $usernameInputs = [];

        // Keep all user input in array (checkforms type fill input)
        foreach ($checkforms as $checkform) {
            // Fetch the relevant fill_lists for the current checkform
            $relevant_fill_lists = $fill_lists->where('checkform_organize', $checkform->checkform_organize);

            // Fetch the inputs for the current checkform
            $inputs = Fill_Input::whereIn('form_fill_input', $relevant_fill_lists->pluck('form_fill_input'))
                ->when($start_date !== null && $end_date !== null, function ($q) use ($start_date, $end_date) {
                    return $q->whereDate('fill__inputs.created_at', '>=', $start_date)
                        ->whereDate('fill__inputs.created_at', '<=', $end_date);
                }, function ($q) {
                    $todayDate = Carbon::today()->format('Y-m-d');
                    return $q->whereDate('fill__inputs.created_at', $todayDate);
                })->orderBy('created_at', 'asc')->get();

            // Group the inputs by 'created_at' and store them in the $usernameInputs array
            foreach ($inputs->groupBy('created_at') as $date => $groupedInputs) {
                foreach ($groupedInputs as $input) {
                    $usernameInputs[$checkform->checkform_organize][] = $input;
                }
            }
        }

        return view('Admin.Admin_Dashboard.Filter_Dashboard', compact('userchecks', 'checklists', 'checkforms', 'fill_lists', 'usernameInputs', 'checksheet_name'))->render();
    }
}
