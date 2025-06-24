<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateService
{
    public mixed $data;

    public function __construct(Request $request, Model $model, array $except = [], array $push = [])
    {
        $validatedData = $request->validated();
        $validatedData = Arr::collapse([$validatedData, $push]);
        $validatedData = Arr::except($validatedData, $except);

        // Handle nested file uploads (like section_6_slider)
        $this->handleNestedFileUploads($request, $model, $validatedData);

        // Handle regular file uploads
        $this->handleRegularFileUploads($request, $model);

        // Update model attributes
        foreach ($validatedData as $key => $value) {
            if ($key == 'password') {
                $model->$key = Hash::make($value);
            } else {
                $model->$key = $value;
            }
        }

        try {
            $model->save();

            $this->data = [
                'success' => true,
                'message' => 'Data successfully updated',
                'data' => $model
            ];
        } catch (\Throwable $th) {
            Log::alert('error', [
                'Update error message' => $th->getMessage(),
                'Update error line' => $th,
            ]);

            $this->data = [
                'success' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    /**
     * Handle nested file uploads in complex data structures
     */
    private function handleNestedFileUploads(Request $request, Model $model, array &$validatedData)
    {
        foreach ($request->allFiles() as $field => $files) {
            // Skip if this is a regular file field (handled separately)
            if (!is_array($files) || empty($files)) {
                continue;
            }

            // Check if this field has nested structure with files
            $existingData = $model->$field ?? [];
            $newData = $validatedData[$field] ?? [];

            // Debug: Log the structure we're receiving
            Log::info("Processing nested files for field: {$field}", [
                'files_structure' => $files,
                'existing_data' => $existingData,
                'new_data' => $newData
            ]);

            foreach ($files as $index => $fileData) {
                // Ensure index is numeric and valid
                if (!is_numeric($index)) {
                    continue;
                }

                if (is_array($fileData)) {
                    // Handle nested file structure
                    foreach ($fileData as $fileKey => $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile) {
                            // Ensure arrays exist before accessing
                            if (!isset($existingData[$index])) {
                                $existingData[$index] = [];
                            }
                            if (!isset($newData[$index])) {
                                $newData[$index] = [];
                            }

                            // Delete old file if exists
                            if (
                                isset($existingData[$index][$fileKey]) &&
                                is_string($existingData[$index][$fileKey]) &&
                                !empty($existingData[$index][$fileKey])
                            ) {
                                Storage::disk('public')->delete($existingData[$index][$fileKey]);
                            }

                            // Store new file
                            $filePath = $file->storeAs(
                                ucfirst($model->getTable()),
                                $file->getClientOriginalName(),
                                'public'
                            );

                            // Update the data structure
                            $newData[$index][$fileKey] = $filePath;

                            Log::info("Stored file for {$field}[{$index}][{$fileKey}]", [
                                'file_path' => $filePath
                            ]);
                        }
                    }
                } elseif ($fileData instanceof \Illuminate\Http\UploadedFile) {
                    // Handle direct file upload (not nested)
                    if (!isset($existingData[$index])) {
                        $existingData[$index] = null;
                    }
                    if (!isset($newData[$index])) {
                        $newData[$index] = null;
                    }

                    // Delete old file if exists
                    if (is_string($existingData[$index]) && !empty($existingData[$index])) {
                        Storage::disk('public')->delete($existingData[$index]);
                    }

                    // Store new file
                    $filePath = $fileData->storeAs(
                        ucfirst($model->getTable()),
                        $fileData->getClientOriginalName(),
                        'public'
                    );

                    $newData[$index] = $filePath;

                    Log::info("Stored direct file for {$field}[{$index}]", [
                        'file_path' => $filePath
                    ]);
                }
            }

            // Update the validated data with file paths
            if (!empty($newData)) {
                $validatedData[$field] = $newData;
                Log::info("Updated validated data for {$field}", [
                    'new_data' => $newData
                ]);
            }
        }
    }

    /**
     * Handle regular file uploads (single files or arrays of files)
     */
    private function handleRegularFileUploads(Request $request, Model $model)
    {
        foreach ($request->allFiles() as $field => $files) {
            // Skip if this is a nested structure (already handled)
            if (is_array($files) && !empty($files)) {
                // Check if this is a nested structure by looking at the first key
                $firstKey = array_key_first($files);
                if ($firstKey !== null && !is_numeric($firstKey)) {
                    continue; // This is a nested structure, skip it
                }

                // Check if the first element is not an UploadedFile
                if (isset($files[$firstKey]) && !($files[$firstKey] instanceof \Illuminate\Http\UploadedFile)) {
                    continue; // This is a nested structure, skip it
                }
            }

            // Delete old file(s)
            if ($model->$field) {
                $oldFiles = is_array($model->$field) ? $model->$field : [$model->$field];
                foreach ($oldFiles as $oldFile) {
                    if (is_string($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }

            // Store new file(s)
            if (is_array($files)) {
                $filePaths = [];
                foreach ($files as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $filePaths[] = $file->storeAs(
                            ucfirst($model->getTable()),
                            $file->getClientOriginalName(),
                            'public'
                        );
                    }
                }
                $model->$field = $filePaths;
            } else {
                if ($files instanceof \Illuminate\Http\UploadedFile) {
                    $model->$field = $files->storeAs(
                        ucfirst($model->getTable()),
                        $files->getClientOriginalName(),
                        'public'
                    );
                }
            }
        }
    }
}
