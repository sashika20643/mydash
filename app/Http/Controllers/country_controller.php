<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class country_controller extends Controller
{
    public function index()
    {
        $country = DB::table('country')->where('status', 1);
        return view('country.index', compact('country'));
    }

    public function add_country(Request $request)
    {
        try {

            if ($request->file('country_image')) {

                if ($files = $request->file('country_image')) {
                    // Define upload path
                    $destinationPath = public_path('/country_images/'); // upload path
                    // Upload Orginal Image
                    $country_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                    $files->move($destinationPath, $country_image);

                    $final_url = url('/') . '/country_images/' . $country_image;

                    $data['country_img'] = $final_url;
                }

                $data['country'] = $request->country;
                DB::table('country')->insert($data);

                return redirect()->back()->with('message', 'Country Add Successfully');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {

            if ($request->file('country_image')) {

                if ($files = $request->file('country_image')) {
                    // Define upload path
                    $destinationPath = public_path('/country_images/'); // upload path
                    // Upload Orginal Image
                    $country_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                    $files->move($destinationPath, $country_image);

                    $final_url = url('/') . '/country_images/' . $country_image;

                    $data['country_img'] = $final_url;
                }

                $data['country'] = $request->country;
                $id = DB::table('country')->insertGetId($data);
                $country = DB::table('country')->where('id', $id)->get();
                if ($request->device == 'web') {
                    return redirect()->back()->with('message', 'Country Add Successfully');
                } else {
                    return response()->json(['status' => true, 'message' => "success", $country]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function get_country_details(Request $request)
    {
        $country = DB::table('country')->where([['status', 1], ['id', $request->id]])->first();
        return json_encode($country);
    }

    public function update(Request $request)
    {
        try {
            if ($files = $request->file('country_image')) {
                // Define upload path
                $destinationPath = public_path('/country_images/'); // upload path
                // Upload Orginal Image
                $country_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

                $files->move($destinationPath, $country_image);

                $final_url = url('/') . '/country_images/' . $country_image;

                $data['country_img'] = $final_url;
            }

            $data['country'] = $request->country;
            DB::table('country')->where('id', $request->country_id)->update($data);

            $country = DB::table('country')->where('id', $request->country_id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Country Add Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $country]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('country')->where('id', $request->id)->update($data);
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
            DB::table('country')->where('status', '1')->update($data);
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
            $country = DB::table('country')->where('status',1)->get();
            return $country;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
