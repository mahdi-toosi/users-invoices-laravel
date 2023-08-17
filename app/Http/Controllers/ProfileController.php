<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('me.profile', ['user' => $user]);
    }

    public function updateMyProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {
            $userController = new UserController();
            $validatedData['avatar'] = $userController->uploadAvatarAndGetPath($request);
        }

        $mobileNumberIsUpdated = $request->mobile_number != $user->mobile_number;

        // Update the user
        $user->update($validatedData);

        if ($mobileNumberIsUpdated) {
            $user->update(['mobile_verified_at' => null]);
            auth()->user()->sendMobileVerificationNotification(true);
        }

        // Redirect to user list
        return redirect()->back();
    }

    public function updateMyPassword(Request $request)
    {
        $user = auth()->user();

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        if (! Hash::check($oldPassword, $user->password)) {
            return redirect()
                ->back()
                ->with('error', __('messages.Incorrect password. Please try again.'));
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()
            ->back()
            ->with('success', __('messages.Password changed successfully.'));
    }
}
