<?php

namespace App\Http\Controllers;

use App\Events\StartVideoChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoChatController extends Controller
{
    //

    public function callUser(Request $request)
    {
        $data['userToCall'] = $request->user_to_call;
        $data['signalData'] = $request->signal_data;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';

        broadcast(new StartVideoChat($data))->toOthers();
    }
    public function endCall(Request $request)
    {
        $data['from'] = Auth::id();
        $data['type'] = 'endCall';

        broadcast(new StartVideoChat($data))->toOthers();
    }

    public function acceptCall(Request $request)
    {
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        broadcast(new StartVideoChat($data))->toOthers();
    }
}
