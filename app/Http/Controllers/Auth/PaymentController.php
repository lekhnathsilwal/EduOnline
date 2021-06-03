<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Payment_request;

class PaymentController extends Controller
{
    public function payment_form()
    {
        return view('teacher.payment_request');
    }
    public function payment_store(Request $request, $user_id)
    {
        $this->validate($request,[
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required'
        ]);
        $payment = new Payment_request;
        $payment->bank_name = $request->input('bank_name');
        $payment->account_number = $request->input('account_number');
        $payment->account_holder = $request->input('account_holder');
        $payment->user_id = $user_id;
        $payment->save();
        return redirect('/posts')->with('success', 'payment requested successfully');
    }
}
