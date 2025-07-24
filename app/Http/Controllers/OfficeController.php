<?php
namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class OfficeController extends Controller
{
    // =============================Device Method==========================================
    public function index()
    {
        try {
            $office = Office::all();
            return $this->successResponse('Office retrieved successfully', ['officies' => $office]);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function show($id)
    {
        try {
            $office = Office::findOrFail($id);
            return $this->successResponse('DeviceIssue retrieved successfully', ['office' => $office]);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('office not found', $id);
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
            $office = Office::create($validated);
            return $this->successResponse(' Office added successfully', ['office' => $office], 201);
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
            $office = Office::findOrFail($id);
            $office->update($validated);
            return $this->successResponse('Office updated successfully', ['office' => $office]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Office not found', $id);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function destroy($id)
    {
        try {
            $office = Office::findOrFail($id);
            $office->delete();
            return $this->successResponse('Office deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Office not found', $id);
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
            'name' => 'sometimes|string|max:255',
            'region' => 'sometimes|string|max:255',
            'region_code' => 'sometimes|string|max:255',
        ]);
    }
    

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(array_merge(['message' => $message], $data), $status);
    }

    private function notFoundResponse($message, $id)
    {
        return response()->json(['error' => $message, 'message' => "Office not found with ID: $id"], 404);
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

