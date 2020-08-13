<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $companies = Company::all();

        return view('pages.companies.index')->with('companies', $companies);
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        $users = User::all();
        return view('pages.companies.create', ['users' => $users, 'route' => route('company.store')]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, ['name' => 'required']);
        $company = new Company();
        $company->name = $request->input('name');
        $company->save();
        $users = $request->input('users');
        if (count($users) > 0) {
            $company->users()->attach($users);
        }
        $company->save();

        return redirect()->route('company.index')->with('success', __('Successfully saved'));
    }


    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $company = Company::find($id);

        return view('pages.companies.show')->with('company', $company);
    }


    public function edit($id)
    {
        $company = Company::find($id)->load('users');
        $users = User::all();
        return view(
            'pages.companies.edit',
            [
                'company' => $company,
                'users' => $users,
                'route' => route(
                    'company.update',
                    [
                        'company' =>
                            $company->id,
                    ]
                ),
                'method' => 'PUT',
            ]
        );
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, ['name' => 'required']);
        $company = Company::find($id);
        $company->name = $request->input('name');
        $users = $request->input('users') ?? [];
        $company->users()->sync($users);

        $company->save();

        return redirect()->route('company.index')->with('success', __('Successfully saved'));
    }


    /**
     * @param $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $company = Company::find($id);
        $company->users()->detach();
        $company->delete();
        return new Response();
    }
}
