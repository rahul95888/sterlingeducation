<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    /**
     * Save user feedback
     *
     * @param Request $request
     * @return json
     */
    public function postFeedback(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'message' => 'required|string',
        ]);

        $additional = [
            'success' => true,
            'message' => 'Feedback submitted successfully',
        ];

        $user = Auth::user();

        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        $feedback_uid = get_random_id('feedbacks', 'feedback_uid');

        $feedback = new Feedback();
        $feedback->feedback_uid = $feedback_uid;
        $feedback->unique_user_id = $user->unique_user_id;
        $feedback->user_type = $user->user_type;
        $feedback->rate = $request->rate;
        $feedback->message = $request->message;
        $feedback->save();

        return (new FeedbackResource($feedback))->additional($additional);
    }
}
