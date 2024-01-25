<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\branch;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
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

        if (Auth::guard('admin')->attempt($credentials) && DB::table('admins')
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
            'centre_id' => 'required',
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
            return redirect(route('admin.createcentre'))
                ->withSuccess('Account has created successfully!');
        }
    }

    //------------- Admin View All Branch -------------//
    public function viewbranch(Request $request)
    {
        if ($request->centre_id) {
            $branchs = DB::table('branches')
                ->where('centre_id', $request->centre_id)
                ->paginate(10);
            return view('admin.viewbranch', ['items' => $branchs]);
        }
        $branchs = DB::table('branches')
            ->paginate(10);
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

    
    //------------- Admin Create Activity-------------//
    public function createactivity()
    {
        $user = Auth::getUser();
        $activity = DB::table('activitys')->orderBy('name')->get();
        return view('admin.createactivity', ['items' => $activity]);
    }

    //------------- Adding Activity -------------//
    public function addactivity(Request $request)
    {
        $user = Auth::getUser();
        $inserted = DB::table('activitys')->insert([
            'activity_id' => $request->activity,
        ]);

        if ($inserted) {
            return redirect(route('admin.createactivity'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('admin.createactivity'))
            ->withErrors('Failed to Create Course');
    }

    //------------- Adding Activity -------------//
    public function alocateactivity(Request $request)
    {
        $user = Auth::getUser();
        $inserted = DB::table('activitylinks')->insert([
            'centre_id' => $request->centre_id,
            'activity_id' => $request->activity_id,
        ]);

        if ($inserted) {
            return redirect(route('admin.createactivity'))
                ->withSuccess('Your Course have been Created successfully!');
        }
        return redirect(route('admin.createactivity'))
            ->withErrors('Failed to Create Course');
    }
};
