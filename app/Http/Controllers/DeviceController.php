<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DevicesImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    // =============================Device Method==========================================

    public function index()
    {
        try {
            $devices = Device::with(['office', 'employee', 'batch'])->get()->map(function ($device) {
                return [
                    'id'           => $device->id,
                    'item_name'    => $device->item_name,
                    'model_number' => $device->model_number,
                    'serial_number' => $device->serial_number,
                    'status'       => $device->status,
                    'price'        => $device->price,
                    'sold_price'   => $device->sold_price,
                    'customer_tin' => $device->customer_tin,
                    'sold_date'    => $device->sold_date,
                    'created_at'   => $device->created_at,
                    'updated_at'   => $device->updated_at,
                    'region_code' => $device->region_code,
                    'office_name'  => $device->office ? $device->office->region : null,
                    'employee_name' => $device->employee ? $device->employee->name : null,
                    'batch_id'     => $device->batch_id,
                ];
            });

            return $this->successResponse('Devices retrieved successfully', ['devices' => $devices]);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }

    public function getDevicesByRegion(Request $request)
    {
        $regionCode = $request->input('region_code'); // Get from form-data
        $devices = Device::where('region_code', $regionCode)->get();

        return response()->json(['devices' => $devices]);
    }


    public function show($id)
    {
        try {
            $device = Device::with(['batch'])->findOrFail($id);
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
            // Validate the incoming request
            $validated = $this->validateDevice($request);

            // Generate or find the current batch based on today's date
            $today = now()->format('Y-m-d');
            $batch = Batch::firstOrCreate(
                ['batch_date' => $today],
                ['batch_id' => 'BAT-' . $today, 'description' => 'Auto-generated batch']
            );

            // Add the batch_id (string) to the validated data for creating the device
            $validated['batch_id'] = $batch->batch_id;

            // Create the device and assign the batch_id as a string
            $device = Device::create($validated);

            // Return a success response
            return $this->successResponse('Device added successfully', ['device' => $device], 201);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }
    public function update(Request $request, $serial_number)
    {
        try {
            // ✅ Validate Request
            $validated = $this->validateDevice($request, $serial_number);
    
            // ✅ Find Device by serial_id
            $device = Device::where('serial_number', $serial_number)->firstOrFail();
    
            // ✅ Update Device Data
            $device->fill($validated);
            $device->save();
    
            return $this->successResponse('Device updated successfully', ['device' => $device]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Device not found', $serial_number);
        } catch (QueryException $e) {
            return $this->databaseErrorResponse($e);
        } catch (\Exception $e) {
            return $this->unexpectedErrorResponse($e);
        }
    }
    

    //     public function update(Request $request, $id)
    // {
    //     try {
    //         $validated = $this->validateDevice($request, $id);
    //         $device = Device::findOrFail($id);

    //         // If batch ID needs to be updated, generate or find a batch
    //         if ($request->has('batch_id')) {
    //             // Retrieve or create a batch based on today's date and store the batch_id as a string
    //             // $today = now()->format('Y-m-d');
    //             // $batch = Batch::firstOrCreate(
    //             //     ['batch_date' => $today],
    //             //     ['batch_id' => 'BAT-' . $today, 'description' => 'Auto-generated batch']
    //             // );

    //             // Use the batch_id as a string instead of the batch's integer id
    //             // $validated['batch_id'] = $batch->batch_id;  // Store the batch_id as a string
    //         }

    //         // // Explicitly assign price if present
    //         // if ($request->has('price')) {
    //         //     $device->price = $request->input('price');
    //         // }

    //         // Update the device with validated data
    //         $device->fill($validated);
    //         $device->save();

    //         return $this->successResponse('Device updated successfully', ['device' => $device]);
    //     } catch (ValidationException $e) {
    //         return $this->validationErrorResponse($e);
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('Device not found', $id);
    //     } catch (QueryException $e) {
    //         return $this->databaseErrorResponse($e);
    //     } catch (\Exception $e) {
    //         return $this->unexpectedErrorResponse($e);
    //     }
    // }


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



    public function importExcel(Request $request)
    {
        try {
            Log::info('Import process started');

            // Validate the file
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls,csv|max:2048',
            ]);

            // Store the uploaded file
            $file = $request->file('excel_file');
            $path = $file->storeAs('imports', 'devices_import.xlsx'); // Saves file in storage/app/imports/

            Log::info('File uploaded successfully', [
                'path' => $path,
                'original_name' => $file->getClientOriginalName()
            ]);

            // Ensure file exists
            if (!Storage::disk('local')->exists('imports/devices_import.xlsx')) {
                Log::error('File not found in storage', ['path' => $path]);
                return response()->json(['success' => false, 'message' => 'File upload failed.'], 400);
            }

            // Get the absolute path
            $filePath = Storage::path($path);

            Log::info('Importing file from', ['filePath' => $filePath]);

            // Import Excel
            Excel::import(new DevicesImport, $filePath);

            Log::info('Import process completed successfully');

            return response()->json(['success' => true, 'message' => 'Devices imported successfully!']);
        } catch (\Exception $e) {
            Log::error('Import failed', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to import data: ' . $e->getMessage()], 500);
        }
    }


    // =========================== HELPER METHODS ===========================

    private function validateDevice(Request $request, $id = null)
    {
        return $request->validate([
            'item_name'      => 'sometimes|required|string|max:255',
            'model_number'   => 'sometimes|required|string|max:255',
            'serial_number'  => 'sometimes|required|string|max:255|unique:devices,serial_number,' . $id,
            'status'         => 'sometimes|in:in_office,sold,damaged',
            'office_id'      => 'nullable|exists:offices,id',
            'employee_id'    => 'nullable|exists:users,id',
            'price'          => 'sometimes|numeric|min:0',
            'sold_price'     => 'nullable|numeric|min:0',
            'customer_tin'   => 'nullable|string|max:20',
            'sold_date'      => 'nullable|date',
            'batch_id' => 'nullable|string|max:255', // Ensure batch_id is valid
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
