<?php

namespace App\Http\Controllers;

use App\Models\centre;
use App\Models\payment;
use App\Models\Student;
use Exception;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    public function handlePayment(Request $request)
    {
        $input = $request->all();
        if (isset($input['student_id'])){
            $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            if (count($input) && !empty($input['razorpay_payment_id'])) {
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                        'amount' => $payment['amount']
                    ]);
                    payment::insert([
                        'user_id'=>$input['student_id'],
                        'user' => 'student',
                        'payment_id'=>$input['razorpay_payment_id'],
                        'amount'=>$payment['amount']/100,
                        'status'=>1
                    ]);
                    $s_id = $input['student_id'];
                    $user = Student::where('id', $s_id)->first();
                    $user->deposit($response->amount/100);
                    return redirect()->route('student.wallet')
                    ->withSuccess('Successfully Deposited INR '.$response->amount/100 .' to Wallet');
                } catch (Exception $e) {
                    Log::info($e->getMessage());
                    return back()->withError($e->getMessage());
                }
            }
            return redirect()->route('student.wallet')->withErrors([
                "error" => "Something went wrong in transaction."
            ]);
        } 
        elseif (isset($input['centre_id'])){
            $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            if (count($input) && !empty($input['razorpay_payment_id'])) {
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                        'amount' => $payment['amount']
                    ]);
                    payment::insert([
                        'user_id'=> $input['centre_id'],
                        'user' => 'centre',
                        'payment_id'=> $input['razorpay_payment_id'],
                        'amount'=> $payment['amount']/100,
                        'status'=> 1
                    ]);
                    $c_id = $input['centre_id'];
                    $user = centre::where('id', $c_id)->first();
                    $user->deposit($response->amount/100);
                    return redirect()->route('centre.wallet')
                    ->withSuccess('Successfully Deposited INR '.$response->amount/100 .' to Wallet');
                } catch (Exception $e) {
                    Log::info($e->getMessage());
                    return back()->withError($e->getMessage());
                }
            }
            return redirect()->route('centre.wallet')->withErrors([
                "error" => "Something went wrong in transaction."
            ]);
        }
    }
}
