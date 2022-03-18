<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isActived = 1;
        return Company::where("is_active", $isActived)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "description" => "required|string",
            "email" => "required|string",
            "phone" => "required|string",
            "website" => "string|url",
            "menu_url" => "string|url",
            "category_ids" => "string",
            "amenities" => "string",
            "tags" => "string",
        ]);

        $company = Company::create([
            "name" => $request->name,
            "description" => $request->description,
            "email" => $request->email,
            "phone" => $request->phone,
            "website" => $request->website,
            "menu_url" => $request->menu_url,
            "category_ids" => $request->categor_ids,
            "amenities" => $request->amenities,
            "tags" => str($request->tags)->upper(),
        ]);


        return $company;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Company::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        try {
            $company->update($request->all());
            return response(['message' => 'item updated', 'status' => 200]);
        } catch (\Throwable $err) {
            if ($err->getMessage() == "Call to a member function update() on null") {
                return response(["message" => "Item with id {$id} not found", 'status' => 404], 404);
            }

            return response(['message' => 'we are experiencing some issues on our side', 'status' => 500, 'error' => $err->getMessage()], 500);
        }
    }

    /**
     * Deactive the specified resource from viewing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $company = Company::find($id);

        if ($company->is_active == 1) {
            return response(["message" => "item is already restored", "status" => 304], 304);
        }

        // Activate Company
        $company->is_active = 1;

        try {
            $company->save();
            return response(["message" => "item restored", "status" => 200]);
        } catch (\Throwable $error) {
            return response(["message" => "unable to restore item", "status" => 500, 'error' => $error->getMessage()], 500);
        }
    }

    /**
     * Deactive the specified resource from viewing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $company = Company::find($id);

        if ($company->is_active == 0) {
            return response(["message" => "item is already deactivated", "status" => 304], 304);
        }

        // Deactivate Company
        $company->is_active = 0;

        try {
            $company->save();
            return response(["message" => "item deactivated", "status" => 200]);
        } catch (\Throwable $error) {
            return response(["message" => "unable to deactivate item", "status" => 500, 'error' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $successfull = Company::destroy($id);

        if ($successfull) {
            return response(["message" => "item deleted", "status" => 200]);
        }

        return response(["message" => "unable delete item", "status" => 404], 404);
    }

    /**
     * Return a list of reviews for a particular index
     *
     * @return \Illuminate\Http\Response
     */
    public function reviews($id){
        $company_reviews = Company::find($id)->reviews;
        
        if( $company_reviews != null){
            return [$company_reviews, (["Message" => "Success", "status" => 200])];
        }

        return (["Message" => "Company not found", "status" => 404]);
    }
}
