<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, Participant};

class EventsController extends Controller
{
    public function createEventPage() {
        return view('create-event');
    }

    public function create(Request $request) {
        $event = $request->validate([
            'title' => [
                            'required',
                            'unique:App\Models\Event,title'
                        ],
            'description' => 'required',
        ], [
            'title.required' => 'Поле заголовок является обязательным',
            'title.unique' => 'Событие с таким заголовком существует',
            'description.required' => 'Поле описание является обязательным',
        ]);

        $user = auth()->user();
        $event['user_id'] = $user->id;

        try {
            $event = Event::create($event);
            return redirect()->route('home')->with('success', 'Событие успешно создано.');
        }catch(\Exception $e){
            return redirect()->route('create-event')->withErrors(['Ошибка, событие не создано, попробуй ещё раз.']);
        }
    }

    public function getEventsList() {
        $data['all_events'] = Event::select('id','title')->orderBy('created_at')->get();

        $user = auth()->user();
        $data['my_events'] = Event::where('user_id',$user->id)->select('id','title')->orderBy('created_at')->get();
        
        return response()->json($data,200);
    }

    public function eventPage($id) {
        $event = Event::find($id);
        $event->date = mb_substr($event->created_at,0,10);
        $user = auth()->user();

        $is_participant = Participant::where('user_id',$user->id)->where('event_id',$id)->exists();
        return view('event',[
            'event'=>$event,
            'is_participant' => $is_participant,
        ]);
    }
}
