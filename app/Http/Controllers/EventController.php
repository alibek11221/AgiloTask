<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Shift;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::all();

        return view('pages.events.index')->with('events', $events);
    }

    public function create(Event $event = null)
    {
        $users = User::all();
        $companies = Company::all();
        $shifts = Shift::all();
        $params = ['users' => $users, 'companies' => $companies, 'shifts' => $shifts, 'route' => route('event.store')];
        if ($event !== null) {
            $params['event'] = $event;
        }
        return view(
            'pages.events.create',
            $params
        );
    }


    public function store(Request $request)
    {
        $validator = $this->setValidator($request);
        $event = $this->setValues($request, new Event());
        $validator->after(
            function ($validator) use ($event) {
                if ($this->shiftIsBusy($event)) {
                    $validator->errors()->add('shift', __('The shift is busy'));
                }
            }
        );
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->getMessageBag());
        }
        $event->save();
        return redirect()->route('event.index')->with('success', __('Successfully saved'));
    }

    private function setValidator(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'cost' => 'required',
                'type' => 'required',
                'shift' => 'required',
                'company' => 'required',
                'user' => 'required',
                'date' => 'required'
            ]
        );
    }

    private function setValues(Request $request, Event $event): Event
    {
        $event->name = $request->input('name');
        $event->cost = $request->input('cost');
        $event->type = $request->input('type');
        $event->date = $request->input('date');
        $event->company()->associate($request->input('company'));
        $event->user()->associate($request->input('user'));
        $event->shift()->associate($request->input('shift'));

        return $event;
    }

    private function shiftIsBusy(Event $event): bool
    {
        return Event::where('date', $event->date)->where('company_id', $event->company->id)->where(
                'shift_id',
                $event->shift->id
            )->count() > 0;
    }


    public function show($id)
    {
        $event = Event::find($id);

        return view('pages.events.show')->with('event', $event);
    }

    public function edit($id)
    {
        $event = Event::find($id);
        $users = User::all();
        $companies = Company::all();
        $shifts = Shift::all();
        return view(
            'pages.events.edit',
            [
                'users' => $users,
                'companies' => $companies,
                'shifts' => $shifts,
                'event' => $event,
                'route' => route('event.update', ['event' => $event->id]),
                'method' => 'PUT'
            ]
        );
    }


    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $validator = $this->setValidator($request);
        $this->setValues($request, $event);
        $validator->after(
            function ($validator) use ($event, $request) {
                if ($event->shift->id != $request->input('shift') && $this->shiftIsBusy($event)) {
                    $validator->errors()->add('shift', __('The shift is busy'));
                }
            }
        );
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->getMessageBag());
        }
        $event->save();
        return redirect()->route('event.index')->with('success', __('Successfully saved'));
    }


    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return new Request();
    }
}
