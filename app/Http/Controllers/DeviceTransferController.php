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
            'device_id' => 'required|exists:devices,id'
        ]);

        // Find the device
        $device = Device::where('id', $request->device_id)
                        ->where('item_name', $request->device_type)
                        ->first();

        if (!$device) {
            return response()->json(['message' => 'Device not found or does not match type'], 404);
        }

        // Find the office in the specified region
        $office = Office::where('id', $request->region_id)->first();
        if (!$office) {
            return response()->json(['message' => 'Region not found'], 404);
        }

        // Update device office_id
        $device->office_id = $office->id;
        $device->save();

        return response()->json([
            'message' => 'Device transferred successfully',
            'device' => $device
        ], 200);
    }
}
