<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckformController;
use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckSheetController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ListController;
use App\Models\Checkforms;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin Index
// Chceksheets index
Route::get('/admin', [HomeController::class, 'CheckSheet_Index'])->middleware('is_admin')->name('admin.checksheet');
// Dashboard Index
Route::get('/admin/dashboard/checklist/{checksheet_name}', [HomeController::class, 'Dashboard_Index'])->middleware('is_admin')->name('admin.dashboard');
// Export Index
Route::get('/admin-export/dashboard/checklist-server/{checksheet_name}', [HomeController::class, 'Export_Dashboard_Index'])->middleware('is_admin')->name('admin.export');
// Grant Privillege Index
Route::get('/admin/grant/{checksheet_name}', [HomeController::class, 'Grant_Privillege_Index'])->middleware('is_admin')->name('admin.grant-privillege-index');
// Checkform Index
Route::get('/admin/checkforms/{checksheet_name}', [HomeController::class, 'Checkform_Index'])->middleware('is_admin');
// Checklist Index
Route::get('/admin/checklists/{checksheet_name}/{checkform_name}', [HomeController::class, 'Checklist_Index'])->middleware('is_admin');
// Sub-List Index
Route::get('/admin/lists/{checksheet_name}/{checkform_name}/{checklist_name}', [HomeController::class, 'List_Index'])->middleware('is_admin');

// Checksheet Manage
// Add Checksheet
Route::post('/add-checksheet', [CheckSheetController::class, 'Create_Checksheet'])->middleware('is_admin')->name('admin.create-checksheet');
// Update Checksheet
Route::get('/update-checksheet', [CheckSheetController::class, 'Update_Checksheet'])->middleware('is_admin')->name('admin.update-checksheet');
// Delete Chceksheet
Route::get('/delete-checksheet', [CheckSheetController::class, 'Delete_Checksheet'])->middleware('is_admin')->name('admin.delete-checksheet');
// Pagination Checksheet
Route::get('/admin/checksheet/pagination/paginate-data', [CheckSheetController::class, 'Admin_Pagination_Checksheets'])->middleware('is_admin');
// Search Checksheet
Route::get('/admin/search-checksheet', [CheckSheetController::class, 'Admin_Search_Checksheets'])->middleware('is_admin')->name('admin.search-checksheets');

// Checkform Manage
// Create Checkform
Route::post('/create-checkform', [CheckformController::class, 'Create_Checkform'])->middleware('is_admin')->name('admin.create-checkform');
// Update Checkform
Route::get('/update-checkform', [CheckformController::class, 'Update_Checkform'])->middleware('is_admin')->name('admin.update-checkform');
// Delete Checkform
Route::get('/delete-checkform', [CheckformController::class, 'Delete_Checkform'])->middleware('is_admin')->name('admin.delete-checkform');
// Add Input to Checkform (checkform type fill input)
Route::post('/add-input-checkform', [CheckformController::class, 'Add_Input_Checkform'])->middleware('is_admin')->name('admin.add-input-checkform');
// Update Input Checkform (checkform type fill input)
Route::post('/update-input-checkform', [CheckformController::class, 'Update_Input_Checkform'])->middleware('is_admin')->name('admin.update-input-checkform');
// Delete Input from Checkform (checkform type fill input)
Route::get('/delete-input-checkform', [CheckformController::class, 'Delete_Input_Checkform'])->middleware('is_admin')->name('admin.delete-input-checkform');
// Delete options from Checkform (checkform type fill input input type select)
Route::get('/delete-option-checkform', [CheckformController::class, 'Delete_Option_Checkform'])->middleware('is_admin')->name('admin.delete-option-checkform');
// Delete options when change type in Checkform
Route::get('/delete-change-type', [CheckformController::class, 'Delete_Change_Type'])->middleware('is_admin')->name('admin.delete-change-type');
// Pagination Checkforms
Route::get('/admin/checkform/pagination/paginate-data', [CheckformController::class, 'Admin_Pagination_Checkforms'])->middleware('is_admin');
// Search Checkforms
Route::get('/admin/search-checkforms', [CheckformController::class, 'Admin_Search_Checkforms'])->middleware('is_admin')->name('admin.search-checkforms');

// Checklist Manage
// Create Checklist
Route::post('/create-checklist', [ChecklistController::class, 'Create_Checklist'])->middleware('is_admin')->name('admin.create-checklist');
// Update checklist
Route::get('/update-checklist', [ChecklistController::class, 'Update_Checklist'])->middleware('is_admin')->name('admin.update-checklist');
// Delete checklist
Route::get('/delete-checklist', [ChecklistController::class, 'Delete_Checklist'])->middleware('is_admin')->name('admin.delete-checklist');
// Pagination Checklists
Route::get('/admin/checklist/pagination/paginate-data', [ChecklistController::class, 'Admin_Pagination_Checklists'])->middleware('is_admin');
// Search Checklists
Route::get('/admin/search-checklists', [ChecklistController::class, 'Admin_Search_Checklists'])->middleware('is_admin')->name('admin.search-checklists');

