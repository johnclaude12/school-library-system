<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminSettings;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AdminSettings\AdminSettingsCollection;
use App\Http\Resources\AdminSettings\AdminSettingsResource;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $adminSettings = AdminSettings::all();
        return AdminSettingsCollection::collection($adminSettings);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(AdminSettings $adminSettings)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $message = "Failed to update.";
        $status = false;
        $code = Response::HTTP_CONFLICT;

        $options =  AdminSettings::where('id', $id)->update($request->all());

        if ($options) {
            $message = "Updated successfully.";
            $status = true;
            $code = Response::HTTP_OK;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'status' => $status,
            'data' => new AdminSettingsResource($request->all()),
        ], $code);
    }

    public function destroy(AdminSettings $adminSettings)
    {
        //
    }
}
