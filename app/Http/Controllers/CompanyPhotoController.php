<?php

namespace App\Http\Controllers;

use App\Models\CompanyPhoto;
use App\Http\Requests\StoreCompanyPhotoRequest;
use App\Http\Requests\UpdateCompanyPhotoRequest;
use Illuminate\Support\Facades\Storage;

class CompanyPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imgs  = CompanyPhoto::all();
        // dd($imgs);

        if( $imgs != null){
            return success($imgs, "Success", 200);
        }

        return error([], "No images found", 404);
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

        if( $request->file( 'files')){
            foreach( $request->file('files') as $key => $file){
                $path = $file->store('public/images/company');
                // dd($path);
                $save = new CompanyPhoto();
                $save->user_id = $request->user_id;
                $save->company_id = $request->company_id;
                $save->review_id = $request->review_id;
                $save->file_path = "/storage/{$path}";
                $save->caption = $request->caption;
                $save->tags = $request->tags;
                $save->category = $request->category;
                $save->save();
            }
            return success([], "Files Uploaded Successfully", 200);
        }
        return error([], "No files Attached", 404);
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
    public function destroy( $id)
    {
        $img = CompanyPhoto::find($id);
        
        if( $img != null){
            Storage::delete($img->file_path);
            $img->delete();
            return success([], "image deleted successfully", 200);
        }
        return error([], "Image not found", 404);
    }
}
