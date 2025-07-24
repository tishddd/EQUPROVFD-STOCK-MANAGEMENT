<?php

namespace App\Exports;

use App\Models\Device;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BatchDevicesExport implements WithMultipleSheets
{
    protected $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    public function sheets(): array
    {
        return [
            new BatchDevicesSummarySheet($this->batchId),
            new BatchDevicesDetailSheet($this->batchId),
        ];
    }
}

class BatchDevicesSummarySheet implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize, WithEvents
{
    protected $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    public function collection()
    {
        return Device::where('batch_id', $this->batchId)
            ->selectRaw('item_name, 
                COUNT(*) AS total_received,
                SUM(CASE WHEN status = "in_office" THEN 1 ELSE 0 END) AS in_office,
                SUM(CASE WHEN status = "sold" THEN 1 ELSE 0 END) AS sold,
                SUM(CASE WHEN status = "damaged" THEN 1 ELSE 0 END) AS damaged')
            ->groupBy('item_name')
            ->orderBy('item_name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Item Name',
            'Total Received',
            'In Office',
            'Sold',
            'Damaged',
        ];
    }

    public function title(): string
    {
        return 'Summary';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // First row (headings)
                'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4CAF50']
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function ($event) {
                $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $event->sheet->getDelegate()->freezePane('A2');
            },
        ];
    }
}

class BatchDevicesDetailSheet implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, ShouldAutoSize, WithEvents
{
    protected $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    public function collection()
    {
        return Device::where('batch_id', $this->batchId)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Item Name',
            'Model Number',
            'Serial Number',
            'Status',
            'Region Code',
            'Office ID',
            'Employee ID',
            'User Code',
            'Price',
            'Sold Price',
            'Customer TIN',
            'Sold Date',
            'Batch ID',
            'Created At',
        ];
    }

    public function map($device): array
    {
        return [
            $device->id,
            $device->item_name,
            $device->model_number,
            $device->serial_number,
            $device->status,
            $device->region_code,
            $device->office_id,
            $device->employee_id,
            $device->user_code,
            $device->price,
            $device->sold_price,
            $device->customer_tin,
            $device->sold_date,
            $device->batch_id,
            $device->created_at,
        ];
    }

    public function title(): string
    {
        return 'Details';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2196F3']
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function ($event) {
                $cellRange = 'A1:O1';
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $event->sheet->getDelegate()->freezePane('A2');
            },
        ];
    }
}
