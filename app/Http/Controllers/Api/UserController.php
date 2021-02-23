<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 新建User
        $user = new User;
        $user->name = $request->name;
        $user->save();

        // 新建UserProfile
        $profile = new UserProfile;
        $profile->user_id = $user->id;
        $profile->name = $user->name;
        $profile->open_id = $request->open_id;
        $profile->gender = $request->gender;
        $profile->avatar = $request->avatar;
        $profile->location = $request->location;

        $profile->save();

        // 返回创建的数据
        return new UserResource(User::with('profile')->find($user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::with('profile')->find($id));
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
        $user->name = $request->name;
        $user->save();

        $profile = UserProfile::where('user_id', $id)->first();
        $profile->name = $request->name;
        $profile->avatar = $request->avatar;
        $profile->location = $request->location;
        $profile->bio = $request->bio;
        $profile->sexual_pref = $request->sexual_pref;
        $profile->gender_id = $request->gender_id;
        $profile->gender_exp = $request->gender_exp;
        $profile->romantically_attracted_to = $request->romantically_attracted_to;
        $profile->interests = $request->interests;

        $profile->save();

        return new UserResource(User::with('profile')->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
