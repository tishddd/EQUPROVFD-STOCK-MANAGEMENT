<?php
namespace App\Exports;

use App\Models\Device;
use App\Models\Transaction;
use App\Models\DeviceIssue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Collection;

class DevicesExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new StatsSheet(),
            new OfficeDeviceCountsSheet(),
            new TotalDeviceCountsSheet(),
            new DevicesSheet(),
        ];
    }
}

// 🟢 Sheet 1: General Stats
class StatsSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        $stats = [
            ['Total Devices', Device::count()],
            ['Available Devices', Device::where('status', 'in_office')->count()],
            ['Assigned Devices', Device::whereNotNull('office_id')->count()],
            ['Damaged Devices', Device::where('status', 'damaged')->count()],
            ['Sold Devices', Device::where('status', 'sold')->count()],
            ['Total Transactions', Transaction::count()],
            ['Total Issues', DeviceIssue::count()],
            ['POS Received', Device::where('item_name', 'POS')->count()],
            ['Thermal Printers Received', Device::where('item_name', 'PRINTER')->count()],
            ['POS Sold', Device::where('item_name', 'POS')->where('status', 'sold')->count()],
            ['Thermal Printers Sold', Device::where('item_name', 'PRINTER')->where('status', 'sold')->count()],
            ['POS Remaining', Device::where('item_name', 'POS')->where('status', '!=', 'sold')->count()],
            ['Thermal Printers Remaining', Device::where('item_name', 'PRINTER')->where('status', '!=', 'sold')->count()],
        ];

        return new Collection($stats);
    }

    public function headings(): array
    {
        return ['Statistic', 'Value'];
    }
}

// 🟢 Sheet 2: Office-wise Device Counts
class OfficeDeviceCountsSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('offices as o')
            ->leftJoin('devices as d', function ($join) {
                $join->on('o.id', '=', 'd.office_id')
                    ->where('d.status', '=', 'in_office');
            })
            ->select(
                'o.id as office_id',
                'o.name as office_name',
                'o.region',
                DB::raw("SUM(CASE WHEN d.item_name = 'POS' THEN 1 ELSE 0 END) as pos_count"),
                DB::raw("SUM(CASE WHEN d.item_name = 'PRINTER' THEN 1 ELSE 0 END) as printer_count")
            )
            ->groupBy('o.id', 'o.name', 'o.region')
            ->orderBy('o.id')
            ->get();
    }

    public function headings(): array
    {
        return ['Office ID', 'Office Name', 'Region', 'POS Count', 'Printer Count'];
    }
}

// 🟢 Sheet 3: Total Device Counts (POS & Printer)
class TotalDeviceCountsSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        $result = DB::table('devices')
            ->where('status', 'in_office')
            ->selectRaw("
                SUM(CASE WHEN item_name = 'POS' THEN 1 ELSE 0 END) as total_pos,
                SUM(CASE WHEN item_name = 'PRINTER' THEN 1 ELSE 0 END) as total_printer
            ")
            ->first();

        return new Collection([
            ['Total POS', $result->total_pos],
            ['Total Printers', $result->total_printer],
        ]);
    }

    public function headings(): array
    {
        return ['Category', 'Count'];
    }
}

// 🟢 Sheet 4: Devices List
class DevicesSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Device::select('id', 'item_name', 'model_number', 'serial_number', 'status', 'price', 'sold_price', 'region_code', 'office_id', 'employee_id', 'customer_tin', 'sold_date')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Item Name', 'Model Number', 'Serial Number', 'Status', 'Price', 'Sold Price', 'Region Code', 'Office Name', 'Employee Name', 'Customer TIN', 'Sold Date'];
    }
}
