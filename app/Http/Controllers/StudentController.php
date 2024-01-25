<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    //------------- Student Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors('Your provided credentials do not match in our records.');
    }

    //------------- Student Logout -------------//
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login')
            ->withSuccess('You have logged out successfully!');
    }

    //------------- Student Dashboard -------------//
    public function dashboard()
    {
        $user = Auth::getUser();
        $today = DB::table('attendance')->where('student_id', $user->id)
            ->where('date', date(today()))->count();
        $balance = $user->wallet_balance;
        $batch = DB::table('batches as b')
            ->join('enrollments as e', 'b.batch_id', 'e.batch_id')
            ->where('e.student_id', $user->id)->count();
        $total = DB::table('attendance')->where('student_id', $user->id)->count();
        $present = DB::table('attendance')->where('student_id', $user->id)
            ->where('status', '1')->count();
        $attendance = $present * 100 / ($total?:1);
        $fees = DB::table('enrollments')->where('student_id', $user->id)->sum('amount');
        return view('student.index', [
            'fees' => $fees,
            'batch' => $batch,
            'attendance' => $attendance,
            'balance' => $balance
        ]);
    }

    //------------- Student Profile -------------//
    public function profile()
    {
        if (Auth::guard('student')->check()) {
            $user = Auth::getUser();
            return view('student.profile', $user);
        }

        return redirect()->route('admin.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //------------- Wallet Balance -------------//
    public function wallet(Request $request)
    {
        $u_id = Auth::getUser();
        $user = Student::where('id', $u_id->id)->first();
        $balance = $user->wallet_balance;
        return view('student.wallet', ['balance' => $balance]);
    }

    //------------- Wallet Withdraw -------------//
    public function withdraw(Request $request)
    {
        $s_id = Auth::getUser();
        $enrolled = DB::table('enrollments')->where('student_id', $s_id->id)
        ->where('batch_id',$request->batch_id)->first();
        if($enrolled){
            return back()->withErrors('Already enrolled in this Batch/Course');
        }
        $user = Student::where('id', $s_id->id)->first();
        if ($user->wallet_balance < $request->amount) {
            return back()->withErrors('Low Balance in Your Wallet');
        }
        $user->withdraw($request->amount);
        enrollment::insert([
            'student_id' => $s_id->id,
            'batch_id' => $request->batch_id,
            'amount' => $request->amount,
            'date' => date(now())
        ]);
        return back()->withSuccess('Successfully Withdraw INR ' . $request->amount . ' from Wallet');
    }

    //------------- Student Attendance -------------//
    public function attendance()
    {
        $user = Auth::getUser();
        $attendance = DB::table('attendance')->where('student_id', $user->id)
            ->orderBy('date')->get();
        return view('student.attendance', ['attendance' => $attendance]);
    }


    //------------- Student fees -------------//
    public function fees()
    {
        $user = Auth::getUser();
        $fees = DB::table('enrollments as e')
            ->join('batches as b', 'e.batch_id', '=', 'b.batch_id')
            ->join('courses as c', 'b.course_id', '=', 'c.course_id')
            ->where('student_id', $user->id)
            ->select('title', 'name', 'amount', 'date')
            ->get();
        return view('student.fees', ['fees' => $fees]);
    }

    //------------- Student batch -------------//
    public function batch()
    {
        $user = Auth::getUser();
        $batches = DB::table('batches as b')
            ->join('courses as c', 'b.course_id', '=', 'c.course_id')
            ->join('enrollments as e', 'b.batch_id', '=', 'e.batch_id')
            ->where('e.student_id', $user->id)->get(['b.*', 'c.*']);
        // dd($batches);
        return view('student.mybatch', ['batches' => $batches]);
    }

    //------------- Notification -------------//
    public function notification()
    {
        $user = Auth::getUser();
        $general = DB::table('generalnotifications')->where('centre_id', $user->centre_id)->get();
        $batch = DB::table('enrollments')->where('student_id', $user->id)->first();
        $notis = DB::table('notifications')->where('batch_id', $batch?$batch->batch_id:'-1')->get();
        return view('student.notification', [
            'notification' => $notis,
            'general' => $general
        ]);
    }

    //------------- PayNow -------------//
    public function paynow1(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
        $data = [
            'amount' => $request->amount,
        ];
        return view('student.paynow1', $data);
    }

    //------------- All Courses -------------//
    public function viewcourse()
    {
        $user = Auth::getUser();
        $courses = DB::table('courses')
            ->where('branch_id', $user->branch_id)
            ->paginate(10);
        return view('student.viewcourse', ['items' => $courses]);
    }

    //------------- My Courses -------------//
    public function mycourse()
    {
        $user = Auth::getUser();
        $courses = DB::table('courses as c')
        ->join('batches as b', 'c.course_id', "=", 'b.course_id')
        ->join('enrollments as e', 'b.batch_id', '=', 'e.batch_id')
            ->where('student_id', $user->id)
            ->paginate(10);
        return view('student.viewcourse', ['items' => $courses]);
    }

    //------------- PayNow -------------//
    public function paynow(Request $request)
    {
        $course_id = $request->course_id;
        $user = Auth::getUser();
        $course = DB::table('courses')->where('course_id', $request->course_id)->first();
        $batch = DB::table('batches')->where('course_id', $request->course_id)->get();
        $data = [
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'batches' => $batch
        ];
        return view('student.paynow', $data);
    }

    //------------- Present mark in attendance -------------//
    public function present()
    {
        $user = Auth::getUser();
        $a = DB::table('attendance')->where('student_id', $user->id)
            ->where('date', date(today()))->first();
        if ($a) {
            return back()->withErrors("Your Today's Attendance Already Marked");
        }
        DB::table('attendance')->insert([
            'student_id' => $user->id,
            'date' => date(now()),
            'status' => 1,
        ]);
        return back()->withSuccess('Marked Present For ' . date(today()));
    }
}
