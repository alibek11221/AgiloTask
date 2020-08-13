<?php

namespace App\Http\Controllers;

use App\Shift;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ShiftController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $shifts = Shift::all();

        return view('pages.shifts.index')->with('shifts', $shifts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('pages.shifts.create', ['route' => route('shift.store')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, ['name' => 'required']);
        $shift = new Shift();
        $shift->name = $request->input('name');
        $shift->save();

        return redirect()->route('shift.index')->with('success', __('Successfully saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $shift = Shift::find($id);

        return view('pages.shifts.show')->with('shift', $shift);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $shift = Shift::find($id);

        return view(
            'pages.shifts.edit',
            [
                'shift'  => $shift,
                'route'  => route(
                    'shift.update',
                    [
                        'shift' =>
                            $shift->id,
                    ]
                ),
                'method' => 'PUT',
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);
        $shift = Shift::find($id);
        $shift->name = $request->input('name');
        $shift->save();

        return redirect()->route('shift.index')->with('success', __('Successfully saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id): Response
    {
        Shift::destroy($id);

        return new Response();
    }
}
