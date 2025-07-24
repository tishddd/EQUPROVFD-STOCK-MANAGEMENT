<?php
namespace App\Http\Controllers;

use App\Models\DeviceIssue;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class DeviceEssueController extends Controller
{
    // =============================Device Method==========================================
    public function index()
    {
        try {
            $devicesIssue = DeviceIssue::all();
            return $this->successResponse('DevicesEssue retrieved successfully', ['deviceIssues' => $devicesIssue]);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function show($id)
    {
        try {
            $devicesIssue = DeviceIssue::findOrFail($id);
            return $this->successResponse('DeviceIssue retrieved successfully', ['deviceIssue' => $devicesIssue]);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('DeviceIssue not found', $id);
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
            $devicesIssue = DeviceIssue::create($validated);
            return $this->successResponse('Device issue added successfully', ['devicesIssue' => $devicesIssue], 201);
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
            $devicesIssue = DeviceIssue::findOrFail($id);
            $devicesIssue->update($validated);
            return $this->successResponse('Issue on The Device updated successfully', ['devicesIssue' => $devicesIssue]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('DeviceIssue not found', $id);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function destroy($id)
    {
        try {
            $devicesIssue = DeviceIssue::findOrFail($id);
            $devicesIssue->delete();
            return $this->successResponse('DeviceIssue deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('DeviceIssue not found', $id);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    //<< =====================================Device Method End ====================================>>



    // ===========================
    // HELPER METHODS
    // ===========================

    private function validateDevice(Request $request, $id = null)
    {
        return $request->validate([
            'device_id' => 'sometimes|exists:devices,id',
            'issue_type' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,repaired,irreparable',
            'reported_at' => 'sometimes|date',
        ]);
    }
    

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(array_merge(['message' => $message], $data), $status);
    }

    private function notFoundResponse($message, $id)
    {
        return response()->json(['error' => $message, 'message' => "No device issue found with ID: $id"], 404);
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

