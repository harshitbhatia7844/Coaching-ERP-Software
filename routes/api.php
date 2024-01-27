<?php

use App\Http\Controllers\StudentController;
use App\Models\Admin;
use App\Models\centre;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/get_student_api/{id?}', function ($id = NULL) {
    if($id){
        $state = Student::where('id', $id)->get();
        return response()->json($state);
    }
    $state = Student::get();
    return response()->json($state);
});

Route::get('/get_centre_api/{id?}', function ($id = NULL) {
    if($id){
        $state = centre::where('centre_id', $id)->get();
        return response()->json($state);
    }
    $state = centre::get();
    return response()->json($state);
});

Route::get('/get_admin_api/{id?}', function ($id = NULL) {
    if($id){
        $state = Admin::where('id', $id)->get();
        return response()->json($state);
    }
    $state = Admin::get();
    return response()->json($state);
});

Route::get('/get_activity_api', function () {
    $state = DB::table('activitys')->get();
    return response()->json($state);
});

Route::get('/get_batch_api', function () {
    $state = DB::table('batches')->get();
    return response()->json($state);
});

Route::get('/get_branch_api', function () {
    $state = DB::table('branches')->get();
    return response()->json($state);
});

Route::get('/get_course_api', function () {
    $state = DB::table('courses')->get();
    return response()->json($state);
});

Route::get('/get_enrollment_api', function () {
    $state = DB::table('enrollments')->get();
    return response()->json($state);
});

