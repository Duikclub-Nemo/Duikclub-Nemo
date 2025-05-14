<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarStoreRequest;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Image\Exceptions\InvalidImageDriver;

class AvatarController extends Controller implements HasMiddleware
{

    /**
     * Uses middleware to handle permission in the controller.
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:avatar.store', only: ['store']),
            new Middleware('permission:avatar.delete', only: ['destroy']),
        ];
    }

    /**
     * Upload, crop and save avatar image
     * @throws InvalidImageDriver
     */
    public function store(AvatarStoreRequest $request)
    {
        $user = User::whereUuid($request->uuid)->first();
        $user = (new ImageService)->store($user, $request);
        $user->save();
    }

    /**
     * Delete avatar image
     * @return void
     */
    public function destroy(Request $request)
    {
        $user = User::whereUuid($request->uuid)->first();
        $user = (new ImageService)->destroy($user);
        $user->save();
    }

}
