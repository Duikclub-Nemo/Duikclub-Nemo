<?php

namespace App\Http\Controllers;

use App\Models\FcmToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcmTokenController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'token' => 'required|string|max:255',
            'device_info' => 'nullable|string|max:255',
        ]);

        FcmToken::upsert(
            [
                'user_id' => Auth::user()->id,
                'token' => $validated['token'],
                'device_info' => $request->device_info,
            ],
            [
                'user_id',
                'token'
            ],
            [
                'device_info',
            ]
        );

        $deviceToken = FcmToken::where('token', $request->token)
            ->where('user_id', Auth::user()->id)
            ->first();

        return response()->json([
            'message' => 'Device token saved successfully',
            'token' => $deviceToken,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FcmToken $fcmToken): JsonResponse
    {
        $deleted = $fcmToken->delete();

        return response()->json([
            'message' => $deleted ? 'Device token removed successfully' : 'Token not found',
            'success' => (bool)$deleted,
        ], $deleted ? 200 : 404);

    }

}
