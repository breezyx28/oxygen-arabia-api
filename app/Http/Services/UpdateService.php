<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UpdateService
{
    public mixed $data;

    public function __construct(Request $request, Model $model)
    {
        $validate =  $request->validated();

        $filter = (object) array_filter($validate, function ($item) {
            return $item != null || $item != '';
        });

        foreach ($filter as $key => $value) {
            $model->$key = $value;
            if (!empty($request->allFiles())) {
                foreach ($request->allFiles() as $index => $file) {
                    $model->$index = $request->file($index)->storeAs(ucfirst($model->getTable()), $file->getClientOriginalName(), 'public');
                }
            }
            if ($key == "password") {
                $model->$key = Hash::make($value);
            }
        }

        try {
            $model->saveQuietly();

            $this->data = [
                'success' => true,
                'message' => 'Data successfuly updated',
                'data' => $model
            ];
        } catch (\Throwable $th) {
            Log::alert('error', [
                'update error' => $th->getMessage()
            ]);

            $this->data = [
                'success' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
