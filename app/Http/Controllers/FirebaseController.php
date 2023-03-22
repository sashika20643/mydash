<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;


use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Logging\LoggingClient;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseController extends Controller
{
    public function test(){

        $user=app('firebase.firestore')->database()->collection('users')->newDocument();

//         $firestore = Firebase::firestore();
//         $collection = $firestore->collection('users');
// $doc = $collection->newDocument();
$user->set([
    'name' => 'John Doe',
    'email' => 'john@example.com',
]);


    }

    public function fetch(){

        $user=app('firebase.firestore')->database()->collection('Users');
        $snapshot = $user->documents();
        foreach ($snapshot as $document) {

           return $document->data();
        }
    }


    public function disable(){
        $factory = (new Factory)
    ->withServiceAccount(__DIR__.'/middle-age-cam-live-firebase-adminsdk-nb9vu-7dc4c4f218.json');
        $auth = $factory->createAuth();
$user = $auth->getUser('fWMv3jB6rMVDRIgDFEeZMIpZnCF2');
// $user->disabled = true;
// $auth->updateUser($user->uid,["disabled" => true]);
return $user;
    }

    public function loginstatus(){

        $userHistory=app('firebase.firestore')->database()->collection('Users')->document('fWMv3jB6rMVDRIgDFEeZMIpZnCF2')->collection('login-history')->orderBy('timestamp', 'DESC')->limit(10)->documents();;


$history = [];
foreach ($userHistory as $doc) {
    $history[] = $doc->data();
}

return $history;
    }


    public function pushnotification(){



// create a new instance of the logging client
$logging = new LoggingClient([
    'projectId' => 'middle-age-cam-live',
]);
$logName = 'projects/middle-age-cam-live/logs/firebaseauth.googleapis.com%2Fauthentication';
$log = $logging->service()->log($logName);

// create a new query to retrieve the login history for a specific user
$query = 'resource.type="audited_resource" '
    . 'AND resource.labels.method_name="google.firebase.auth.FirebaseAuth.SignInWithEmailAndPassword" '
    . 'AND protoPayload.authenticationInfo.principalEmail="savinkisunu@gmail.com"';

// execute the query and retrieve the results
$results = $log->entries([
    'pageSize' => 1000,
    'orderBy' => 'timestamp desc',
    'filter' => $query,
]);

// iterate over the results and display the login history for the user
foreach ($results as $result) {
    $time = $result->timestamp()->format('Y-m-d H:i:s');
    echo 'User logged in at ' . $time . "\n";
}
// // retrieve a reference to the Firebase Authentication log
// $log = $logging->log('firebase-authentication.googleapis.com');

// // create a new query to retrieve the login history for a specific user
// $query = 'resource.type="audited_resource" '
//     . 'AND resource.labels.method_name="google.firebase.auth.FirebaseAuth.SignInWithEmailAndPassword" '
//     . 'AND protoPayload.authenticationInfo.principalEmail="savinkisunu@gmail.com"';

// // execute the query and retrieve the results
// $results = $log->entries([
//     'pageSize' => 1000,
//     'orderBy' => 'timestamp desc',
//     'filter' => $query,
// ]);

// // iterate over the results and display the login history for the user
// foreach ($results as $result) {
//     $time = $result->timestamp()->format('Y-m-d H:i:s');
//     echo 'User logged in at ' . $time . "\n";
// }


    //     $serviceAccount = ServiceAccount::fromValue(__DIR__.'/middle-age-cam-live-firebase-adminsdk-nb9vu-7dc4c4f218.json');



    //         $firebase = (new Factory)
    //         ->withServiceAccount($serviceAccount);


    //         $users = $firebase->getAuth()->listUsers();

    //         foreach ($users as $user) {
    //             echo 'User ' . $user->uid . ' last signed in at ' . $user->metadata->lastSignInTime . "\n";


    // }
}

public function push(){
    $factory = (new Factory)->withServiceAccount(__DIR__.'/middle-age-cam-live-firebase-adminsdk-nb9vu-7dc4c4f218.json');
$messaging = $factory->createMessaging();

// Get the FCM tokens for the specified users from Firestore
$userIds = ['user1', 'user2', 'user3'];
$tokens = 'eFzWHRTFTcyWcsE20pqGMo:APA91bGnT3DnVUWSBenQXjTG0PrqAo6jnCAdrb-KplorNmR2OMT_mlO2mWg6iQ5HJwkJjMHPoHQs4lOs8NTBYAZgtJGMnEJ_TZ02rOTLhp1IvoEOt8hNM3ARcYXqJKmdeda6ldBEtS7h';
// $collection = $factory->createFirestore()->collection('users');
// foreach ($userIds as $userId) {
//     $document = $collection->document($userId)->snapshot();
//     $tokens[] = $document->data()['fcm_token'];
// }

// Send a notification to each user's FCM token
$message = CloudMessage::withTarget('token', $tokens)
    ->withNotification(Notification::create('Title', 'Message'));
    // $messaging->send($message);

try {
    //code...
    $messaging->send($message);
return "sended successfully";
} catch (\Throwable $th) {
    return "error";
    //throw $th;
}
}

}


