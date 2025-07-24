<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device; // Ensure this model exists
use Illuminate\Database\QueryException;
use App\Models\Transaction;
use App\Models\DeviceIssue;


class StockController extends Controller
{
    public function getStockByBatch($batch_id)
    {
        try {
            // Retrieve devices with related data
            $devices = Device::with(['office', 'employee', 'batch'])
                ->where('batch_id', $batch_id)
                ->orderBy('id', 'desc')
                ->get()
                ->map(function ($device) {
                    return [
                        'id'            => $device->id,
                        'item_name'     => $device->item_name,
                        'model_number'  => $device->model_number,
                        'serial_number' => $device->serial_number,
                        'status'        => $device->status,
                        'price'         => $device->price,
                        'sold_price'    => $device->sold_price,
                        'customer_tin'  => $device->customer_tin,
                        'sold_date'     => $device->sold_date,
                        'created_at'    => $device->created_at,
                        'updated_at'    => $device->updated_at,
                        'office_name'   => $device->office ? $device->office->region : null, // Fetch office region
                        'employee_name' => $device->employee ? $device->employee->name : null, // Fetch employee name
                        'batch_id'      => $device->batch_id,
                    ];
                });

            if ($devices->isEmpty()) {
                return response()->json([
                    'message' => 'No stock found for this batch.',
                    'data'    => []
                ], 404);
            }

            return response()->json([
                'message' => 'Stock retrieved successfully.',
                'data'    => $devices
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    public function stats($batch_id)
{
    try {
        // Filter by batch_id
        $totalDevices = Device::where('batch_id', $batch_id)->count();
        $availableDevices = Device::where('batch_id', $batch_id)->where('status', 'in_office')->count();
        $assignedDevices = Device::where('batch_id', $batch_id)->whereNotNull('office_id')->count();
        $damagedDevices = Device::where('batch_id', $batch_id)->where('status', 'damaged')->count();
        $soldDevices = Device::where('batch_id', $batch_id)->where('status', 'sold')->count();
        $totalTransactions = Transaction::whereHas('device', function ($query) use ($batch_id) {
            $query->where('batch_id', $batch_id);
        })->count();
        $totalIssues = DeviceIssue::whereHas('device', function ($query) use ($batch_id) {
            $query->where('batch_id', $batch_id);
        })->count();

        // POS & Thermal Printer Statistics for this batch
        $posReceived = Device::where('batch_id', $batch_id)->where('item_name', 'POS')->count();
        $thermalPrinterReceived = Device::where('batch_id', $batch_id)->where('item_name', 'PRINTER')->count();
        $posSold = Device::where('batch_id', $batch_id)->where('item_name', 'POS')->where('status', 'sold')->count();
        $thermalPrinterSold = Device::where('batch_id', $batch_id)->where('item_name', 'PRINTER')->where('status', 'sold')->count();

        // Remaining POS & Thermal Printers (NOT sold) in this batch
        $posRemain = Device::where('batch_id', $batch_id)->where('item_name', 'POS')->where('status', '!=', 'sold')->count();
        $thermalPrinterRemain = Device::where('batch_id', $batch_id)->where('item_name', 'PRINTER')->where('status', '!=', 'sold')->count();

        return response()->json([
            'batch_id' => $batch_id,
            'total_devices' => $totalDevices,
            'available_devices' => $availableDevices,
            'assigned_devices' => $assignedDevices,
            'damaged_devices' => $damagedDevices,
            'sold_devices' => $soldDevices,
            'total_transactions' => $totalTransactions,
            'total_issues' => $totalIssues,
            'pos_received' => $posReceived,
            'thermal_printer_received' => $thermalPrinterReceived,
            'pos_sold' => $posSold,
            'thermal_printer_sold' => $thermalPrinterSold,
            'pos_remaining' => $posRemain,
            'thermal_printer_remaining' => $thermalPrinterRemain
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()
        ], 500);
    }
}

}
