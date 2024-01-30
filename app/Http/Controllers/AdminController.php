<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //------------- Admin Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (
            Auth::guard('admin')->attempt($credentials) && DB::table('admins')
            ->where('email', $request->email)
            ->value('status')    // check status of Admin
        ) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors('Your provided credentials do not match in our records.');
    }

    //------------- Admin Logout -------------//
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')
            ->withSuccess('You have logged out successfully!');
    }

    //------------- Admin Signup/Registration -------------//
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'mobile_no' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);

        $inserted = DB::table('admins')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
            'status' => 0,
            'city' => $request->city,
            'state' => $request->state,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('admin.login'))
                ->withSuccess('Your Account have been created successfully!');
        } else {
            return redirect(route('admin.register'));
        }
    }

    //------------- Admin Reset Password -------------//
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);
        if ($user = Admin::where('email', $request->email)->first()) {
            if (Hash::check($request->oldpassword, $user->password)) {
                $inserted = DB::table('admins')->update([
                    'password' => Hash::make($request->newpassword),
                ]);
                if ($inserted) {
                    return redirect(route('admin.login'))
                        ->withSuccess('Your Password have been Updated successfully!');
                }
                return redirect(route('admin.forgotpassword'))
                    ->withErrors('Failed to update Password.');
            }
            return redirect(route('admin.forgotpassword'))
                ->withErrors('Password does not Match.');
        }

        return redirect()->route('admin.forgotpassword')
            ->withErrors('User Not Exist.');
    }

    //------------- Centre Registeration -------------//
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'mobile_no' => 'required',
            'contact_person' => 'required',
            'contact_email' => 'required',
            'contact_no' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);
        $name = $request->name;
        $n =  strtoupper(substr($name, 0, 2));
        $city = $request->city;
        $c =  strtoupper(substr($city, 0, 2));
        $state = $request->state;
        $s =  strtoupper(substr($state, 0, 2));
        $id = $n . $c . $s;
        $t = DB::table('centres')->where('centre_id', 'like', $id)->count();
        $centre_id = $id . "000" . ++$t;

        $inserted = DB::table('centres')->insert([
            'centre_id' => $centre_id,
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
            'branch_id' => $centre_id . 'B001',
            'name' => 'default',
            'location' => 'default',
            'status' => 0,
            'centre_id' => $request->centre_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('admin.createcentre'))
                ->withSuccess('Account has created successfully!');
        }
    }

    //------------- Admin View All Branch -------------//
    public function viewbranch(Request $request)
    {
        if ($request->centre_id) {
            $branchs = DB::table('branches')
                ->join('centres', 'branches.centre_id', 'centres.centre_id')
                ->where('branches.centre_id', $request->centre_id)
                ->paginate(10, ['branches.*', 'centres.name as centre_name']);
            return view('admin.viewbranch', ['items' => $branchs]);
        }
        $branchs = DB::table('branches')
            ->join('centres', 'branches.centre_id', 'centres.centre_id')
            ->paginate(10, ['branches.*', 'centres.name as centre_name']);
        return view('admin.viewbranch', ['items' => $branchs]);
    }

    //-------------- Add Branch  ------------//
    public function addbranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|max:255',
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'centre_id' => 'required|max:255'
        ]);
        $inserted = DB::table('branches')->insert([
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'location' => $request->location,
            'status' => 0,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'centre_id' => $request->centre_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($inserted) {
            return redirect(route('admin.createbranch'))
                ->withSuccess('Branch have been Created successfully!');
        }
    }

    //------------- Admin View All Centres -------------//
    public function viewcentre()
    {
        $centres = DB::table('centres')->paginate(10);
        return view('admin.viewcentre', ['items' => $centres]);
    }

    //--------------Admin Dashboard ---------------//
    public function dashboard()
    {
        if (Auth::guard('admin')->check()) {
            $centres = DB::table('centres')->count();
            $branches = DB::table('branches')->count();
            $payments = DB::table('payments')->sum('amount');
            return view('admin.index', ['centres' => $centres, 'branches' => $branches, 'payments' => $payments]);
        }

        return redirect()->route('admin.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //--------------Admin Profile ---------------//
    public function profile()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::getUser();
            return view('admin.profile', $user);
        }

        return redirect()->route('admin.login')
            ->withErrors('Please login to access the dashboard.');
    }


    //------------- Admin View All Activity-------------//
    public function viewactivity()
    {
        $activity = DB::table('activitys')->paginate(10);
        return view('admin.viewactivity', ['items' => $activity]);
    }

    //------------- Admin View All Activity-------------//
    public function viewalocateactivity()
    {
        $activity = DB::table('activitys as a')
            ->join('activitylinks as al', 'a.id', '=', 'al.activity_id')
            ->join('centres as c', 'al.centre_id', '=', 'c.centre_id')
            ->paginate(10, ['a.image', 'a.type', 'a.name as a_name', 'c.centre_id', 'c.name']);
        return view('admin.viewalocateactivity', ['items' => $activity]);
    }


    //------------- Admin Create Activity-------------//
    public function createactivity()
    {
        return view('admin.createactivity');
    }

    //------------- Adding Activity -------------//
    public function addactivity(Request $request)
    {
        $destinationPath = 'images/activity/';
        $file = $request->file('image'); // will get all files
        $file_name = $file->getClientOriginalName(); //Get file original name
        $file->move($destinationPath, $file_name); // move files to destination folder
        $inserted = DB::table('activitys')->insert([
            'name' => $request->name,
            'type' => $request->type,
            'image' => $file_name,
        ]);

        if ($inserted) {
            return redirect(route('admin.createactivity'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('admin.createactivity'))
            ->withErrors('Failed to Create Course');
    }

    //------------- Admin alocate Activity-------------//
    public function alocateactivity()
    {
        $user = Auth::getUser();
        $activity = DB::table('activitys')->orderBy('name')->get();
        return view('admin.alocateactivity', ['items' => $activity]);
    }
    //------------- Adding alocate Activity -------------//
    public function addalocateactivity(Request $request)
    {
        $user = Auth::getUser();
        $inserted = DB::table('activitylinks')->insert([
            'centre_id' => $request->centre_id,
            'activity_id' => $request->activity_id,
        ]);

        if ($inserted) {
            return redirect(route('admin.alocateactivity'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('admin.alocateactivity'))
            ->withErrors('Failed to Create Course');
    }
    //------------- Admin View All Students -------------//
    public function viewstudent(Request $request)
    {
        if ($request->centre_id) {
            $students = DB::table('students')
                ->where('centre_id', $request->centre_id)
                ->paginate(10);
            return view('admin.viewstudents', ['items' => $students]);
        } else if ($request->branch_id) {
            $students = DB::table('students')
                ->where('branch_id', $request->branch_id)
                ->paginate(10);
            return view('admin.viewstudents', ['items' => $students]);
        } else if ($request->batch_id) {
            $students = DB::table('students as s')
                ->join('enrollments as e', 's.id', '=', 'e.student_id')
                ->where('e.batch_id', $request->batch_id)
                ->paginate(10);
            return view('admin.viewstudents', ['items' => $students]);
        }
        $students = DB::table('students')->paginate(10);
        return view('admin.viewstudents', ['items' => $students]);
    }

    //------------- Adding Banner -------------//
    public function addbanner(Request $request)
    {
        if ($request->hasFile('banner')) {
            $destinationPath = 'images/banner/';
            $file = $request->file('banner'); // will get all files
            $file_name = $file->getClientOriginalName(); //Get file original name
            $file->move($destinationPath, $file_name); // move files to destination folder
            DB::table('banners')->insert([
                'banner' => $file_name,
                'status' => $request->status,
                'type' => $request->type,
            ]);
            return redirect(route('admin.createbanner'))
                ->withSuccess('Your Banner have been Added successfully!');
        }
        return redirect(route('admin.createbanner'))
            ->withErrors('Failed to Add Banner');
    }

    //------------- Admin View Banner-------------//
    public function viewbanner()
    {
        $activity = DB::table('banners')->paginate(10);
        return view('admin.viewbanner', ['items' => $activity]);
    }
};
