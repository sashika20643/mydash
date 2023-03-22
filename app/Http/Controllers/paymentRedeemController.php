<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class paymentRedeemController extends Controller
{
    public function index($id = null)
    {
        if ($id != null) {
            $data['pr_request'] = 1;
            DB::table('point_management')->where('id', $id)->update($data);
            $payment_detail = DB::table('point_management')->where('id', $id)->first();
            return view('payment_redeem.index', compact('payment_detail'));
        }
        else{
            $pending_pay_detail = DB::table('payment_redeem_request')->where('status', 1);
            return view('payment_redeem.index', compact('pending_pay_detail'));
        }
    }

    public function add_payment_redeem(Request $request)
    {
        try {
            $data11['pr_request'] = 0;
            DB::table('point_management')->where('id', $request->pm_id)->update($data11);
            $data['payment_amount'] = $request->payment_amount;
            $data['paid_day'] = $request->paid_day;
            $data['bank_name'] = $request->bank_name;
            $data['bank_account'] = $request->bank_account;
            $data['depositor'] = $request->depositor;
            $data['pm_id'] = $request->pm_id;
            DB::table('payment_redeem_request')->insert($data);
            echo 'done';
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
