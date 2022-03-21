<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('is_active', 1)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Auth::user();

        // $user = User::find($id);



        // if($user != null){
        //     return $user;
        // } else {
        //     return ([ 'message' => 'user id not found',
        //                 'status' => 404]);
        // }
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
        $user = User::find($id);

        if ($user != null) {
            $user->update($request->all());
            return([ 'message' => 'User Updated successfully',
                        'status' => 200]);
        } else {
            return ([ 'message' => 'user id not found',
                        'status' => 404]);
        }
    }

    /**
     * Set the specified user as active
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $user = User::find($id);

        if ($user->is_active == 0) {
            return (['message' => 'User is already de-activated',
                'status' => 304]);
        } else {
            $user->is_active = 0;
            $user->save();

            return (['message' => 'user de-activated successfully',
                    'status' => 200]);
        }
    }

    public function reactivate($id)
    {
        $user = User::find($id);

        if ($user->is_active == 1) {
            return (['message' => 'User is already active',
                'status' => 304]);
        } else {
            $user->is_active = 1;
            $user->save();

            return (['message' => 'user re-activated successfully',
                    'status' => 200]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user != null) {
            User::destroy($id);
            return(['message' => 'User deleted succesfully',
                    'status' => 304]);
        } else {
            return (['message' => 'No user found', 'status' => 404]);
        }
    }

    /**
     * Return a list of reviews for a particular member
     *
     * @return \Illuminate\Http\Response
     */
    public function reviews($id)
    {
        $user_reviews = User::find($id)->reviews;

        if ($user_reviews != null) {
            // return [$user_reviews, (["Message" => "Success", "status" => 200])];
            return success($user_reviews);
        }

        return (["message" => "User not found", "status" => 404]);
    }
}
