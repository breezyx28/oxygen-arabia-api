<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class UpdateService
{
    public mixed $data;

    public function __construct(Request $request, Model $model, array $except = [], array $push = [])
    {
        $validate = $request->validated();
        $validate = Arr::collapse([$validate, $push]);
        $validate = Arr::except($validate, $except);

        $filter = (object) array_filter($validate, fn($item) => $item !== null && $item !== '');

        foreach ($filter as $key => $value) {
            // Password hash
            if ($key === 'password') {
                $model->$key = Hash::make($value);
            } else {
                $model->$key = $value;
            }

            // Handle file uploads
            if (!empty($request->allFiles())) {
                foreach ($request->allFiles() as $index => $files) {
                    if ($index !== $key) {
                        continue;
                    }

                    // Delete old file(s)
                    if (!empty($model->$index)) {
                        $oldFiles = is_array($model->$index) ? $model->$index : [$model->$index];
                        foreach ($oldFiles as $oldFile) {
                            if (is_string($oldFile)) {
                                Storage::disk('public')->delete($oldFile);
                            }
                        }
                    }

                    // Handle file upload
                    if (is_array($files)) {
                        $filePaths = [];
                        foreach ($files as $file) {
                            if (is_array($file)) {
                                foreach ($file as $innerFile) {
                                    $file_dir = $innerFile->storeAs(
                                        ucfirst($model->getTable()),
                                        $innerFile->getClientOriginalName(),
                                        'public'
                                    );
                                    $filePaths[] = $file_dir;
                                }
                            } else {
                                $file_dir = $file->storeAs(
                                    ucfirst($model->getTable()),
                                    $file->getClientOriginalName(),
                                    'public'
                                );
                                $filePaths[] = $file_dir;
                            }
                        }
                        $model->$index = $filePaths;
                    } else {
                        $file_dir = $files->storeAs(
                            ucfirst($model->getTable()),
                            $files->getClientOriginalName(),
                            'public'
                        );
                        $model->$index = $file_dir;
                    }
                }
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
            Log::alert('Update Error', [
                'message' => $th->getMessage(),
                'trace' => $th,
            ]);

            $this->data = [
                'success' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
