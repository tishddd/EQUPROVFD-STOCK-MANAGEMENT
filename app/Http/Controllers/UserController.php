<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return $this->successResponse('Users retrieved successfully', ['users' => $users]);
        } catch (\Throwable $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return $this->successResponse('User retrieved successfully', ['user' => $user]);
        } catch (\Throwable $e) {
            return $this->handleException($e, $id);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateUser($request);
            $user = User::create($validated);
            return $this->successResponse('User added successfully', ['user' => $user], 201);
        } catch (\Throwable $e) {
            return $this->handleException($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $this->validateUser($request, $id);
            $user = User::findOrFail($id);
            $user->update($validated);
            return $this->successResponse('User updated successfully', ['user' => $user]);
        } catch (\Throwable $e) {
            return $this->handleException($e, $id);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->successResponse('User deleted successfully');
        } catch (\Throwable $e) {
            return $this->handleException($e, $id);
        }
    }

    // ===========================
    // HELPER METHODS
    // ===========================


    private function validateUser(Request $request, $id = null)
    {
        Log::info("Validating device data", ['request_data' => $request->all(), 'user_id' => $id]);

        $rules = [
            'user_code' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $id
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user,editor',
        ];

        if ($id) { // For update, password might be optional
            $rules['password'] = 'nullable|string|min:8';
        }

        $validatedData = $request->validate($rules);

        Log::info("Validation successful", ['validated_data' => $validatedData]);

        return $validatedData;
    }

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(compact('message') + $data, $status);
    }

    private function handleException(\Throwable $e, $id = null)
    {
        return match (true) {
            $e instanceof ValidationException => response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422),
            $e instanceof ModelNotFoundException => response()->json([
                'error' => 'Not Found',
                'message' => "No user found with ID: $id"
            ], 404),
            $e instanceof QueryException => response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500),
            default => response()->json([
                'error' => 'Unexpected error',
                'message' => $e->getMessage()
            ], 500),
        };
    }
}
