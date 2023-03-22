<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class stickerController extends Controller
{
    public function index()
    {
        $sticker = DB::table('sticker')->where('status', 1);
        return view('sticker.index', compact('sticker'));
    }

    public function store(Request $request)
    {
        try {
            if ($files = $request->file('sticker_img')) {
                // Define upload path
                $destinationPath = public_path('/sticker_img/'); // upload path
                // Upload Orginal Image
                $emoji_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $emoji_image);

                $final_url = url('/') . '/sticker_img/' . $emoji_image;

                $data['sticker_img'] = $final_url;
            }

            $id = DB::table('sticker')->insertGetId($data);
            $emoji = DB::table('sticker')->where('id', $id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Emoji Add Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $emoji]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function details(Request $request)
    {
        try {
            $sticker = DB::table('sticker')->where('id', $request->id)->first();
            return json_encode($sticker);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request)
    {
        try {
            if ($files = $request->file('sticker_img')) {
                // Define upload path
                $destinationPath = public_path('/sticker_img/'); // upload path
                // Upload Orginal Image
                $emoji_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $emoji_image);

                $final_url = url('/') . '/sticker_img/' . $emoji_image;

                $data['sticker_img'] = $final_url;
            }

            DB::table('sticker')->where('id', $request->sticker_id)->update($data);
            $sticker = DB::table('sticker')->where('id', $request->sticker_id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Sticker Updated Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $sticker]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('sticker')->where('id', $request->id)->update($data);
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
            DB::table('sticker')->where('status', '1')->update($data);
            if ($request->device == 'web') {
                echo 'done';
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => true]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function view(){
        try {
            $sticker = DB::table('sticker')->where('status',1)->get();
            return $sticker;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
