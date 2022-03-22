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
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user != null) {
            return success($user);
        }

        return error([], "User not found", 404);
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
            return success([], "User Updated successfully");
        }

        return error([], "User not found", 404);
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

        if ($user != null) {
            if ($user->deleted_at == null) {
                return error([], "User is already de-activated", 304);
            } else {
                $user->delete();
                return success([], "User successfully de-activated");
            }
        }

        return error([], "User not found", 404);
    }

    public function reactivate($id)
    {
        $user = User::find($id);

        if ($user != null) {
            if ($user->deleted_at != null) {
                return success([], "User already activated", 304);
            } else {
                $user->deleted_at = null;
                $user->save();
                return success([], "User re-activated successfully");
            }
        }

        return error([], "User not found", 404);
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
            return success([], 'User deleted succesfully');
        }

        return error([], "User not found", 404);
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
            return success($user_reviews);
        }

        return error([], "User not found", 404);
    }
}
