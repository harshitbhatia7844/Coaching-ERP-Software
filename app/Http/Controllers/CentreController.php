<?php

namespace App\Http\Controllers;

use App\Models\centre;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    //------------- Centre Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('centre')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('centre.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors('Your provided credentials do not match in our records.');
    }

    //------------- Centre Logout -------------//
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('centre.login')
            ->withSuccess('You have logged out successfully!');
    }

    //------------- Centre Signup -------------//
    public function signup(Request $request)
    {
        $request->validate([
            "name" => "required",
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'city' => 'required',
            'state' => 'required'
        ]);
        if (centre::where('email', $request->email)->first()) {
            return redirect()->route('centre.register')
                ->withErrors('User Already Exist.');
        }
        $inserted = DB::table('centres')->insert([
            'centre_id' => $request->centre_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'contact_person' => $request->contact_person,
            'contact_email' => $request->contact_email,
            'contact_no' => $request->contact_no,
            'city' => $request->city,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('branches')->insert([
            'branch_id' => $request->centre_id . '1001',
            'name' => 'default',
            'location' => 'default',
            'status' => 0,
            'centre_id' => $request->centre_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('centre.login'))
                ->withSuccess('Your Account have been created successfully!');
        } else {
            return redirect(route('centre.register'));
        }
    }

    //------------- Centre Reset Password -------------//
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);
        if ($user = centre::where('email', $request->email)->first()) {
            if (Hash::check($request->oldpassword, $user->password)) {
                $inserted = DB::table('centres')->update([
                    'password' => Hash::make($request->newpassword),
                ]);
                if ($inserted) {
                    return redirect(route('centre.login'))
                        ->withSuccess('Your Password have been Updated successfully!');
                }
                return redirect(route('centre.forgotpassword'))
                    ->withErrors('Failed to update Password.');
            }
            return redirect(route('centre.forgotpassword'))
                ->withErrors('Password does not Match.');
        }

        return redirect()->route('centre.forgotpassword')
            ->withErrors('User Not Exist.');
    }

    //------------- Centre Dashboard -------------//
    public function dashboard()
    {
        if (Auth::guard('centre')->check()) {
            $user = Auth::getUser();
            $balance = $user->wallet_balance;
            $branches = DB::table('branches')->where('centre_id', $user->centre_id)->count();
            $fees = DB::table('enrollments as e')
                ->join('batches', 'e.batch_id', 'batches.batch_id')
                ->join('courses as c', 'batches.course_id', 'c.course_id')
                ->join('branches as b', 'c.branch_id', 'b.branch_id')
                ->where('b.centre_id', $user->centre_id)
                ->sum('amount');
            $students = DB::table('enrollments')->count();
            return view('centres.index', ['students' => $students, 'branches' => $branches, 'fees' => $fees, 'balance' => $balance]);
        }

        return redirect()->route('centre.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //------------- Centre Profile -------------//
    public function profile()
    {
        if (Auth::guard('centre')->check()) {
            $user = Auth::getUser();
            return view('centres.profile', $user);
        }

        return redirect()->route('centre.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //------------- Adding students to branch -------------//
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'mobile_no' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);
        $user = Auth::getUser();
        $status = DB::table('branches')->where('id', $request->branch_id)->value('status');
        $no_of_students = DB::table('students')->where('branch_id', $request->branch_id)->count();

        if ($status || ($no_of_students < 10)) {
            DB::table('students')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile_no' => $request->mobile_no,
                'gender' => $request->gender,
                'city' => $request->city,
                'state' => $request->state,
                'centre_id' => $user->centre_id,
                'branch_id' => $request->branch_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return redirect(route('centre.viewstudents'));
        } else if ($no_of_students >= 10) {
            return back()->withErrors([
                'message' => "Buy a branch to add more than 10 students."
            ]);
        }
        return back()->withErrors([
            'message' => "Error."
        ]);
    }

    //------------- Adding New branch -------------//
    public function addbranch(Request $request)
    {
        $inserted = DB::table('branches')->insert([
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'location' => $request->location,
            'status' => 1,
            'centre_id' => $request->centre_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($inserted) {
            return redirect(route('centre.createbranch'))
                ->withSuccess('Your Branch have been Created successfully!');
        }
        return redirect(route('centre.viewbranch'));
    }

    //------------- PayNow -------------//
    public function paynow(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
            'location' => 'required',
        ]);
        $user = Auth::getUser();
        $data = [
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'location' => $request->location,
            'centre_id' => $user->centre_id,
            'price' => '1000',
        ];
        return view('centres.paynow', $data);
    }

    //------------- Centre View All Students -------------//
    public function viewstudent(Request $request)
    {
        if ($request->branch_id) {
            $students = DB::table('students')
                ->where('branch_id', $request->branch_id)
                ->paginate(10);
            return view('centres.viewstudents', ['items' => $students]);
        } else if ($request->batch_id) {
            $students = DB::table('students as s')
                ->join('enrollments as e', 's.id', '=', 'e.student_id')
                ->where('e.batch_id', $request->batch_id)
                ->paginate(10);
            return view('centres.viewstudents', ['items' => $students]);
        }
        $user = Auth::getUser();
        $students = DB::table('students')->where('centre_id', $user->centre_id)->paginate(10);
        return view('centres.viewstudents', ['items' => $students]);
    }

    //------------- Centre View All Branch -------------//
    public function viewbranch(Request $request)
    {
        $user = Auth::getUser();
        $branchs = DB::table('branches')->where('centre_id', $user->centre_id)->paginate(10);
        return view('centres.viewbranch', ['items' => $branchs]);
    }

    //------------- Wallet Balance  -------------//
    public function wallet(Request $request)
    {
        $c_id = Auth::getUser();
        $user = centre::where('id', $c_id->id)->first();
        $balance = $user->wallet_balance;
        return view('centres.wallet', ['balance' => $balance]);
    }

    //------------- Wallet Withdraw  -------------//
    public function withdraw(Request $request)
    {
        $c_id = Auth::getUser();
        $user = centre::where('id', $c_id->id)->first();
        if ($user->wallet_balance < $request->price) {
            return redirect()->route('centre.wallet')->withErrors('Low Balance in Your Wallet');
        }
        $user->withdraw($request->price);
        $inserted = DB::table('branches')->insert([
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'location' => $request->location,
            'status' => 1,
            'centre_id' => $request->centre_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('centre.createbranch'))
                ->withSuccess('Your Branch have been Created successfully!');
        }
        return redirect(route('centre.viewbranch'));
        // return back()->withSuccess('Successfully Withdraw INR 200 from Wallet');
    }

    //------------- Centre View All Courses -------------//
    public function viewcourse(Request $request)
    {
        $user = Auth::getUser();
        $courses = DB::table('courses')
            ->join('branches', 'courses.branch_id', '=', 'branches.branch_id')
            ->select('courses.*', 'branches.name as branch_name')
            ->where('branches.centre_id', $user->centre_id)
            ->paginate(10);
        return view('centres.viewcourse', ['items' => $courses]);
    }

    //------------- Adding New course -------------//
    public function addcourse(Request $request)
    {
        $user = Auth::getUser();
        $inserted = DB::table('courses')->insert([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'status' => 1,
            'branch_id' => $request->branch_id
        ]);

        if ($inserted) {
            return redirect(route('centre.createcourse'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('centre.createcourse'))
            ->withErrors('Failed to Create Course');
    }

    //------------- Centre View All Batches -------------//
    public function viewbatch(Request $request)
    {
        if ($request->course_id) {
            $batches = DB::table('batches')
                ->where('course_id', $request->course_id)
                ->paginate(10);
            return view('centres.viewbatch', ['items' => $batches]);
        }
        $user = Auth::getUser();
        $batches = DB::table('batches')
            ->join('courses', 'batches.course_id', '=', 'courses.course_id')
            ->join('branches', 'courses.branch_id', '=', 'branches.branch_id')
            ->where('branches.centre_id', $user->centre_id)
            ->select('batches.*')->paginate(10);
        return view('centres.viewbatch', ['items' => $batches]);
    }

    //------------- Adding New batch -------------//
    public function addbatch(Request $request)
    {
        $user = Auth::getUser();
        $inserted = DB::table('batches')->insert([
            'batch_id' => $request->batch_id,
            'name' => $request->name,
            'start_time' => $request->start_date,
            'end_time' => $request->end_date,
            'course_id' => $request->course_id,
            'status' => 1,
        ]);

        if ($inserted) {
            return redirect(route('centre.createbatch'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('centre.createbatch'))
            ->withErrors('Failed to Create Course');
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
        return view('centres.paynow1', $data);
    }

    //------------- Add Notification -------------//
    public function addnotification(Request $request)
    {
        if ($request->general) {
            $request->validate([
                'general' => 'required'
            ]);
            DB::table('generalnotifications')->insert([
                'centre_id' => Auth::getUser()->centre_id,
                'notification' => $request->general,
                'date' => date(now()),
            ]);
            return redirect(route('centre.createnotification'))
                ->withSuccess('Your Notification have been Created successfully!');
        }
        $request->validate([
            'batch_id' => 'required',
            'notification' => 'required'
        ]);
        DB::table('notifications')->insert([
            'batch_id' => $request->batch_id,
            'notification' => $request->notification,
            'date' => date(now()),
        ]);
        return redirect(route('centre.createnotification'))
            ->withSuccess('Your Notification have been Created successfully!');
    }

    //------------- Attendance -------------//
    public function attendance(Request $request)
    {
        if ($request->method() == 'POST') {
            $a = DB::table('attendance')->where('student_id', $request->student_id)
                ->where('date', date(today()))->first();
            if ($a) {
                return back()->withErrors('Already Marked');
            }
            $request->validate([
                'student_id' => 'required',
                'status' => 'required'
            ]);
            DB::table('attendance')->insert([
                'student_id' => $request->student_id,
                'date' => date(now()),
                'status' => $request->status,
            ]);
            return back()->withSuccess('Attendance have been Created successfully!');
        } elseif ($request->method() == 'GET') {
            if ($request->batch_id) {
                $students = DB::table('students as s')
                    ->join('enrollments as e', 's.id', '=', 'e.student_id')
                    ->where('e.batch_id', $request->batch_id)->get('s.*');
                return view('centres.attendance', compact('students'));
            }
            $students = DB::table('students as s')->where('id', 'shjbhtyg8875')->get();
            return view('centres.attendance', compact('students'));
        }
    }

    //------------- Notification -------------//
    public function notification()
    {
        $user = Auth::getUser();
        $general = DB::table('generalnotifications')->where('centre_id', $user->centre_id)->get();
        $notis = DB::table('notifications')->get();
        return view('centres.notification', [
            'notification' => $notis,
            'general' => $general
        ]);
    }

    //------------- Centre View All Activity-------------//
    public function viewactivity()
    {
        $user = Auth::getUser();
        $activity = DB::table('activitys as a')
            ->join('activitylinks as al', 'a.id', '=', 'al.activity_id')
            ->where('al.centre_id', $user->centre_id)->paginate(10);
        return view('centres.viewactivity', ['items' => $activity]);
    }

    
    //------------- Centre Create Activity-------------//
    public function createactivity()
    {
        $user = Auth::getUser();
        $activity = DB::table('activitys')->orderBy('name')->get();
        return view('centres.createactivity', ['items' => $activity]);
    }


    //------------- Adding Activity -------------//
    public function addactivity(Request $request)
    {
        $user = Auth::getUser();
        $inserted = DB::table('activitylinks')->insert([
            'centre_id' => $user->centre_id,
            'activity_id' => $request->activity_id,
        ]);

        if ($inserted) {
            return redirect(route('centre.createactivity'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('centre.createactivity'))
            ->withErrors('Failed to Create Course');
    }
}
