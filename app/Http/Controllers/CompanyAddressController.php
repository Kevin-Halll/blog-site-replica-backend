<?php

namespace App\Http\Controllers;

use App\Models\CompanyAddress;
use App\Http\Requests\StoreCompanyAddressRequest;
use App\Http\Requests\UpdateCompanyAddressRequest;

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
        $requestValues = [
            "company_id" => $request->company_id,
            "address_line_1" => $request->address_line_1,
            "address_line_2" => $request->address_line_2,
            "parish" => $request->parish,
            "city" => $request->city,
        ];

        return success(CompanyAddress::create($requestValues));
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
