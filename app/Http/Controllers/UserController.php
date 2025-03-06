<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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
            $validated = $this->validateDevice($request);
            $user = User::create($validated);
            return $this->successResponse('User added successfully', ['user' => $user], 201);
        } catch (\Throwable $e) {
            return $this->handleException($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $this->validateDevice($request, $id);
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

    private function validateDevice(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'sometimes|string|max:255|bail',
            'email' => [
                'sometimes', 'email', 'max:255',
                'unique:users,email,' . $id
            ],
            'email_verified_at' => 'nullable|date',
            'password' => 'nullable|string|min:8|confirmed',
            'remember_token' => 'nullable|string|max:100',
        ]);
    }
    
    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(compact('message') + $data, $status);
    }

    private function handleException(\Throwable $e, $id = null)
    {
        return match (true) {
            $e instanceof ValidationException => response()->json([
                'error' => 'Validation failed', 'messages' => $e->errors()
            ], 422),
            $e instanceof ModelNotFoundException => response()->json([
                'error' => 'Not Found', 'message' => "No user found with ID: $id"
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
