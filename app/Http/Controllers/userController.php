<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
use PhpParser\Node\Expr\FuncCall;
use PHPUnit\Framework\Constraint\JsonMatches;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;


use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Logging\LoggingClient;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class userController extends Controller
{
    public function signup(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required',
                'username' => 'required',
                'identity' => 'required',
                'country' => 'required',
                'role_id' => 'required',
                'password' => 'required',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            $settings = DB::table('settings')->where('id', 1)->first();
            $user = DB::table('users')->where('identity', $request->identity);

            if ($user->count() > 0) {
                $data1['isLogout'] = false;
                $data1['fcm_token'] = $request->fcmtoken;
                $user->update($data1);
                $user = DB::table('users')->where('fcm_token', $request->fcmtoken)->first();
                return response()->json(['status' => true, 'message' => "success", $user]);
            } else {
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


                if ($request->device == 'web') {
                    return redirect('/home');
                } else {
                    return response()->json(['status' => true, 'message' => "success", $user]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function index()
    {

$status=[];
        $user=app('firebase.firestore')->database()->collection('Users');
        $snapshot = $user->documents();
        $user=[];

        foreach ($snapshot as $document) {
            $factory = (new Factory)
            ->withServiceAccount(__DIR__.'/middle-age-cam-live-firebase-adminsdk-nb9vu-7dc4c4f218.json');
                $auth = $factory->createAuth();
                // return  $document->data()['uid'];
     if(   $userd = $auth->getUser($document->data()['uid'])){
if($userd->disabled){
    array_push($status,1);
}
else{
    array_push($status,0);
}
     }
            array_push($user, $document->data());

        }
        // return $status;
        // $user = DB::table('users')->where([['status', '=', 1], ['name', '!=', 'admin']]);
        return view('user.index', compact('user','status'));
    }

    public function all_users()
    {
        try {
            $role = DB::table('role')->where('status', 1)->get();
            $users = DB::table('users')->where('status', 1);
            return view('user.all_user', compact('users', 'role'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profile_details(Request $request)
    {
        try {

            $user = DB::table('users')->where([['status', 1], ['id', $request->id]])->first();
            return json_encode($user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profile_update(Request $request)
    {
        try {

            $data['name'] = $request->name;
            $data['role_id'] = $request->role_id;
            $data['password'] = Hash::make($request->password);
            $data['show_password'] = $request->password;
            DB::table('users')->where('id', $request->user_id)->update($data);
            $users = DB::table('users')->where('id', $request->user_id)->first();
            if ($request->device == 'web') {
                return redirect()->back()->with('message', 'Profile Updated Successfully');
            } else {
                return response()->json(['status' => true, 'message' => "success", $users]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data['status'] = 0;
            DB::table('users')->where('id', $request->id)->update($data);
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

    public function add_users(Request $request)
    {
        $role = DB::table('role')->where('status', 1)->get();
        return view('user.add_users', compact('role'));
    }

    public function save_user(Request $request)
    {
        try {
            $data['name'] = $request->name;
            $data['show_password'] = $request->password;
            $data['password'] = Hash::make($request->password);
            $data['role_id'] = $request->role_id;
            $id = DB::table('users')->insertGetId($data);
            $users = DB::table('users')->where('id', $id)->update($data);
            if ($request->device == 'web') {
                return redirect()->route('all-users');
            } else {
                return response()->json(['status' => true, 'message' => "success", $users]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function is_block(Request $request)
    {
        try {
            $factory = (new Factory)
            ->withServiceAccount(__DIR__.'/middle-age-cam-live-firebase-adminsdk-nb9vu-7dc4c4f218.json');
                $auth = $factory->createAuth();
        $user = $auth->getUser($request->id);
        if($request->status ==0){
            $auth->updateUser($user->uid,["disabled" => false]);
            return response()->json(['status' => true, 'message' => "success", "result" => true]);

        }
        else{
            $auth->updateUser($user->uid,["disabled" => true]);
            return response()->json(['status' => true, 'message' => "success", "result" => flase ]);

                }




        //     $data['isBlock'] = $request->status;
        //     DB::table('users')->where('id', $request->id)->update($data);

        //     if ($request->device == 'web') {
        //         echo $request->status;
        //     } else {
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function push_notification($id)
    {
        $user_doc = app('firebase.firestore')
        ->database()
        ->collection('Users')
        ->document($id)
        ->snapshot();

    if ($user_doc->exists()) {
        // User document exists, you can access its data using the $user_doc variable
        $token = $user_doc->data()['deviceToken'];
        // ...
    } else {
        // User document does not exist
        // ...
return "not found";
    }
        $factory = (new Factory)->withServiceAccount(__DIR__.'/middle-age-cam-live-firebase-adminsdk-nb9vu-7dc4c4f218.json');
        $messaging = $factory->createMessaging();

        // Get the FCM tokens for the specified users from Firestore
// return $user->data();
//         $tokens = $user->data()['deviceToken'];
//         return  $token;
        // $collection = $factory->createFirestore()->collection('users');
        // foreach ($userIds as $userId) {
        //     $document = $collection->document($userId)->snapshot();
        //     $tokens[] = $document->data()['fcm_token'];
        // }

        // Send a notification to each user's FCM token
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create('Title', 'Message'));
            // $messaging->send($message);

        try {
            //code...
            $messaging->send($message);
        return redirect()->back();
        } catch (\Throwable $th) {
            return "error";
            //throw $th;
        }
    }
}
