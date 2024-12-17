<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackEmailRequest;
use App\Http\Requests\FeedbackRequest;
use App\Jobs\FeedbackEmailJob;
use App\Models\FeedbackEmail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        return view('feedback.form', compact('user'));
    }

    public function sendFeedback(FeedbackRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated['name'] == "Super Admin" and $validated['email'] == "superadmin@demo.com") {
                $email = FeedbackEmail::first();
                $user = Auth::user()->roles;
                if (Auth::user()->roles->pluck('name') == '["Super Admin"]') {
                    $userEmail = $email ? $email->email : 'gijs.ros@marketingrocks.nl';
                } else {
                    $userEmail = $email ? $email->email : 'gijs.ros@marketingrocks.nl';
                }
                $data = array(
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'message' => $validated['message'],
                    'emailTo' => $userEmail
                );
                dispatch(new FeedbackEmailJob($data));

                return response()->json([
                    'success' => 200,
                    'message' => 'Feedback Sent Successfully',
                ], JsonResponse::HTTP_OK);
            } else {
                return response()->json([
                    'success' => 400,
                    'message' => 'Invalid Input.',
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function saveFeedbackEmail(FeedbackEmailRequest $request)
    {
        try {
            FeedbackEmail::updateOrCreate([
                'user_id' => Auth::user()->id,
            ], [
                'email' => $request->email,
            ]);
            return response()->json([
                'success' => 200,
                'message' => 'Feedback Email Saved Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
