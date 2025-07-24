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
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Log; // Import Log class



class DevicesExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new StatsSheet(),
            new OfficeDeviceCountsSheet(),
            new DevicesSheet(),
        ];
    }
}

// 🟢 Sheet 1: Device Statistics Dashboard (Professional Edition)
// 🟢 Sheet 1: Device Statistics Dashboard (Final Optimized Version)
class StatsSheet implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithEvents
{
  

    public function collection()
    {
        // Fetch all required counts in a single optimized query
        $deviceCounts = Device::selectRaw("
            COUNT(*) as total_devices,
            COALESCE(SUM(CASE WHEN status = 'in_office' THEN 1 ELSE 0 END), 0) as available_devices,
            COALESCE(SUM(CASE WHEN office_id IS NOT NULL THEN 1 ELSE 0 END), 0) as assigned_devices,
            COALESCE(SUM(CASE WHEN status = 'damaged' THEN 1 ELSE 0 END), 0) as damaged_devices,
            COALESCE(SUM(CASE WHEN status = 'sold' THEN 1 ELSE 0 END), 0) as sold_devices,
            COALESCE(SUM(CASE WHEN item_name = 'Pos' THEN 1 ELSE 0 END), 0) as pos_count,
            COALESCE(SUM(CASE WHEN item_name = 'Printer' THEN 1 ELSE 0 END), 0) as printer_count,
            COALESCE(SUM(CASE WHEN item_name = 'Pos' AND status = 'sold' THEN 1 ELSE 0 END), 0) as sold_pos_count,
            COALESCE(SUM(CASE WHEN item_name = 'Printer' AND status = 'sold' THEN 1 ELSE 0 END), 0) as sold_printer_count
        ")->first();
    
        // Fetch additional counts
        $transactionCount = Transaction::count();
        $deviceIssueCount = DeviceIssue::count();
        $reportGenerated = now()->format('Y-m-d H:i');
    
        // Prepare the dataset
        $data = [
            ['DEVICE MANAGEMENT DASHBOARD', ''],
    
            // Core Metrics
            ['📊 CORE METRICS', ''],
            ['Total Devices', $deviceCounts->total_devices],
            ['Available Devices', $deviceCounts->available_devices],
            ['Total Received Devices', $deviceCounts->assigned_devices],
            ['Damaged Devices', $deviceCounts->damaged_devices],
            ['Sold Devices', $deviceCounts->sold_devices],
            ['', ''],
    
            // Activity
            ['🔄 ACTIVITY', ''],
            ['Total Transactions', $transactionCount],
            ['Device Issues Reported', $deviceIssueCount],
            ['', ''],
    
            // Inventory Breakdown
            ['📦 INVENTORY BY TYPE', ''],
    
            // POS Devices
            ['', ''],
            // ['  Total Received', $deviceCounts->pos_count],
            [' 🖥️ POS DEVICES ', (string) $deviceCounts->pos_count],
            ['  Total Received ', $deviceCounts->pos_count],
            ['  Sold Units', $deviceCounts->sold_pos_count],
            ['  Current Stock', $deviceCounts->pos_count - $deviceCounts->sold_pos_count],
            ['', ''],
    
            // Printers
            ['🖨️ THERMAL PRINTERS', ''],
            // ['  Total Received', $deviceCounts->printer_count],
            ['  Total Received', (string) $deviceCounts->printer_count],
            ['  Sold Units', $deviceCounts->sold_printer_count],
            ['  Current Stock', $deviceCounts->printer_count - $deviceCounts->sold_printer_count],
    
            // Footer
            ['Report Generated', $reportGenerated]
        ];
    
        // Log the data to console
        Log::info('Exported Data:', $data);
    
        return new Collection($data);
    }
    


    public function headings(): array
    {
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 32,
            'B' => 18
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Global Styles
            'A1:B100' => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => [
                    'outline' => ['borderStyle' => 'thin', 'color' => ['rgb' => 'CCCCCC']],
                    'inside' => ['borderStyle' => 'thin', 'color' => ['rgb' => 'CCCCCC']]
                ]
            ],

            // Main Title
            1 => [
                'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2F5597']],
                'alignment' => ['horizontal' => 'center']
            ],

            // Section Headers
            'A3:A4' => ['font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '2F5597']]],
            'A8:A9' => ['font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '2F5597']]],
            'A12:A13' => ['font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '2F5597']]],

            // Value Cells
            'B4:B6' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'right']],
            'B9:B10' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'right']],
            'B16:B18' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'right']],
            'B21:B23' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'right']],

            // Footer
            'A25:B25' => ['font' => ['italic' => true, 'size' => 9], 'alignment' => ['horizontal' => 'right']]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $colors = [
                    'white' => (new \PhpOffice\PhpSpreadsheet\Style\Color())->setRGB('FFFFFF'),
                    'lightBlue' => (new \PhpOffice\PhpSpreadsheet\Style\Color())->setRGB('D9E1F2'),
                    'lightOrange' => (new \PhpOffice\PhpSpreadsheet\Style\Color())->setRGB('FCE4D6'),
                    'lightGray' => (new \PhpOffice\PhpSpreadsheet\Style\Color())->setRGB('F3F3F3'),
                    'borderBlue' => (new \PhpOffice\PhpSpreadsheet\Style\Color())->setRGB('8EA9DB')
                ];

                // Main Title
                $sheet->mergeCells('A1:B1');
                $sheet->getRowDimension(1)->setRowHeight(24);

                // Format Sections
                $this->formatSection($sheet, 'CORE METRICS', 3, 6, $colors['lightBlue'], $colors['borderBlue']);
                $this->formatSection($sheet, 'ACTIVITY', 8, 3, $colors['lightBlue'], $colors['borderBlue']);
                $this->formatSection($sheet, 'INVENTORY BY TYPE', 12, 12, $colors['lightBlue'], $colors['borderBlue']);

                // Format Categories
                $this->formatCategory($sheet, 'POS DEVICES', 15, $colors['lightOrange']);
                $this->formatCategory($sheet, 'THERMAL PRINTERS', 20, $colors['lightOrange']);

                // Format Data Rows
                $this->formatDataRows($sheet, [4, 5, 6, 9, 10, 16, 17, 18, 21, 22, 23], $colors['white'], $colors['lightGray']);

                // Freeze headers
                $sheet->freezePane('A4');
            }
        ];
    }

    protected function formatSection($sheet, $title, $startRow, $height, $fillColor, $borderColor)
    {
        $sheet->mergeCells("A{$startRow}:B{$startRow}");
        $sheet->getRowDimension($startRow)->setRowHeight(20);
        $sheet->getStyle("A{$startRow}")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->setStartColor($fillColor);
        $sheet->getStyle("A{$startRow}:B" . ($startRow + $height))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle('medium')
            ->setColor($borderColor);
    }

    protected function formatCategory($sheet, $title, $startRow, $fillColor)
    {
        $sheet->mergeCells("A{$startRow}:B{$startRow}");
        $sheet->getStyle("A{$startRow}")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->setStartColor($fillColor);
    }

    protected function formatDataRows($sheet, $rows, $evenColor, $oddColor)
    {
        foreach ($rows as $row) {
            $color = $row % 2 === 0 ? $evenColor : $oddColor;
            $sheet->getStyle("A{$row}:B{$row}")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->setStartColor($color);
        }
    }
}


