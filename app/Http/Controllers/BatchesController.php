<?php
namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class BatchesController extends Controller
{
    // =============================Device Method==========================================
    public function index()
    {
        try {
            $batch = Batch::all();
            return $this->successResponse('batch retrieved successfully', ['batches' => $batch]);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function show($id)
    {
        try {
            $batch = Batch::findOrFail($id);
            return $this->successResponse('batch retrieved successfully', ['Batch' => $batch]);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('batch not found', $id);
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
            $batch = Batch::create($validated);
            return $this->successResponse(' batch added successfully', ['batch' => $batch], 201);
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
            $validated = $this->validateUpdateDevice($request, $id);
            $batch = Batch::findOrFail($id);
            $batch->update($validated);
            return $this->successResponse('batch updated successfully', ['batch' => $batch]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('batch not found', $id);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function destroy($id)
    {
        try {
            $batch = Batch::findOrFail($id);
            $batch->delete();
            return $this->successResponse('batch deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('batch not found', $id);
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
            'batch_id' => 'required|string|max:255|unique:batches,batch_id',
            'batch_date' => 'required|date',
            'description' => 'nullable|string',
        ]);
    }
    
    
    private function validateUpdateDevice(Request $request, $id = null)
    {
        return $request->validate([
            'batch_id' => 'sometimes|string|max:255|exists:batches,batch_id',
            'batch_date' => 'sometimes|date',
            'description' => 'nullable|string',
        ]);
    }
    

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(array_merge(['message' => $message], $data), $status);
    }

    private function notFoundResponse($message, $id)
    {
        return response()->json(['error' => $message, 'message' => "Batch not found with ID: $id"], 404);
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

