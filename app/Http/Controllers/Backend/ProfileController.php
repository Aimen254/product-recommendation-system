<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\FeedbackEmail;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('users.edit_profile');
    }

    public function changePassword()
    {
        return view('users.change_password');
    }

    public function twoFactor()
    {
        return view('users.two_factor');
    }

    public function updatePersonalInfo(EditProfileRequest $request)
    {
        try {
            $user = User::where('uuid', auth()->user()->uuid)->firstOrFail();
            $currentImage = $user->profile_photo_path;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . $image->getClientOriginalName();
                $tmp_path = $image->storeAs('public/tmp', $filename);
                Storage::delete('public/images/' . $currentImage);
                Storage::move($tmp_path, 'public/images/' . $filename);
                $user->image = $filename;
            }
            User::where('uuid', auth()->user()->uuid)->update([
                'profile_photo_path' => $user->image
            ]);

            User::where('uuid', auth()->user()->uuid)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Profile updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $uuid = auth()->user()->uuid;
        $user = User::find($uuid);
        if ($request->new_password == $request->confirm_new_password) {
            User::where('uuid', $uuid)->update(['password' => Hash::make($request->new_password)]);
            return response()->json([
                'status' => 200,
                'message' => 'Password updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 433,
                'message' => 'Passwords do not match',
            ]);
        }
    }

    public function feedback()
    {
        $email = FeedbackEmail::first();
        $emailTo = $email ? $email->email : 'gijs.ros@marketingrocks.nl';
        return view('users.feedback', compact('emailTo'));
    }
}