// List Manage
// Create List 
Route::post('/create-list', [ListController::class, 'Create_List'])->middleware('is_admin')->name('admin.create-list');
// Update List 
Route::get('/update-list', [ListController::class, 'Update_List'])->middleware('is_admin')->name('admin.update-list');
// Delete List 
Route::get('/delete-list', [ListController::class, 'Delete_List'])->middleware('is_admin')->name('admin.delete-list');
// Delete selected List 
Route::delete('/delete-selected-list', [ListController::class, 'Delete_Selected_List'])->middleware('is_admin')->name('admin.delete-selected-list');
// Pagination Checklists in lists page
Route::get('/admin/checklist-list/pagination/paginate-data', [ListController::class, 'Admin_Pagination_Checklist_Lists'])->middleware('is_admin');
// Search Checklists in lists page
Route::get('/admin/search-checklist-lists', [ListController::class, 'Admin_Search_Checklist_Lists'])->middleware('is_admin')->name('admin.search-checklist-lists');

// Dashboard Manage
// Filter result from date from user
Route::get('/filter-checklists', [InputController::class, 'Date_Filter_Dashboard'])->middleware('is_admin')->name('admin.filter-dashboard');

// UserIndex
// Chceksheets index
Route::get('/user', [HomeController::class, 'CheckSheet_Index_User'])->name('user.checksheet');
// Pagination Checksheet
Route::get('/user/checksheet/pagination/paginate-data', [CheckSheetController::class, 'User_Pagination_Checksheets']);
// Search Checksheet
Route::get('/user/search-checksheets', [CheckSheetController::class, 'User_Search_Checksheets'])->name('user.search-checksheets');

// Checkforms Index
Route::get('/user/checkforms/{checksheet_name}', [HomeController::class, 'Checkform_Index_User']);
// Pagination Checkforms
Route::get('/user/checkforms/pagination/paginate-data', [CheckformController::class, 'User_Pagination_Checkforms']);
// Search Checkforms
Route::get('/user/search-checkforms', [CheckformController::class, 'User_Search_Checkforms'])->name('user.search-checkforms');

// Checklist Index
Route::get('/user/checklists/{checksheet_name}/{checkform_name}', [HomeController::class, 'Checklist_Index_User']);
// Pagination Checklists
Route::get('/user/checklist/pagination/paginate-data', [ChecklistController::class, 'User_Pagination_Checklists']);
// Search Checklists
Route::get('/user/search-checklists', [ChecklistController::class, 'User_Search_Checklists'])->name('user.search-checklists');

// Sub-List Index
Route::get('/user/lists/{checksheet_name}/{checkform_name}/{checklist_name}', [HomeController::class, 'List_Index_User']);
// Pagination Checklists in List page
Route::get('/user/checklist-list/pagination/paginate-data', [ListController::class, 'User_Pagination_Checklist_Lists']);
// Search Checklists in List page
Route::get('/user/search-checklist-lists', [ListController::class, 'User_Search_Checklist_Lists'])->name('user.search-checklist-lists');


// User Add Status (checkforms type checklists)
Route::post('/add-status', [InputController::class, 'Add_Checklist_Status'])->name('user.add-status');
// User Add Input (checkform type fill input)
Route::post('/add-input', [InputController::class, 'Add_Fill_Input'])->name('user.add-input');

// Export
// Export to PDF
Route::get('/generate-pdf-server/{checksheet_name}', [ExportController::class, 'generatePDF_Server'])->name('admin.export-pdf-server');
// Export To Excel
Route::get('/generate-excel-server/{checksheet_name}', [ExportController::class, 'generateExcel_Server'])->name('admin.export-excel-server');

// Admin Grant
// Grant privilege to user
Route::get('/grant-privillege', [AdminController::class, 'Grant_Privillege'])->middleware('is_admin')->name('admin.grant-privillege');
// Disallow privilege from user
Route::get('/disallow-privillege', [AdminController::class, 'Disallow_Privillege'])->middleware('is_admin')->name('admin.disallow-privillege');
// Pagination user 
Route::get('/admin/import-user/pagination/paginate-data', [AdminController::class, 'Import_Pagination'])->middleware('is_admin');
// Search user
Route::get('/admin/search-user', [AdminController::class, 'Search_Users'])->name('admin.search-users');