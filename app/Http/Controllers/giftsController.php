<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class giftsController extends Controller
{
    public function index()
    {
        $category = DB::table('category')->where('status', 1);
        return view('gifts.index', compact('category'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            if ($files = $request->file('cat_image')) {
                // Define upload path
                $destinationPath = public_path('/category_img/'); // upload path
                // Upload Orginal Image
                $cat_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $cat_image);

                $final_url = url('/') . '/category_img/' . $cat_image;

                $data['cat_image'] = $final_url;
            }
            $data['name'] = $request->name;
            DB::table('category')->insert($data);
            $category = DB::table('category')->where('status', 1)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Category Add Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $category]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function category_details(Request $request)
    {
        try {
            $category = DB::table('category')->where([['status', 1], ['id', $request->id]])->first();
            return json_encode($category);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            if ($files = $request->file('cat_image')) {
                // Define upload path
                $destinationPath = public_path('/category_img/'); // upload path
                // Upload Orginal Image
                $cat_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $cat_image);

                $final_url = url('/') . '/category_img/' . $cat_image;

                $data['cat_image'] = $final_url;
            }
            $data['name'] = $request->name;
            DB::table('category')->where('id', $request->cat_id)->update($data);
            $category = DB::table('category')->where([['status', 1], ['id', $request->cat_id]])->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Category update Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $category]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('category')->where('id', $request->id)->update($data);
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
            DB::table('category')->where('status', '1')->update($data);
            if ($request->device == 'web') {
                echo 'done';
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => true]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function isTopToggle(Request $request)
    {
        try {
            $data['is_top'] = $request->status;
            DB::table('category')->where('id', $request->id)->update($data);
            if ($request->device == 'web') {
                echo $request->status;
            } else {
                return response()->json(['status' => true, 'message' => "success", "result" => true]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function gifts()
    {
        $gifts = DB::table('gifts')->where('status', 1);
        $categorys = DB::table('category')->where('status', 1)->orderBy('id', 'desc')->get();
        return view('gifts.gift', compact('categorys', 'gifts'));
    }

    public function gift_store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'coin' => 'required',
                'cat_id' => 'required'
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            if ($files = $request->file('icon')) {
                // Define upload path
                $destinationPath = public_path('/gifts_img/'); // upload path
                // Upload Orginal Image
                $gift_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $gift_image);

                $final_url = url('/') . '/gifts_img/' . $gift_image;

                $data['icon'] = $final_url;
            }
            $data['coin'] = $request->coin;
            $data['cat_id'] = $request->cat_id;
            $id = DB::table('gifts')->insertGetId($data);
            $gifts = DB::table('gifts')->where('id', $id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Gifts Add Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $gifts]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function gift_details(Request $request)
    {
        try {
            $gifts = DB::table('gifts')->where('id', $request->id)->first();
            return json_encode($gifts);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function gift_update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'coin' => 'required',
                'cat_id' => 'required'
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            if ($files = $request->file('icon')) {
                // Define upload path
                $destinationPath = public_path('/gifts_img/'); // upload path
                // Upload Orginal Image
                $gift_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $gift_image);

                $final_url = url('/') . '/gifts_img/' . $gift_image;

                $data['icon'] = $final_url;
            }
            $data['coin'] = $request->coin;
            $data['cat_id'] = $request->cat_id;
            DB::table('gifts')->where('id', $request->gift_id)->update($data);
            $gifts = DB::table('gifts')->where('id', $request->gift_id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Gifts Update Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $gifts]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function gift_destroy(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('gifts')->where('id', $request->id)->update($data);
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

    public function gift_destroyAll(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('gifts')->where('status', '1')->update($data);
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
           $gift = DB::table('gifts')->where('status',1)->get();
           return $gift;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function cat_view(){
        try {
            $category = DB::table('category')->where('status',1)->get();
            return $category;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
