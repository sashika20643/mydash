<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class pointMangementController extends Controller
{
    public function index()
    {
        $point_management = DB::table('point_management')->where('status', 1);
        return view('point_management.index', compact('point_management'));
    }

    public function store(Request $request)
    {
        try {

            $user_detail = DB::table('users')->where('id', $request->user_id)->first();
            $partner_detail = DB::table('users')->where('id', $request->partner_id)->first();
            $trans_detail = DB::table('transaction_type')->where('id', $request->trans_id)->first();
            $total_balance = DB::table('point_management')->where('user_id', $request->user_id)->orderBy('id', 'desc')->first();
            $grand_balance = 0;
            $redeem_grand_balance = 0;
            if ($request->sum) {
                if ($total_balance) {
                    $grand_balance = $total_balance->balance + $request->sum;
                } else {
                    $grand_balance = 0 + $request->sum;
                }
            }
            if ($trans_detail->name == 'redeem request') {
                $grand_balance = $total_balance->balance - $request->point;
            }

            $data['trans_type'] = $trans_detail->name;
            $data['phone_number'] = $user_detail->phone_number;
            $data['user_id'] = $user_detail->id;
            $data['name'] = $user_detail->name;
            $data['invitee_ph'] = $request->invitee_ph;
            $data['invitee_name'] = $request->invitee_name;
            if (isset($partner_detail)) {
                $data['partner_id'] = $partner_detail->id;
                $data['partner_ph'] = $partner_detail->phone_number;
                $data['partner_name'] = $partner_detail->name;
            }
            $data['dates'] = date('y-m-d');
            $data['start_time'] = $request->start_time;
            $data['end_time'] = $request->end_time;
            $data['period'] = $request->period;
            $data['debit'] = $request->point;
            $data['credit'] = $request->sum;
            $data['balance'] = $grand_balance;
            DB::table('point_management')->insert($data);
            if ($trans_detail->name == 'get video call') {
                $last_balance =  DB::table('point_management')->where('user_id', $request->partner_id)->orderBy('id', 'desc')->first();
                $final_balance = $last_balance->balance - $request->sum;
                $data11['trans_type'] = 'video call point deduction';
                $data11['phone_number'] = $partner_detail->phone_number;
                $data11['user_id'] = $request->partner_id;
                $data11['name'] = $partner_detail->name;
                $data11['invitee_ph'] = $request->invitee_ph;
                $data11['invitee_name'] = $request->invitee_name;
                if (isset($partner_detail)) {

                    $data11['partner_id'] = $request->partner_id;
                    $data11['partner_ph'] = $user_detail->phone_number;
                    $data11['partner_name'] = $user_detail->name;
                }
                $data11['dates'] = date('y-m-d');
                $data11['start_time'] = $request->start_time;
                $data11['end_time'] = $request->end_time;
                $data11['period'] = $request->period;
                $data11['debit'] = $request->sum;
                $data11['credit'] = 0;
                $data11['balance'] = $final_balance;
                DB::table('point_management')->insert($data11);
            }

            if ($trans_detail->name == 'message point') {
                $last_balance =  DB::table('point_management')->where('user_id', $request->partner_id)->orderBy('id', 'desc')->first();
                $final_balance = $last_balance->balance - $request->sum;
                $data11['trans_type'] = 'message point deduction';
                $data11['phone_number'] = $partner_detail->phone_number;
                $data11['user_id'] = $request->partner_id;
                $data11['name'] = $partner_detail->name;
                $data11['invitee_ph'] = $request->invitee_ph;
                $data11['invitee_name'] = $request->invitee_name;
                if (isset($partner_detail)) {

                    $data11['partner_id'] = $request->partner_id;
                    $data11['partner_ph'] = $user_detail->phone_number;
                    $data11['partner_name'] = $user_detail->name;
                }
                $data11['dates'] = date('y-m-d');
                $data11['start_time'] = $request->start_time;
                $data11['end_time'] = $request->end_time;
                $data11['period'] = $request->period;
                $data11['debit'] = $request->sum;
                $data11['credit'] = 0;
                $data11['balance'] = $final_balance;
                DB::table('point_management')->insert($data11);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filter_point(Request $request)
    {
        try {

            $start_date = date('y-m-d', strtotime($request->start_date));
            $end_date = date('y-m-d', strtotime($request->end_date));

            $filter_point = DB::table('point_management')->whereBetween('dates', [$start_date, $end_date]);
            return view('point_management.filter_point', compact('filter_point'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
