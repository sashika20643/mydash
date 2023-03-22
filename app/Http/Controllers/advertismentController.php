<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class advertismentController extends Controller
{
    public function index()
    {
        $advertisment = DB::table('advertisment')->where('status', 1);
        return view('advertisment.index', compact('advertisment'));
    }

    public function details(Request $request)
    {
        try {
            $avertisment = DB::table('advertisment')->where('id', $request->id)->first();
            return json_encode($avertisment);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request)
    {
        try {

            $data['title'] = $request->title;
            $data['intersitial_id'] = $request->intersitial_id;
            $data['reward_id'] = $request->reward_id;
            $data['native_id'] = $request->native_id;
            DB::table('advertisment')->where('id', $request->ad_id)->update($data);
            $advertisment = DB::table('advertisment')->where('id', $request->ad_id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Advertisment Updated Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $advertisment]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function lists(){
        $advertisment = DB::table('advertisment')->where('status',1)->get();
        return response()->json(['status' => true, 'message' => "success", $advertisment]);
    }


    public function is_active(Request $request)
    {
        try {
            $data['is_active'] = $request->status;
            DB::table('advertisment')->where('id', $request->id)->update($data);
            if ($request->device == 'web') {
                echo $request->status;
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => true]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
