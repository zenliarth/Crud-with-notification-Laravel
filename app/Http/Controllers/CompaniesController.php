<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\User;
use App\Notifications\CompanyInviteNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = User::where('role_id', 2)->get();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryCompanyRequest $request)
    {
        $user = User::create($request->validated() + ['role_id' => 2, 'password' => 'secret']);
        $url = URL::signedRoute('invitation', $user);
        $user->notify(new CompanyInviteNotification($url));
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(User $company)
    {

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, User $company)
    {
        $company->update($request->validated());

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }

    public function invitation(User $user){
        if(!request()->hasValidSignature() || $user->password != 'secret'){
            abort(401);
        }

        Auth::login($user);
        
        return redirect()->route('home');

    }
}
