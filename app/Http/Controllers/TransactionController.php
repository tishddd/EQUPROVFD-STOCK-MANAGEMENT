<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    // =============================Device Method==========================================
    public function index()
    {
        try {
            $transaction = Transaction::all();
            return $this->successResponse('transaction retrieved successfully', ['transactions' => $transaction]);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function show($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            return $this->successResponse('transaction retrieved successfully', ['transaction' => $transaction]);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('transaction not found', $id);
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
            $transaction = Transaction::create($validated);
            return $this->successResponse(' transaction added successfully', ['office' => $transaction], 201);
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
            $transaction = Transaction::findOrFail($id);
            $transaction->update($validated);
            return $this->successResponse('transaction updated successfully', ['transaction' => $transaction]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('transaction not found', $id);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function destroy($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();
            return $this->successResponse('transaction deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('transaction not found', $id);
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
            'device_id' => 'required|exists:devices,id',
            'employee_id' => 'required|exists:users,id',
            'region' => 'required|string|max:255',
            'customer_tin' => 'required|string|max:255',
            'date_sent' => 'required|date',
            'status' => 'required|in:sent,sold',
        ]);
    }

    private function validateUpdateDevice(Request $request, $id = null)
    {
        return $request->validate([
            'device_id' => 'sometimes|exists:devices,id',
            'employee_id' => 'sometimes|exists:users,id',
            'region' => 'sometimes|string|max:255',
            'customer_tin' => 'sometimes|string|max:255',
            'date_sent' => 'sometimes|date',
            'status' => 'sometimes|in:sent,sold',
        ]);
    }
    

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json(array_merge(['message' => $message], $data), $status);
    }

    private function notFoundResponse($message, $id)
    {
        return response()->json(['error' => $message, 'message' => "Transaction not found with ID: $id"], 404);
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

