<?php

namespace App\Http\Controllers;

use App\Models\UserPhoto;
use App\Http\Requests\StoreUserPhotoRequest;
use App\Http\Requests\UpdateUserPhotoRequest;

class UserPhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreUserPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPhotoRequest $request)
    {
        if(!$request->hasFile('fileName')){
            return error([], "File Upload not Found");
        }

        foreach($request->file('fileName') as $image){
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/imgs/user/', $name);
            dd($image);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(UserPhoto $userPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPhoto $userPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPhotoRequest  $request
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPhotoRequest $request, UserPhoto $userPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPhoto $userPhoto)
    {
        //
    }
}
