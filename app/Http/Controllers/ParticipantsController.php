<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, Participant, User};

class ParticipantsController extends Controller
{
    public function addParticipant(Request $request) {
        $user = auth()->user();
        $event = Event::find($request->event_id);

        if (!$user or !$event) {
            return response()->json(['message'=>'Плохие данные'], 400);
        }

        $participant = Participant::where('user_id',$user->id)->where('event_id',$event->id)->first();

        if ($participant) {
            return response()->json(['success'=>true], 200);
        }

        try {
            $res = Participant::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
            ]);

            if ($res) {
                return response()->json(['success'=>true], 200);
            }

            return response()->json(['success'=>false], 200);
        } catch(\Exception $e) {
            return response()->json(['message'=>$e,'success'=>false], 500);
        }
    }

    public function removeParticipant(Request $request) {
        $user = auth()->user();
        $event = Event::find($request->event_id);

        if (!$user or !$event) {
            return response()->json(['message'=>'Плохие данные'], 400);
        }

        $participant = Participant::where('user_id',$user->id)->where('event_id',$event->id)->first();

        if ($participant) {
            try {
                $participant->delete();
                return response()->json(['success'=>true], 200);
            } catch(\Exception) {
                return response()->json(['message'=>$e,'success'=>false], 500);
            }
        }
        response()->json(['success'=>true], 200);
    }

    public function getParticipantsList(Request $request) {
        $participants = Participant::where('event_id',$request->event_id)->get();
        $ids = [];
        foreach ($participants as $participant) {
            $ids[] = $participant->user_id;
        }
        $users = User::whereIn('id',$ids)->select('id','name','surname')->get();
        if ($users) {
            return response()->json(['success'=>true,'participants'=>$users],200);
        }
        
    }
}
