<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Office;

class DeviceTransferController extends Controller
{
    public function transferDevice(Request $request)
    {
        // Validate request
        $request->validate([
            'region_id' => 'required|exists:offices,id',
            'device_type' => 'required|in:Pos,Printer',
            'device_id' => 'required|exists:devices,id',
        ]);

        // Get the device by ID and type
        $device = Device::where('id', $request->device_id)
            ->where('item_name', $request->device_type)
            ->first();

        if (!$device) {
            return response()->json(['message' => 'Device not found or does not match type'], 404);
        }

        // Get the destination office
        $office = Office::find($request->region_id);
        if (!$office) {
            return response()->json(['message' => 'Office not found'], 404);
        }

        // Update device's office and region_code
        $device->office_id = $office->id;
        $device->region_code = $office->region_code; // Important line
        $device->save();

        return response()->json([
            'message' => 'Device transferred successfully',
            'device' => $device
        ], 200);
    }
}
