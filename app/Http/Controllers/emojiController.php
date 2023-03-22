<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class emojiController extends Controller
{
    public function index()
    {
        $emoji = DB::table('emoji')->where('status',1);
        return view('emoji.index',compact('emoji'));
    }

    public function store(Request $request)
    {
        try {
            if ($files = $request->file('emoji_img')) {
                // Define upload path
                $destinationPath = public_path('/emoji_img/'); // upload path
                // Upload Orginal Image
                $emoji_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $emoji_image);

                $final_url = url('/') . '/emoji_img/' . $emoji_image;

                $data['emoji_img'] = $final_url;
            }

            $id = DB::table('emoji')->insertGetId($data);
            $emoji = DB::table('emoji')->where('id', $id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Emoji Add Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $emoji]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function details(Request $request){
        try {
           $emoji = DB::table('emoji')->where('id',$request->id)->first();
           return json_encode($emoji);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request)
    {
        try {
            if ($files = $request->file('emoji_img')) {
                // Define upload path
                $destinationPath = public_path('/emoji_img/'); // upload path
                // Upload Orginal Image
                $emoji_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $emoji_image);

                $final_url = url('/') . '/emoji_img/' . $emoji_image;

                $data['emoji_img'] = $final_url;
            }

            DB::table('emoji')->where('id',$request->emoji_id)->update($data);
            $emoji = DB::table('emoji')->where('id',$request->emoji_id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Emoji Updated Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $emoji]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('emoji')->where('id', $request->id)->update($data);
            if ($request->device == 'web') {
                echo 'done';
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => true]);
            }
            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroyAll(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('emoji')->where('status', '1')->update($data);
            if ($request->device == 'web') {
                echo 'done';
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => true]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function emoji_view(){
        try {
            $emoji = DB::table('emoji')->where('status',1)->get();
            return $emoji;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
