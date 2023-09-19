<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Checkforms;
use App\Models\Checklists;
use App\Models\Checksheets;
use App\Models\Fill_Input;
use App\Models\Fill_Lists;
use App\Models\Fill_Options;
use App\Models\Lists;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // Admin Index for view or manage all checksheet.
    public function CheckSheet_Index()
    {
        $user_organize = auth()->user()->organize;

        $checksheets = Checksheets::where('organize', '=', $user_organize)->orderBy('created_at', 'desc')->paginate(8);
        // $checksheets = Checksheets::orderBy('created_at', 'desc')->paginate(8);
        $total = Checksheets::where('organize', '=', $user_organize)->count();
        // $total = Checksheets::count();

        return view('Admin.Admin_CheckSheets.Checksheet_Index', compact('checksheets', 'total'));
    }

    // User Index for view all checksheet.
    public function CheckSheet_Index_User()
    {
        $user_organize = auth()->user()->organize;
        
        $checksheets = Checksheets::where('organize', '=', $user_organize)->orderBy('created_at', 'desc')->paginate(9);
        // $checksheets = Checksheets::orderBy('created_at', 'desc')->paginate(9);
        $total = Checksheets::where('organize', '=', $user_organize)->count();
        // $total = Checksheets::all()->count();

        return view('User.User_CheckSheets.Checksheet_Index', compact('checksheets', 'total'));
    }

    // Dashboard for view result from user
    public function Dashboard_Index($checksheet_name)
    {
        $todayDate = Carbon::today()->format('Y-m-d');
        $checkforms = Checkforms::where('checksheet_name', $checksheet_name)->orderBy('created_at', 'asc')->get();
        $fill_lists = Fill_Lists::all();
        $checklists = Checklists::orderBy('created_at', 'asc')->get();

        $usernameInputs = [];

        // Keep all user result in array
        foreach ($checkforms as $checkform) {

            $relevant_fill_lists = $fill_lists->where('checkform_organize', $checkform->checkform_organize);
            $inputs = Fill_Input::whereDate('created_at', $todayDate)->whereIn('form_fill_input', $relevant_fill_lists->pluck('form_fill_input'))->get();

            // Group the inputs by 'created_at' and store them in the $usernameInputs array
            foreach ($inputs->groupBy('created_at') as $date => $groupedInputs) {
                foreach ($groupedInputs as $input) {
                    $usernameInputs[$checkform->checkform_organize][] = $input;
                }
            }
        }

        // dd($usernameInputs);                  ให้ Dashboard ขึ้นแค่ของ Checksheet นั้นๆ
        // Get user check result in checkform type checklists
        $userchecks = Lists::join('check__inputs', 'lists.list_detail', '=', 'check__inputs.list_detail')
            ->select('lists.checklist_organize', 'lists.list_detail', 'check__inputs.status', 'check__inputs.comment', 'check__inputs.created_at')
            ->whereDate('check__inputs.created_at', '=', $todayDate)
            ->orderBy('created_at', 'asc')->get();

        return view('Admin.Admin_Dashboard.Dashboard_Index', compact('checklists', 'checkforms', 'userchecks', 'checksheet_name', 'usernameInputs', 'fill_lists'));
    }

    // Index for view user result in report form
    public function Export_Dashboard_Index($checksheet_name)
    {
        // Get this year and month
        $currentMonth = Carbon::today()->format('Y-m');

        // Get this month name
        $monthName = Carbon::now()->format('F');

        // Get this year
        $year = Carbon::now()->format('Y');

        // Get number in this month
        $daysInMonth = Carbon::now()->daysInMonth;

        // Get today date
        $todayDate = Carbon::today()->format('Y-m-d');

        $checklists = DB::table('checklists')->join('checkforms', 'checklists.checkform_organize', '=', 'checkforms.checkform_organize')
            ->where('checkforms.checksheet_name', $checksheet_name)
            ->orderBy('checklists.created_at', 'asc')->get();
        $checkform_inputs = DB::table('checkforms')->where('checksheet_name', $checksheet_name)->where('form_type', '=', 'fill_input')->orderBy('created_at', 'asc')->get();

        $lists = DB::table('lists')->orderBy('created_at', 'asc')->get();

        // Get all period if exist
        $check_periods = DB::table('fill__lists')
            ->join('fill__options', 'fill__lists.form_fill_input', '=', 'fill__options.form_fill_input')
            ->where('fill__lists.input_title', '=', 'Period');


        if ($check_periods) {
            $periods = DB::table('fill__lists')
                ->join('fill__options', 'fill__lists.form_fill_input', '=', 'fill__options.form_fill_input')
                ->where('fill__lists.input_title', '=', 'Period')
                ->orderBy('fill__options.created_at', 'asc')->get();
        }

        // Get all input from user (checkform type fill input)
        $fill_inputs = DB::table('fill__lists')
            ->join('fill__inputs', 'fill__lists.form_fill_input', '=', 'fill__inputs.form_fill_input')
            ->select('fill__lists.form_fill_input', 'fill__lists.input_title', 'fill__lists.checkform_organize', 'fill__inputs.input', 'fill__inputs.created_at')
            ->whereRaw("DATE_FORMAT(fill__inputs.created_at, '%Y-%m') = ?", [$currentMonth])
            ->orderBy('created_at', 'asc')->get();

        // dd($fill_inputs);
        $groupedData = [];

        // Keep all input from user to array
        foreach ($fill_inputs as $fill_input) {
            $created_at = $fill_input->created_at;
            $input_title = $fill_input->input_title;
            $form_fill_input = $fill_input->form_fill_input;

            // Extract day from created_at
            $day = intval(date('d', strtotime($created_at)));

            if (!isset($groupedData[$created_at])) {
                $groupedData[$created_at] = [];
            }

            if (!isset($groupedData[$created_at][$day])) {
                $groupedData[$created_at][$day] = [];
            }

            if (!isset($groupedData[$created_at][$day][$form_fill_input])) {
                $groupedData[$created_at][$day][$form_fill_input] = [];
            }
            if (!isset($groupedData[$created_at][$day][$form_fill_input][$input_title])) {
                $groupedData[$created_at][$day][$form_fill_input][$input_title] = [];
            }

            $groupedData[$created_at][$day][$form_fill_input][$input_title][] = $fill_input->input;
        }

        // Get all check from user (checkforms type checklists)
        $userchecks = DB::table('lists')
            ->join('check__inputs', 'lists.list_detail', '=', 'check__inputs.list_detail')
            ->select('lists.checklist_organize', 'lists.list_detail', 'check__inputs.status', 'check__inputs.comment', 'check__inputs.created_at')
            ->whereRaw("DATE_FORMAT(check__inputs.created_at, '%Y-%m') = ?", [$currentMonth])
            ->orderBy('created_at', 'asc')->get();

        return view('Admin.Admin_Dashboard.Export.Export_Dashboard_Index', compact('checklists', 'checkform_inputs', 'daysInMonth', 'lists', 'userchecks', 'periods', 'fill_inputs', 'groupedData', 'todayDate', 'checksheet_name', 'monthName', 'year'));
    }


    // Admin Index for view or manage all checkforms.
    public function Checkform_Index($checksheet_name)
    {
        $checksheet = Checksheets::find($checksheet_name);
        $checkforms = Checkforms::where('checksheet_name', '=', $checksheet_name)->orderBy('created_at', 'desc')->paginate(8);
        $fill_inputs = Fill_Lists::orderBy('created_at', 'desc')->get();
        $fill_options = Fill_Options::orderBy('created_at', 'desc')->get();
        $total = Checkforms::where('checksheet_name', '=', $checksheet_name)->count();

        return view('Admin.Admin_Checkforms.Checkform_Index', compact('checkforms', 'checksheet_name', 'fill_inputs', 'fill_options', 'total', 'checksheet'));
    }

    // User Index for user view all checkforms.
    public function Checkform_Index_User($checksheet_name)
    {
        $checkforms = Checkforms::where('checksheet_name', '=', $checksheet_name)->orderBy('created_at', 'desc')->paginate(9);
        $fill_lists = Fill_Lists::orderBy('created_at', 'desc')->get();
        $fill_options = Fill_Options::orderBy('created_at', 'desc')->get();
        $total = Checkforms::where('checksheet_name', '=', $checksheet_name)->count();

        return view('User.User_Checkforms.Checkform_Index', compact('checkforms', 'checksheet_name', 'fill_lists', 'fill_options', 'total'));
    }

    // Admin checklist Index for view or manage all checklists.
    public function Checklist_Index($checksheet_name, $checkform_organize)
    {
        $checksheet = Checksheets::find($checksheet_name);
        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'asc')->paginate(8);
        $total = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'asc')->count();

        return view('Admin.Admin_Checklists.Checklist_Index', compact('checklists', 'checksheet_name', 'checkform_organize', 'total', 'checksheet'));
    }

    // User checklist Index for view all checklists.
    public function Checklist_Index_User($checksheet_name, $checkform_organize)
    {
        $checksheet = Checksheets::find($checksheet_name);
        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')->paginate(9);
        $total = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'desc')->count();

        return view('User.User_Checklists.Checklist_Index', compact('checklists', 'checksheet_name', 'checkform_organize', 'checksheet', 'total'));
    }

    // Admin lists index for view or manage all list for each checklists
    public function List_Index($checksheet_name, $checkform_organize, $checklist_organize)
    {
        $lists = Lists::where('checklist_organize', $checklist_organize)->orderBy('created_at', 'asc')->get();
        $list_count = Lists::orderBy('created_at', 'asc')->get();
        $checklists = Checklists::where('checkform_organize', '=', $checkform_organize)->orderBy('created_at', 'asc')->paginate(7);
        return view('Admin.Admin_Lists.List_Index', compact('lists', 'checksheet_name', 'checkform_organize', 'checklist_organize', 'checklists', 'list_count'));
    }

    // User lists index for view all lists
    public function List_Index_User($checksheet_name, $checkform_organize, $checklist_organize)
    {
        $lists = Lists::where('checklist_organize', $checklist_organize)->orderBy('created_at', 'desc')->paginate(8);
        $list_count = Lists::where('checklist_organize', $checklist_organize)->count();
        $checklists = Checklists::orderBy('created_at', 'desc')->paginate(7);
        return view('User.User_Lists.List_Index', compact('lists', 'checksheet_name', 'checkform_organize', 'checklist_organize', 'checklists', 'list_count'));
    }

    // Admin grants privilelge index for grant privilege to user
    public function Grant_Privillege_Index($checksheet_name)
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'desc')->get();
        return view('Admin.Admin_Privillege.Privillege_Index', compact('checksheet_name', 'admins', 'users'));
    }
}
