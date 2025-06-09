<?php

namespace App\Http\Services;

use App\Helpers\Helper;
use App\Notifications\FormFeedback;
use Error;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\File;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class StoreService
{
    public mixed $data;

    public function __construct(Request $request, Model $model, array $except = [], array $push = [])
    {
        $validate = $request->validated();
        $validate = Arr::collapse([$validate, $push]);
        $validate = Arr::except($validate, $except);

        $filter = (object) array_filter($validate, function ($item) {
            return $item !== null || $item !== '';
        });

        foreach ($filter as $key => $value) {
            $model->$key = $value;
            if ($key == 'password') {
                $model->$key = Hash::make($value);
            }
            if (!empty($request->allFiles())) {
                foreach ($request->allFiles() as $index => $file) {
                    $file_dir = $request->file($index)->storeAs(ucfirst($model->getTable()), $file->getClientOriginalName(), 'public');
                    $model->$index = $file_dir;
                }
            }
        }

        try {
            $model->save();

            // should get raid of password_confirmation
            // Fire the Registered event (sends the verification email)
            if ($model->getTable() === 'users') {
                event(new Registered($model));
                $this->data = [
                    'success' => true,
                    'message' => 'Registration successful. Please check your email for verification link.',
                    'data' => $model
                ];
            } else {
                $this->data = [
                    'success' => true,
                    'message' => 'Data successfuly stored',
                    'data' => $model
                ];
            }
        } catch (\Throwable $th) {
            Log::alert('error', [
                'Store error message' => $th->getMessage(),
                'Store error line' => $th,
            ]);

            $this->data = [
                'success' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
