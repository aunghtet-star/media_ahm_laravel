<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // update profile
    public function updateProfile(Request $request)
    {
        $validator = $this->profileValidation($request);

        $user = User::findOrFail($request->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // logger($user);

        return response()->json(["status" => 200, "message" => "Account have been updated!", "user" => $user]);
    }

    public function changePassword(Request $request)
    {
        $validator = $this->checkPasswordValidation($request);

        $dbUser = User::where('id', $request->user_id)->first();

        $dbPassword = $dbUser->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', $request->user_id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return response()->json(['successMessage'=>'Password has been changed']);
        }
        return response()->json(['failMessage'=>"Old Password does not match!"]);
    }

    private function profileValidation($request)
    {
        return Validator::make($request->all(), [
            'name'=>"required",
            "email"=>"required|email|unique:users,email,". $request->id,
        ])->validate();
    }

    // check password validation
    private function checkPasswordValidation($request)
    {
        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|same:newPassword|min:8|max:15',
        ])->validate();
    }
}
