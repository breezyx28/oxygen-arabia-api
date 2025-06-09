<?php

namespace App\Http\Traits;

use App\Http\Services\StoreService;
use App\Http\Services\UpdateService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait ResourcesTrait
{
    public function StoreAction(array|Request $request, Model $model, array $except = [], array $push = [])
    {
        $storeService = new StoreService($request, $model, $except, $push);

        return response()->json($storeService->data);
    }

    public function StoreAndReturn(Request $request, Model $model, array $except = [], array $push = [])
    {
        $storeService = new StoreService($request, $model, $except, $push);

        return $storeService->data;
    }

    public function UpdateAction(Request $request, Model $model)
    {
        $updateService = new UpdateService($request, $model);

        return response()->json($updateService->data);
    }

    public function DeleteAction(Model $model)
    {
        try {
            $model->delete();

            return response()->json([
                'success' => true,
                'message' => 'Model Deleted Successfuly',
                'data' => $model
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function LastRecord(Model $model)
    {
        try {
            $last = $model::getLastRecord();

            return response()->json([
                'success' => true,
                'message' => 'Latest Record Successfuly',
                'data' => $last
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
