<?php

namespace App\Http\Controllers;

use App\Models\ThirdPartyUser;
use Illuminate\Http\Request;

class SyncController extends Controller
{

    public function syncUser(Request $request)
    {
        $request->validate([
            'admins' => ['array', 'nullable'],
            'users' => ['array', 'nullable'],
            '*.*.id' => ['required', 'string', 'max:255'],
            '*.*.name' => ['required', 'string', 'max:255'],
            '*.*.email' => ['required', 'string', 'email', 'max:255'],

        ]);
        foreach ($request->json('admins') as $admin) {
            $thirdPartyAdmin = ThirdPartyUser::findOrNew($admin['id']);
            $thirdPartyAdmin->id = $admin['id'];
            $thirdPartyAdmin->name = $admin['name'];
            $thirdPartyAdmin->email = $admin['email'];
            $thirdPartyAdmin->role = 'admin';
            $thirdPartyAdmin->save();
        }
        foreach ($request->json('users') as $user) {
            $thirdPartyUser = ThirdPartyUser::findOrNew($user['id']);
            $thirdPartyUser->id = $user['id'];
            $thirdPartyUser->name = $user['name'];
            $thirdPartyUser->email = $user['email'];
            $thirdPartyUser->role = 'user';
            $thirdPartyUser->save();
        }

        return response()->json('ok');
    }
}
