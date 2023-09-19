<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use LdapRecord\Container;

class AdminController extends Controller
{
    // Grant Privillege for user
    public function Grant_Privillege(Request $request)
    {
        $username = $request->username;

        // Establish the LDAP connection
        $connection = Container::getDefaultConnection();

        // Validate username
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|unique:admins',
            ],
            [
                'username.required' => 'Please enter the username.',
                'username.unique' => 'This user already has admin privillege.'
            ]
        );

        // Error when validate fails 
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        // Search for the user in LDAP
        $ldapUser  = $connection->query()->where('samaccountname', '=', $username)->first();

        // User does not exist in LDAP
        if (!$ldapUser) {
            return response()->json([
                'error' => 'User does not exist on server.',
                'message' => 'The provided username does not exist in the LDAP server.'
            ]);
        }

        // Create user when exist
        if ($ldapUser) {
            if (empty($ldapUser['department'][0]) || empty($ldapUser['title'][0]) || empty($ldapUser['mail'][0])) {
                return response()->json([
                    'error' => "Can't grant privilege for this user."
                ]);
            }
            Admin::create([
                'username' => $ldapUser['samaccountname'][0],
                'first_name' => $ldapUser['givenname'][0],
                'last_name' => $ldapUser['sn'][0],
                'department' => $ldapUser['department'][0],
                'organize' => $ldapUser['title'][0],
                'email' => $ldapUser['mail'][0],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created in the database'
            ]);
        }
    }


    // Disallow admin privilege from user
    public function Disallow_Privillege(Request $request)
    {
        // Find user
        $username = $request->username;
        $disallow_username = Admin::find($username);

        // Delete from admin database
        if ($disallow_username) {
            $disallow_username->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'fail'
            ]);
        }
    }

    // Pagination for user table
    public function Import_Pagination(Request $request)
    {
        $users = User::orderBy('created_at', 'asc')->paginate(10);
        return view('Admin.Admin_Privillege.Pagination_Import_User', compact('users'))->render();
    }

    // Search user in user table
    public function Search_Users(Request $request)
    {
        $users = User::where('first_name', 'LIKE', '%' . $request->search_string . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->search_string . '%')
            ->orWhere('username', 'LIKE', '%' . $request->search_string . '%')
            ->orderBy('created_at', 'asc')->paginate(10);
        return view('Admin.Admin_Privillege.Pagination_Import_User', compact('users'))->render();
    }
}
