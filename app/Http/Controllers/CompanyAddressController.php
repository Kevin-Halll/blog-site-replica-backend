<?php

namespace App\Http\Controllers;

use App\Models\CompanyAddress;
use App\Http\Requests\StoreCompanyAddressRequest;
use App\Http\Requests\UpdateCompanyAddressRequest;
use App\Models\Company;

class CompanyAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return success(CompanyAddress::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyAddressRequest $request)
    {
        if (Company::find($request->id)) {
            return success(CompanyAddress::create($request->validated()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyAddress  $companyAddress
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyAddress $companyAddress)
    {
        return success(CompanyAddress::find($companyAddress->getKey()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyAddressRequest  $request
     * @param  \App\Models\CompanyAddress  $companyAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyAddressRequest $request, CompanyAddress $companyAddress)
    {
        $companyAddress = CompanyAddress::find($companyAddress->getKey());
        $companyAddress->update($request->all());
        return success(CompanyAddress::find($companyAddress->getKey()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyAddress  $companyAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyAddress $companyAddress)
    {
        return CompanyAddress::destroy($companyAddress->getKey());
    }
}
