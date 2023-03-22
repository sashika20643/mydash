<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class livehostController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->where([['status', '=', 1], ['role_id', '!=', 2]]);
        return view('live_user.index', compact('user'));
    }

    public function enable_host(Request $request)
    {
        try {
            $msg = '';
            $data['isHost'] = $request->status;
            DB::table('users')->where('id', $request->user_id)->update($data);

            if ($request->status == 1) {
                $msg = 'Host is Enabled';
            } else {
                $msg = 'Host is Disabled';
            }

            if ($request->device == 'web') {
                echo $request->status;
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => $msg]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
