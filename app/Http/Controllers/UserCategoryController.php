<?php

namespace App\Http\Controllers;

use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class UserCategoryController extends Controller
{
    // ============================
    // Show all user categories
    // ============================
    public function index()
    {
        try {
            $userCategory = UserCategory::all();
            return $this->successResponse('User Categories retrieved successfully', ['userCategory' => $userCategory]);
        } catch (\Throwable $e) {
            return $this->handleException($e);
        }
    }

    // ============================
    // Show single user category
    // ============================
    public function show($id)
    {
        try {
            $userCategory = UserCategory::findOrFail($id);
            return $this->successResponse('User Category retrieved successfully', ['userCategory' => $userCategory]);
        } catch (\Throwable $e) {
            return $this->handleException($e, $id);
        }
    }

    // ============================
    // Store a new user category
    // ============================
    public function store(Request $request)
    {
        try {
            $validated = $this->validateUserCategory($request);
            $userCategory = UserCategory::create($validated);
            return $this->successResponse('User Category added successfully', ['userCategory' => $userCategory], 201);
        } catch (\Throwable $e) {
            return $this->handleException($e);
        }
    }

    // ============================
    // Update an existing user category
    // ============================
    public function update(Request $request, $id)
    {
        try {
            $validated = $this->validateUserCategory($request, $id);
            $userCategory = UserCategory::findOrFail($id);
            $userCategory->update($validated);
            return $this->successResponse('User Category updated successfully', ['userCategory' => $userCategory]);
        } catch (\Throwable $e) {
            return $this->handleException($e, $id);
        }
    }

    // ============================
    // Delete a user category
    // ============================
    public function destroy($id)
    {
        try {
            $userCategory = UserCategory::findOrFail($id);
            $userCategory->delete();
            return $this->successResponse('User Category deleted successfully');
        } catch (\Throwable $e) {
            return $this->handleException($e, $id);
        }
    }

    // ============================
    // Helper method for validating user category data
    // ============================
    private function validateUserCategory(Request $request, $id = null)
    {
        Log::info("Validating user category data", ['request_data' => $request->all(), 'category_id' => $id]);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:user_category,name,' . $id,
            'description' => 'nullable|string|max:255',
        ]);
    
        Log::info("Validation successful", ['validated_data' => $validatedData]);
    
        return $validatedData;
    }
    
    // ============================
    // Helper method for sending a successful response
    // ============================
    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(compact('message') + $data, $status);
    }

    // ============================
    // Helper method for handling exceptions
    // ============================
    private function handleException(\Throwable $e, $id = null)
    {
        // Log error
        Log::error('Error occurred', ['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);

        // Handle specific exceptions
        return match (true) {
            $e instanceof ValidationException => response()->json([
                'error' => 'Validation failed', 'messages' => $e->errors()
            ], 422),
            $e instanceof ModelNotFoundException => response()->json([
                'error' => 'Not Found', 'message' => "No User Category found with ID: $id"
            ], 404),
            $e instanceof QueryException => response()->json([
                'error' => 'Database error', 'message' => $e->getMessage()
            ], 500),
            default => response()->json([
                'error' => 'Unexpected error', 'message' => $e->getMessage()
            ], 500),
        };
    }
}
