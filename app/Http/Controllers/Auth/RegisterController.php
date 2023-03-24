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
            'password' => ['required', 'string', 'min:8'],
            'image'=>['required'],
            'username'=>['required'],
            'phone_number'=>['required'],
            'identity'=>['required'],
            'country'=>['required'],
            'role'=>['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)

    {$final_url="";

        if ($files = $request->file('image')) {
            // Define upload path
            $destinationPath = public_path('/user_images/'); // upload path
            // Upload Orginal Image
            $users_image = date('YmdHis') . '.' . $files->getClientOriginalExtension();

            $files->move($destinationPath, $users_image);

            $final_url = url('/') . '/user_images/' . $users_image;

         $data['image'] = $final_url;
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image'=>$final_url,
            'username'=>$data['username'],
            'phone_number'=>$datea['phone_number'],
            'identity'=>$datea['identity'],
            'country'=>$datea['country'],
            'role'=>$data['role'],
            'show_password'=>$data['password']

        ]);


    }
}
