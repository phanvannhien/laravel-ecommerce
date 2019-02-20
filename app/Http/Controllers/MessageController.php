<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

use Auth;
use DB;
use App\Events\MessagePosted;

class MessageController extends Controller
{
    

    public function contact(){
        $user = Auth::user();
        $contacts = DB::table('contacts')
            ->join('users', 'contacts.contact_id', '=', 'users.id' )
            ->where('contacts.user_id', $user->id )          
            ->where('contacts.status', 2 )                       
            ->select('users.id','users.user_name','users.avatar')    
            ->get();

        return $contacts;
    }

    public function index(Request $request) {
       
    }

    public function store(Request $request) {

        $user = Auth::user();
        $conversation_id = 1;
        $message = $user->messages()->create([
            'message' => request()->get('message'),
            'user_id' => $user->id,
            'conversation_id' => $conversation_id
        ]);

        broadcast(new MessagePosted($message, $user, $conversation_id))->toOthers();

        return ['status' => 'OK'];
    }
}
