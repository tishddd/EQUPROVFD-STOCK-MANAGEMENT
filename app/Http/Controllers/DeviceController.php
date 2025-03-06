<?php
namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class DeviceController extends Controller
{
    public function index()
    {
        try {
            $devices = Device::all();
            return $this->successResponse('Devices retrieved successfully', ['devices' => $devices]);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function show($id)
    {
        try {
            $device = Device::findOrFail($id);
            return $this->successResponse('Device retrieved successfully', ['device' => $device]);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Device not found', $id);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateDevice($request);
            $device = Device::create($validated);
            return $this->successResponse('Device added successfully', ['device' => $device], 201);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $this->validateDevice($request, $id);
            $device = Device::findOrFail($id);
            $device->update($validated);
            return $this->successResponse('Device updated successfully', ['device' => $device]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Device not found', $id);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function destroy($id)
    {
        try {
            $device = Device::findOrFail($id);
            $device->delete();
            return $this->successResponse('Device deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Device not found', $id);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    // ===========================
    // HELPER METHODS
    // ===========================

    private function validateDevice(Request $request, $id = null)
    {
        return $request->validate([
            'item_name' => 'sometimes|string|max:255',
            'model_number' => 'sometimes|string|max:255',
            'serial_number' => 'sometimes|string|max:255|unique:devices,serial_number,' . $id,
            'status' => 'nullable|in:in_office,sold,damaged',
            'office_id' => 'nullable|exists:offices,id',
            'employee_id' => 'nullable|exists:users,id',
        ]);
    }

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(array_merge(['message' => $message], $data), $status);
    }

    private function notFoundResponse($message, $id)
    {
        return response()->json(['error' => $message, 'message' => "No device found with ID: $id"], 404);
    }

    private function validationErrorResponse(ValidationException $e)
    {
        return response()->json(['error' => 'Validation failed', 'messages' => $e->errors()], 422);
    }

    private function databaseErrorResponse(QueryException $e)
    {
        return response()->json(['error' => 'Database error', 'message' => $e->getMessage()], 500);
    }

    private function unexpectedErrorResponse(\Exception $e)
    {
        return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
    }
}

