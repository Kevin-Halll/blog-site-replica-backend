<?php

namespace App\Http\Controllers;

use App\Models\UserPhoto;
use App\Http\Requests\StoreUserPhotoRequest;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;

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

        if ($file = $request->file('file')) {
            $path = $file->store('public/images/user');

            $img = UserPhoto::where('user_id', $request->user_id)->first();

            if( $img == null){
                //store  file into directory and db
                $save = new UserPhoto();
                $save->user_id = $request->user_id;
                $save->file_path= $path;
                $save->caption = $request->caption;
                $save->save();
                
                return response()->json([
                    "success" => true,
                    "message" => "File successfully uploaded",
                    "file" => $file
                ]);
            }

            //delete current photo
            Storage::delete($img->file_path);
            $img->delete();
  
            //store  file into directory and db
            $save = new UserPhoto();
            $save->user_id = $request->user_id;
            $save->file_path= $path;
            $save->caption = $request->caption;
            $save->save();
               
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
   
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
    public function destroy(UserPhoto $request, $id)
    {
        $img = UserPhoto::find($id);
        $file_path = $img->file_path;
        // dd($file_path);
        
        if( $img != null){
            Storage::delete($img->file_path);
            $img->delete();
            return success([], "image deleted successfully", 200);
        }
        return error([], "Image not found", 404);

    }
}