// 🟢 Sheet 2: Office-wise Device Counts
class OfficeDeviceCountsSheet implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithEvents
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
        return [
            ['🏢 Office-wise Device Counts'], // Title row
            [ // Column headers
                'Office ID',
                'Office Name',
                'Region',
                'POS Count',
                'Printer Count'
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,  // Office ID
            'B' => 25,  // Office Name
            'C' => 20,  // Region
            'D' => 12,  // POS Count
            'E' => 15   // Printer Count
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Title row
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'center'],
            ],
            2 => [ // Header row
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ],
            'A:E' => [ // All data cells
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Merge title row
                $sheet->mergeCells('A1:E1');

                // Apply gray background to headers
                $sheet->getStyle('A2:E2')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Light gray
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Add borders to all data cells
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A2:E{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}

// 🟢 Sheet 4: Devices List
class DevicesSheet implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithEvents
{
    public function collection()
    {
        return Device::select(
            'devices.id',
            'devices.item_name',
            'devices.model_number',
            'devices.serial_number',
            'devices.status',
            'devices.price',
            'devices.sold_price',
            'offices.region AS office_region', // 🔹 Fetch region from offices table
            'devices.region_code',
            'offices.name AS office_name',
            'users.name AS employee_name',
            'devices.customer_tin',
            'devices.sold_date'
        )
            ->leftJoin('users', 'devices.user_code', '=', 'users.user_code')
            ->leftJoin('offices', 'devices.office_id', '=', 'offices.id') // 🔹 Join offices table
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Devices List'], // Custom header
            [
                'ID',
                'Item Name',
                'Model Number',
                'Serial Number',
                'Status',
                'Price',
                'Sold Price',
                'Office Region',
                'Region Code',
                'Office Name',
                'Employee Name',
                'Customer TIN',
                'Sold Date'
            ]
        ];
    }

    // Set column widths for better spacing
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 20,
            'D' => 25,
            'E' => 15,
            'F' => 12,
            'G' => 15,
            'H' => 20,
            'I' => 8,
            'J' => 20,
            'K' => 25,
            'L' => 20,
            'M' => 18,
        ];
    }

    // Apply styles for header row and title
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Devices List title
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'center'],
            ],
            2 => [ // Column headers
                'font' => ['bold' => true],
            ],
        ];
    }

    // Add gray background for column headers and merge "Devices List"
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Merge first row for "Devices List" title
                $sheet->mergeCells('A1:M1');

                // Apply gray background to the column headers
                $sheet->getStyle('A2:M2')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Gray color
                    ],
                ]);
            },
        ];
    }
}
