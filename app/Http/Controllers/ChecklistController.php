<?php

namespace App\Http\Controllers;

use App\Models\Checkforms;
use App\Models\Checklists;
use App\Models\Checksheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    // Create checklists
    public function Create_Checklist(Request $request)
    {
        // Validate all input
        $validator = Validator::make(
            $request->all(),
            [
                'checklist_organize' => 'required|unique:checklists',
                'checklist_name' => 'required',
            ],
            [
                'checklist_name.required' => 'Please enter the Checklist name before creating.',
                'checklist_organize.unique' => 'The Checklist name has already been taken.'
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Create checklists in database
        Checklists::create([
            'checklist_name' => $request->checklist_name,
            'checklist_organize' => $request->checklist_organize,
            'checkform_organize' => $request->checkform_organize,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $request->checklist_organize
        ]);
    }

    // Update checklists
    public function Update_Checklist(Request $request)
    {
        // Validate all input
        $validator = Validator::make(
            $request->all(),
            [
                'up_checklist_organize' => 'required|unique:checklists,checklist_organize'
            ],
            [
                'up_checklist_organize.required' => 'Please enter the Checklist name before updating.',
                'up_checklist_organize.unique' => 'The Checklist name has already been taken.'
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Find checklist name and update
        Checklists::where('checklist_organize', $request->checklist_organize)->update([
            'checklist_name' => $request->up_checklist_name,
            'checklist_organize' => $request->up_checklist_organize,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    // Delete checklists
    public function Delete_Checklist(Request $request)
    {
        // Find checklists name and delete
        Checklists::where('checklist_organize', $request->del_checklist_organize)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    // Pagination checklists page for admin
    public function Admin_Pagination_Checklists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checksheet = Checksheets::find($checksheet_name);
        $checkform_name = Checkforms::find($checkform_organize);

        $total = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')
            ->count();

        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')
            ->paginate(8);

        if ($checklists) {
            return view('Admin.Admin_Checklists.Pagination_Checklist_Index', compact('checklists', 'checksheet_name', 'checkform_organize', 'total', 'checksheet', 'checkform_name'))->render();
        } else {
            return response()->json([
                'message' => "-0-",
            ]);
        }
    }

    // Seach checklists for admin
    public function Admin_Search_Checklists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checksheet = Checksheets::find($checksheet_name);
        $checkform_name = Checkforms::find($checkform_organize);

        $total = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'asc')
            ->count();

        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)
            ->where(function ($query) use ($request) {
                $query->where('checklist_name', 'LIKE', '%' . $request->search_string . '%');
            })
            ->orderBy('created_at', 'desc')->paginate(8);
        if ($checklists) {
            return view('Admin.Admin_Checklists.Pagination_Checklist_Index', compact('checkform_organize', 'checksheet_name', 'total', 'checklists', 'checkform_name', 'checksheet'))->render();
            // return dd($request);
        } else {
            return response()->json([
                'status' => 'Nothing Found',
            ]);
        }
    }

    // Pagination checklists page for user
    public function User_Pagination_Checklists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checksheet = Checksheets::find($checksheet_name);

        $total = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')
            ->count();

        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')
            ->paginate(8);

        if ($checklists) {
            return view('User.User_Checklists.Pagination_Checklist_Index', compact('checklists', 'checksheet_name', 'checkform_organize', 'total', 'checksheet'))->render();
        } else {
            return response()->json([
                'message' => "-0-",
            ]);
        }
    }

    // Search checklists for user
    public function User_Search_Checklists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checksheet = Checksheets::find($checksheet_name);

        $total = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'asc')
            ->count();

        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)
            ->where(function ($query) use ($request) {
                $query->where('checklist_name', 'LIKE', '%' . $request->search_string . '%');
            })
            ->orderBy('created_at', 'desc')->paginate(8);
        if ($checklists) {
            return view('User.User_Checklists.Pagination_Checklist_Index', compact('checkform_organize', 'checksheet_name', 'total', 'checklists', 'checksheet'))->render();
            // return dd($request);
        } else {
            return response()->json([
                'status' => 'Nothing Found',
            ]);
        }
    }
}
