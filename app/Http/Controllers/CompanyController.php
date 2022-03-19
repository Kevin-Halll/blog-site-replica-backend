<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return success(Company::where("is_active", 1)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return success($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return success(Company::find($company->getKey()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company = Company::find($company->getKey());

        try {
            $updatedCompany = $company->update($request->validated());
            return success($updatedCompany);
        } catch (\Throwable $err) {
            if ($err->getMessage() == "Call to a member function update() on null") {
                return error("Item not found");
            }
            return error($err->getMessage());
        }
    }

    /**
     * Deactive the specified resource from viewing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Company $company)
    {
        $company = Company::find($company->getKey());

        if ($company->is_active == 1) {
            return success([], "Item already restored");
        }

        // Activate Company
        $company->is_active = 1;

        try {
            $company->save();
            return success();
        } catch (\Throwable $error) {
            return error($error->getMessage(), "unable to restore item");
        }
    }

    /**
     * Deactive the specified resource from viewing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Company $company)
    {
        $company = Company::find($company->getKey());

        if ($company->is_active == 0) {
            return success([], "item is already deactivated");
        }

        // Deactivate Company
        $company->is_active = 0;

        try {
            $company->save();
            return success([], "item deactivated");
        } catch (\Throwable $error) {
            return error($error->getMessage(), "unable to deactivate item");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $successfull = Company::destroy($company->getKey());

        if ($successfull) {
            return success([], "item deleted");
        }

        return error([], "unable delete item");
    }

    /**
     * Return a list of reviews for a particular index
     *
     * @return \Illuminate\Http\Response
     */
    public function reviews(Company $company)
    {
        $company_reviews = Company::find($company->getKey())->reviews;

        if ($company_reviews != null) {
            return success($company_reviews);
        }

        return error([], "Company not found");
    }

    /**
     * Return the address for a particular index
     *
     * @return \Illuminate\Http\Response
     */
    public function address(Company $company)
    {
        $company_address = Company::find($company->getKey())->address;

        if ($company_address != null) {
            return success($company_address);
        }

        return error([], "Company not found");
    }
}
