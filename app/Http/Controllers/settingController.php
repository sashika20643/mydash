<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class settingController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->where('id', 1)->first();
        $free_charge = DB::table('free_recharge')->where('status', 1)->get();
        $point_recharge = DB::table('point_recharge')->where('status', 1)->get();
        $big_event_point = DB::table('big_event_point')->where('status', 1)->get();
        $mvcp = DB::table('mvcp')->where('status', 1)->get();
        $vsp = DB::table('vsp')->where('status', 1)->get();
        return view('settings.index', compact('settings', 'free_charge', 'point_recharge', 'big_event_point', 'mvcp', 'vsp'));
    }

    public function store(Request $request)
    {
        try {
            DB::table('free_recharge')->where('status', 1)->delete();
            foreach ($request->free_recharge as $value) {
                if ($value != '') {
                    $data66['name'] = $value;
                    DB::table('free_recharge')->insert($data66);
                }
            }
            DB::table('point_recharge')->where('status', 1)->delete();
            foreach ($request->point_recharge as $key => $value1) {
                if ($value1 != '') {
                    $data77['name'] = $value1;
                    DB::table('point_recharge')->insert($data77);
                }
            }

            DB::table('big_event_point')->where('status', 1)->delete();
            foreach ($request->big_event_point as $key => $value2) {
                if ($value2 != '') {
                    $data88['name'] = $value2;
                    DB::table('big_event_point')->insert($data88);
                }
            }

            DB::table('mvcp')->where('status', 1)->delete();
            foreach ($request->mvcp as $key => $value3) {
                if ($value3 != '') {
                    $data99['name'] = $value3;
                    DB::table('mvcp')->insert($data99);
                }
            }

            DB::table('vsp')->where('status', 1)->delete();
            foreach ($request->vsp as $key => $value4) {
                if ($value4 != '') {
                    $data100['name'] = $value4;
                    DB::table('vsp')->insert($data100);
                }
            }


            if ($files = $request->file('big_event_image')) {
                // Define upload path
                $destinationPath = public_path('/big_events/'); // upload path
                // Upload Orginal Image
                $big_event_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $big_event_image);

                $big_final_url = url('/') . '/big_events/' . $big_event_image;

                $data['big_event_image'] = $big_final_url;
            }

            if ($files1 = $request->file('advertisment_image')) {
                // Define upload path
                $destinationPath = public_path('/ad_images/'); // upload path
                // Upload Orginal Image
                $ad_image = date('YmdHis') . '.' . $files1->getClientOriginalExtension();

                $files1->move($destinationPath, $ad_image);

                $ad_final_url = url('/') . '/ad_images/' . $ad_image;

                $data['advertisment_image'] = $ad_final_url;
            }

            $data['login_bonus'] = $request->login_bonus;
            $data['big_event'] = $request->big_event;
            $data['redeem_point_notice'] = $request->redeem_point_notice;
            $data['invitee_point_rate'] = $request->invitee_point_rate;
            $data['kwder'] = $request->kwder;
            $data['admob'] = $request->admob;
            $data['ald'] = $request->ald;
            $data['in_stream_add'] = $request->in_stream_add;
            $data['video'] = $request->video;
            $data['term_of_use'] = $request->term_of_use;
            $data['lbst'] = $request->lbst;
            $data['pihd'] = $request->pihd;
            $data['lsaw'] = $request->lsaw;
            $data['gpbs_android'] = $request->gpbs_android;
            $data['ppg_android'] = $request->ppg_android;
            $data['payonner_pg_android'] = $request->payonner_pg_android;
            $data['ios_bs'] = $request->ios_bs;
            $data['gpbs'] = $request->gpbs;
            $data['ppg'] = $request->ppg;
            $data['ppg_ios'] = $request->ppg_ios;
            $data['payoneer_pg_ios'] = $request->payoneer_pg_ios;

            DB::table('settings')->where('id', 1)->update($data);
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Setting Add Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success"]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
