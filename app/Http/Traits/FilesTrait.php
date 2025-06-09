<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FilesTrait
{
    public function checkFileUploadedBefore($file)
    {
        $fileHash = hash_file('sha256', $file->path());

        $hashedFiles = Storage::disk('public')->files('hashed-files');

        foreach ($hashedFiles as $hashedFile) {
            $hashedFilePath = storage_path('app/public/' . $hashedFile);
            $existingHash = file_get_contents($hashedFilePath);

            if ($existingHash === $fileHash) {
                // File has been uploaded before
                return true;
            }
        }

        // File is new and hasn't been uploaded before
        return false;
    }
}
