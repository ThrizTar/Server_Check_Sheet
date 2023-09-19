<?php

namespace App\Http\Controllers;

use App\Models\Checkforms;
use App\Models\Checksheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckSheetController extends Controller
{
    // Create checksheets
    public function Create_Checksheet(Request $request)
    {
        // Validate all input
        $validator = Validator::make(
            $request->all(),
            [
                'checksheet_name' => 'required|unique:checksheets',
                'organize' => 'required',
            ],
            [
                'checksheet_name.required' => 'Please enter the Check Sheet name before creating.',
                'checksheet_name.unique' => 'The Check Sheet name has already been taken.'
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Create checksheet in database
        Checksheets::create([
            'checksheet_name' => $request->checksheet_name,
            'organize' => $request->organize
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    // Update Checksheet
    public function Update_Checksheet(Request $request)
    {
        // Validate all input
        $validator = Validator::make(
            $request->all(),
            [
                'up_checksheet_name' => 'required|unique:checksheets,checksheet_name,' . $request->old_checksheet_name . ',checksheet_name',
            ],
            [
                'up_checksheet_name.required' => 'Please enter the Check Sheet name before updating.',
                'up_checksheet_name.unique' => 'The Check Sheet name has already been taken.'
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Find checksheet name and update
        Checksheets::where('checksheet_name', $request->old_checksheet_name)
            ->update([
                'checksheet_name' => $request->up_checksheet_name
            ]);

        return response()->json([
            'status' => 'success',
            'message' => $request->up_checksheet_name
        ]);
    }

    // Delete Checksheet
    public function Delete_Checksheet(Request $request)
    {
        // Find checksheet name and delete
        $checksheet_name = $request->checksheet_name;
        Checksheets::find($checksheet_name)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    // Pagination checksheet page for admin
    public function Admin_Pagination_Checksheets(Request $request)
    {
        $checksheets = Checksheets::orderBy('created_at', 'desc')->paginate(8);
        $checkforms = Checkforms::orderBy('created_at', 'desc')->get();
        $total = Checksheets::count();

        return view('Admin.Admin_CheckSheets.Pagination_Checksheet', compact('checksheets', 'checkforms', 'total'))->render();
    }

    // Search checksheet for admin
    public function Admin_Search_Checksheets(Request $request)
    {
        $total = Checksheets::count();
        $checksheets = checksheets::where('checksheet_name', 'LIKE', '%' . $request->search_string . '%')
            ->orderBy('created_at', 'desc')->paginate(8);
        if ($checksheets) {
            return view('Admin.Admin_CheckSheets.Pagination_Checksheet', compact('checksheets', 'total'))->render();
        } else {
            return response()->json([
                'status' => 'Nothing Found',
            ]);
        }
    }

    // Pagination checksheet for user
    public function User_Pagination_Checksheets(Request $request)
    {
        $checksheets = Checksheets::orderBy('created_at', 'desc')->paginate(9);
        $checkforms = Checkforms::orderBy('created_at', 'desc')->get();
        $total = Checksheets::count();

        return view('User.User_CheckSheets.Pagination_Checksheet_Index', compact('checksheets', 'checkforms', 'total'))->render();
    }

    // Search checksheet for user
    public function User_Search_Checksheets(Request $request)
    {
        $total = Checksheets::count();
        $checksheets = checksheets::where('checksheet_name', 'LIKE', '%' . $request->search_string . '%')
            ->orderBy('created_at', 'desc')->paginate(8);
        if ($checksheets) {
            return view('User.User_CheckSheets.Pagination_Checksheet_Index', compact('checksheets', 'total'))->render();
        } else {
            return response()->json([
                'status' => 'Nothing Found',
            ]);
        }
    }
}
