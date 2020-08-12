<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('pages.companies.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.companies.create', ['route' => route('company.store')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $company = new Company();
        $company->name = $request->input('name');
        $company->save();

        return redirect()->route('company.index')->with('success', __('Successfully saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        return view('pages.companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     *
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $users = User::all();

        return view(
            'pages.companies.edit',
            [
                'company' => $company,
                'users'   => $users,
                'route'   => route(
                    'company.update',
                    [
                        'company' =>
                            $company->id,
                    ]
                ),
                'method'  => 'PUT',
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);
        $company = Company::find($id);
        $company->name = $request->input('name');
        $users = $request->input('users');
        if (count($users) > 0) {
            foreach ($users as $user) {
                $company->users()->attach($user);
            }
        }

        $company->save();

        return redirect()->route('company.index')->with('success', __('Successfully saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Company::destroy($id);

        return new Response();
    }
}
