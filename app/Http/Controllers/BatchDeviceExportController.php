<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BatchDevicesExport;
use Maatwebsite\Excel\Facades\Excel;

class BatchDeviceExportController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|string|exists:devices,batch_id',
        ]);

        $batchId = $request->input('batch_id');
        $filename = 'batch_devices_' . $batchId . '.xlsx';

        return Excel::download(new BatchDevicesExport($batchId), $filename);
    }
}
