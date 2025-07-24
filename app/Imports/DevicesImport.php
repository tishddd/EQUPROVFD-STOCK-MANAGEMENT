<?php

namespace App\Imports;

use App\Models\Device;
use App\Models\Batch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class DevicesImport implements ToModel, WithHeadingRow
{
    private $batch;

    public function __construct()
    {
        $today = now()->format('Y-m-d');
        $this->batch = Batch::firstOrCreate(
            ['batch_date' => $today], 
            ['batch_id' => 'BAT-' . $today, 'description' => 'Auto-generated batch']
        );

        Log::info('Batch initialized', ['batch_id' => $this->batch->batch_id]);
    }

    public function model(array $row)
    {
        try {
            // Normalize keys to lowercase to avoid column name mismatches
            $row = array_change_key_case($row, CASE_LOWER);

            Log::info('Processing row', $row); // Log each row being processed

            $device = new Device([
                'item_name'     => $row['item_name'] ?? null,
                'model_number'  => $row['model_number'] ?? null,
                'serial_number' => $row['serial_number'] ?? null,
                'status'        => $row['status'] ?? 'in_office',
                'region_code'  => $row['region_code'] ?? null,
                'office_id'     => isset($row['office_id']) ? (int) $row['office_id'] : 6,
                'employee_id'   => isset($row['employee_id']) ? (int) $row['employee_id'] : null,
                'price'         => isset($row['price']) ? (float) str_replace(',', '', $row['price']) : 0.0,
                'sold_price'    => isset($row['sold_price']) ? (float) str_replace(',', '', $row['sold_price']) : 0.0,
                'customer_tin'  => $row['customer_tin'] ?? null,
                'sold_date'     => $row['sold_date'] ?? null,
                'batch_id'      => $this->batch->batch_id,
            ]);

            Log::info('Device created successfully', $device->toArray());
            return $device;
        } catch (\Exception $e) {
            Log::error('Error inserting device', ['error' => $e->getMessage(), 'row' => $row]);
            return null;
        }
    }
}
