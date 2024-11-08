<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUpload
{
    /**
     * Uploads a profile image and returns the file path.
     *
     * @param Request $request
     * @return string|null
     */
    public function upload(Request $request): ?string
    {
        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = public_path('profiles');

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Move the file to the public directory
        $file->move($path, $filename);

        return 'profiles/' . $filename;

    }
}
