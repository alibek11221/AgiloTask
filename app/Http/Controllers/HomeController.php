<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Shift;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $my_date = date('d-m-Y');
        $week = date("W", strtotime($my_date)); // get week
        $year = date("Y", strtotime($my_date)); // get year
        $companies = Company::all();
        $events = Event::all();
        $shifts = Shift::all();
        $first_date = date("Y-m-d", strtotime($year . "W" . $week)); //first date
        $arrayOfDays[] = $first_date;
        for ($i = 1; $i < 7; $i++) {
            $arrayOfDays[] = date("Y-m-d", strtotime("+${i} day", strtotime($first_date)));
        }
        return view('pages.index', ['days' => $arrayOfDays, 'shifts' => $shifts,'companies'=>$companies]);
    }
}
