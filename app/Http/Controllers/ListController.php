<?php

namespace App\Http\Controllers;

use App\Models\Checklists;
use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
    // Create List
    public function Create_List(Request $request)
    {
        // Valiadate all input
        $validator = Validator::make(
            $request->all(),
            [
                'list_detail' => 'required|unique:lists',
            ],
            [
                'list_detail.required' => 'Please enter the list detail before creating.',
                'list_detail.unique' => 'The list detail has already been taken.'
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Create Lists into database
        Lists::create([
            'checklist_organize' => $request->checklist_organize,
            'list_detail' => $request->list_detail,
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // Update List
    public function Update_List(Request $request)
    {
        // Valiadate all input
        $validator = Validator::make(
            $request->all(),
            [
                'up_detail' => 'required|unique:lists,list_detail,' . $request->old_up_list_detail . ',list_detail',
            ],
            [
                'up_detail.required' => 'Please enter the list detail before updating.',
                'up_detail.unique' => 'The list detail has already been taken.'
            ]
        );

        // Error when validate fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Find list name and update
        Lists::where('list_detail', $request->old_up_list_detail)->update(
            [
                'list_detail' => $request->up_detail,
            ]
        );
        return response()->json([
            'status' => 'success'
        ]);
    }
    // Delete List
    public function Delete_List(Request $request)
    {
        // Find list name and delete
        Lists::where('list_detail', $request->del_list_id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    // Delete selected lists
    public function Delete_Selected_List(Request $request)
    {
        // Receive all lists id selected
        $ids = $request->ids;

        // Find all lists id and delete
        Lists::whereIn('list_detail', explode(",", $ids))->delete();
        return response()->json(['success' => "Check deleted successfully."]);
    }

    // Admin Pagination checklists in lists page
    public function Admin_Pagination_Checklist_Lists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;

        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')->paginate(7);
        return view('Admin.Admin_Lists.Pagination_Checklist_List', compact('checklists', 'checksheet_name', 'checkform_organize'))->render();
    }

    // Admin Search checklists in lists page
    public function Admin_Search_Checklist_Lists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checklist_organize = $request->checklist_organize;

        $lists = Lists::where('checklist_organize', $checklist_organize)->orderBy('created_at', 'desc')->paginate(8);

        $checklists = Checklists::with('lists')
            ->where(function ($query) use ($request) {
                $query->where('checklist_organize', 'LIKE', '%' . $request->search_string . '%');
            })
            ->orderBy('created_at', 'desc')->paginate(7);


        if ($checklists) {
            return view('Admin.Admin_Lists.Pagination_Checklist_List', compact('checklists', 'checksheet_name', 'checkform_organize', 'lists'))->render();
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nothing Found'
            ]);
        }
    }

    // User Pagination checklists in lists page
    public function User_Pagination_Checklist_Lists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checklist_organize = $request->checklist_organize;

        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')->paginate(7);
        return view('User.User_Lists.Pagination_Checklist_List', compact('checklists', 'checksheet_name', 'checkform_organize', 'checklist_organize'))->render();
    }

    // User Search checklists in lists page
    public function User_Search_Checklist_Lists(Request $request)
    {
        $checkform_organize = $request->checkform_organize;
        $checksheet_name = $request->checksheet_name;
        $checklist_organize = $request->checklist_organize;

        $lists = Lists::where('checklist_organize', $checklist_organize)->orderBy('created_at', 'desc')->paginate(8);


        $checklists = Checklists::with('lists')
            ->where(function ($query) use ($request) {
                $query->where('checklist_organize', 'LIKE', '%' . $request->search_string . '%');
            })
            ->orderBy('created_at', 'desc')->paginate(7);


        if ($checklists) {
            return view('User.User_Lists.Pagination_Checklist_List', compact('checklists', 'checksheet_name', 'checkform_organize', 'lists', 'checklist_organize'))->render();
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nothing Found',
            ]);
        }
    }
}
