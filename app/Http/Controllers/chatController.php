<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class chatController extends Controller
{
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'sender_id' => 'required',
                'receiver_id' => 'required',
                'message' => 'required',
                'topic' => 'required',
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            $sender_id = $request->sender_id;
            $receiver_id = $request->receiver_id;
            $message = $request->message;
            $topic = $request->topic;

            $check_sender = DB::table('users')->where('id', $sender_id);
            if (!$check_sender->exists()) {
                return response()->json(['status' => false, 'message' => 'sender user is not found']);
            }

            $check_reciever = DB::table('users')->where('id', $receiver_id);
            if (!$check_reciever->exists()) {
                return response()->json(['status' => false, 'message' => 'receiver user is not found']);
            }

            $data['sender_id'] = $request->sender_id;
            $data['receiver_id'] = $request->receiver_id;
            $data['message'] = $request->message;
            $data['topic'] = $request->topic;
            $id =  DB::table('chat')->insertGetID($data);
            $chat = DB::table('chat')->orWhere([['sender_id', $request->sender_id], ['receiver_id', $request->receiver_id]])->get();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $chat]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_old_Chat(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'topic' => 'required',
                'limit' => 'required',
            ]);

            if ($validator->fails()) {
                return  $validator->messages();
            }

            $list = [];
            $user_id = $request->user_id;
            $topic = $request->topic;
            $limit = $request->limit;

            $chat = DB::table('chat')
                ->where('topic', $topic)
                ->orWhere([['sender_id', $user_id], ['receiver_id', $user_id]])
                ->get();

            foreach ($chat as $value) {
                if ($request->user_id === $value->sender_id) {
                    $data1['message'] = $value->message;
                    $data1['topic'] = $value->topic;
                    $data1['flag'] = 1;
                    array_push($list, $data1);
                } else {
                    $data2['message'] = $value->message;
                    $data2['topic'] = $value->topic;
                    $data2['flag'] = 0;
                    array_push($list, $data2);
                }
            }
            return response()->json(['status' => true, 'message' => 'success', 'data' => $list]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
