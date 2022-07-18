<?php

namespace App\Http\Controllers;

use App\Models\UserHobby;
use App\Http\Requests\StoreUserHobbyRequest;
use App\Http\Requests\UpdateUserHobbyRequest;

class UserHobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserHobbyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserHobbyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserHobby  $userHobby
     * @return \Illuminate\Http\Response
     */
    public function show(UserHobby $userHobby)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserHobby  $userHobby
     * @return \Illuminate\Http\Response
     */
    public function edit(UserHobby $userHobby)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserHobbyRequest  $request
     * @param  \App\Models\UserHobby  $userHobby
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserHobbyRequest $request, UserHobby $userHobby)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserHobby  $userHobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserHobby $userHobby)
    {
        //
    }
}
