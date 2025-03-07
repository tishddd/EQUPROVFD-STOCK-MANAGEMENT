<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Transaction;
use App\Models\DeviceIssue;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get overall statistics (total devices, assigned, available, etc.).
     */
    public function stats()
    {
        try {
            // General Statistics
            $totalDevices = Device::count();
            $availableDevices = Device::where('status', 'in_office')->count();
            $assignedDevices = Device::whereNotNull('office_id')->count();
            $damagedDevices = Device::where('status', 'damaged')->count();
            $soldDevices = Device::where('status', 'sold')->count();
            $totalTransactions = Transaction::count();
            $totalIssues = DeviceIssue::count();

            // POS & Thermal Printer Statistics
            $posReceived = Device::where('item_name', 'POS')->count();
            $thermalPrinterReceived = Device::where('item_name', 'THERMAL_PRINTER')->count();
            $posSold = Device::where('item_name', 'POS')->where('status', 'sold')->count();
            $thermalPrinterSold = Device::where('item_name', 'THERMAL_PRINTER')->where('status', 'sold')->count();

            // Remaining POS & Thermal Printers (NOT sold)
            $posRemain = Device::where('item_name', 'POS')->where('status', '!=', 'sold')->count();
            $thermalPrinterRemain = Device::where('item_name', 'THERMAL_PRINTER')->where('status', '!=', 'sold')->count();

            return response()->json([
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



    /**
     * Get a report of device transactions.
     */
    public function transactionsReport()
    {
        try {
            $transactions = Transaction::with(['device', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Transaction report generated successfully',
                'transactions' => $transactions
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a report of device issues.
     */
    public function issuesReport()
    {
        try {
            $issues = DeviceIssue::with(['device', 'reportedBy'])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Device issues report generated successfully',
                'issues' => $issues
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Get a report of  getOfficeDeviceCounts.
     */
    public function getOfficeDeviceCounts()
{
    $results = DB::table('offices as o')
        ->leftJoin('devices as d', function ($join) {
            $join->on('o.id', '=', 'd.office_id')
                 ->where('d.status', '=', 'in_office');
        })
        ->select(
            'o.id as office_id',
            'o.name as office_name',
            'o.region',
            DB::raw("SUM(CASE WHEN d.item_name = 'POS' THEN 1 ELSE 0 END) as pos_count"),
            DB::raw("SUM(CASE WHEN d.item_name = 'THERMAL_PRINTER' THEN 1 ELSE 0 END) as thermal_printer_count")
        )
        ->groupBy('o.id', 'o.name', 'o.region')
        ->orderBy('o.id')
        ->get();

    return response()->json($results);
}

 /**
     * Get a report of  getTotalDeviceCounts.
     */
public function getTotalDeviceCounts()
{
    $result = DB::table('devices')
        ->where('status', 'in_office')
        ->selectRaw("
            SUM(CASE WHEN item_name = 'POS' THEN 1 ELSE 0 END) as total_pos,
            SUM(CASE WHEN item_name = 'THERMAL_PRINTER' THEN 1 ELSE 0 END) as total_thermal_printer
        ")
        ->first();

    return response()->json($result);
}




}
