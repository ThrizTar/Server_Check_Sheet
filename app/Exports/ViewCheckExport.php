<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ViewCheckExport implements FromView
{
    private $checksheet_name; // Declare a private property to store the checksheet name

    public function __construct($checksheet_name)
    {
        $this->checksheet_name = $checksheet_name; // Store the checksheet name when the export class is instantiated
    }
    
    public function view(): View
    {
        $checksheet_name = $this->checksheet_name;
        
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

        // Data sent to view template
        $data = [
            'checklists' => $checklists,
            'checkform_inputs' => $checkform_inputs,
            'daysInMonth' => $daysInMonth,
            'lists' => $lists,
            'userchecks' => $userchecks,
            'periods' => $periods,
            'fill_inputs' => $fill_inputs,
            'groupedData' => $groupedData,
            'todayDate' => $todayDate,
            'monthName' => $monthName,
            'year' => $year

        ];

        return view('Admin.Admin_Dashboard.Export.Export_Dashboard', $data);
    }
}
