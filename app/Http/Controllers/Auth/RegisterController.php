<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        echo '<pre>';
        print_r($data);
        die;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        $user = DB::table('users')->where('identity', $data['identity']);

        if ($files = $request->file('image')) {
            // Define upload path
            $destinationPath = public_path('/user_images/'); // upload path
            // Upload Orginal Image
            $users_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

            $files->move($destinationPath, $users_image);

            $final_url = url('/') . '/user_images/' . $users_image;

            $data['image'] = $final_url;
        }

        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['identity'] = $request->identity;
        $data['fcm_token'] = $request->fcmtoken;
        $data['country'] = $request->country;
        $data['age'] = $request->age;
        $data['city'] = $request->city;
        $data['role_id'] = $request->role_id;
        $data['isHost'] = 0;
        $data['phone_number'] = $request->phone_number;
        $data['password'] = Hash::make($request->password);
        $data['show_password'] = $request->password;
        $data['coin'] = $settings->login_bonus;
        $data['rate'] = '';

        $id =  DB::table('users')->insertGetId($data);

        $user = DB::table('users')->where('id', $id)->first();

        return response()->json(['status' => true, 'message' => "success", $user]);
    }
}
