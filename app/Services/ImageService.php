<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\ImageDriver;
use Spatie\Image\Exceptions\InvalidImageDriver;
use Spatie\Image\Image;

class ImageService
{

    /**
     * Crop and Upload Avatar Image
     * @throws InvalidImageDriver
     */
    public function store(User $user, Request $request): User
    {
        // Delete current avatar if exists
        $this->destroy($user);

        // Crop and upload new Avatar
        $file = $request->file('avatar');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = 'avatars/' . $name;
        $storagePath = storage_path('app/public/' . $path);
        if (!file_exists(dirname($storagePath))) {
            mkdir(dirname($storagePath), 0755, true);
        }
        Image::useImageDriver(ImageDriver::Gd)
            ->loadFile($file)
            ->manualCrop($request->width, $request->height, $request->left, $request->top)
            ->resize(300, 300)
            ->save($storagePath);

        $user->avatar = $path;

        return $user;
    }

    /**
     * Delete Avatar Image
     */
    public function destroy(User $user): User
    {
        if (!empty($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = null;
        return $user;
    }

}
