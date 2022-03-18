<?php

namespace App\Http\Controllers;

use App\Models\CompanyPhoto;
use App\Http\Requests\StoreCompanyPhotoRequest;
use App\Http\Requests\UpdateCompanyPhotoRequest;

class CompanyPhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreCompanyPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyPhoto $companyPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyPhoto $companyPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyPhotoRequest  $request
     * @param  \App\Models\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyPhotoRequest $request, CompanyPhoto $companyPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyPhoto $companyPhoto)
    {
        //
    }
}
