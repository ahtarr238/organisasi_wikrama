<?php

namespace App\Exports;

use App\Models\DailyActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DailyActivityExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DailyActivity::with('user')->get()->map(function ($activity, $index) {
            // Format status agar lebih mudah dibaca
            $statusText = $activity->status;
            if ($activity->status == 'on_going') {
                $statusText = 'Sedang Berlangsung';
            } elseif ($activity->status == 'completed') {
                $statusText = 'Selesai';
            } elseif ($activity->status == 'cancelled') {
                $statusText = 'Dibatalkan';
            }

            // Format deskripsi agar lebih rapih
            $description = strip_tags($activity->description);
            if (strlen($description) > 100) {
                $description = substr($description, 0, 100) . '...';
            }

            return [
                'No' => $index + 1,
                'Judul Kegiatan' => $activity->title,
                'Deskripsi' => $description,
                'Tanggal' => is_string($activity->date) ? $activity->date : $activity->date->format('d M Y'),
                'Waktu' => $activity->start_time . ' - ' . $activity->end_time,
                'Status' => $statusText,
                'Penanggung Jawab' => $activity->user->name ?? 'Unknown',
                'Organisasi' => $activity->organization_id == 1 ? 'OSIS' : 'MPK'
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Judul Kegiatan',
            'Deskripsi',
            'Tanggal',
            'Waktu',
            'Status',
            'Penanggung Jawab',
            'Organisasi'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Kegiatan';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A1', 'LAPORAN');
                $event->sheet->setCellValue('A2', 'DATA KEGIATAN ORGANISASI');
                $event->sheet->setCellValue('A3', 'Dicetak pada: ' . date('d M Y H:i:s'));

                // Membuat judul menjadi bold
                $event->sheet->getStyle('A1:A2')->getFont()->setBold(true);

                // Membuat judul menjadi lebih besar
                $event->sheet->getStyle('A1')->getFont()->setSize(16);
                $event->sheet->getStyle('A2')->getFont()->setSize(14);

                // Menambahkan baris kosong setelah judul
                $event->sheet->insertNewRowBefore(5, 1);

                // Memindahkan header ke baris 5
                $event->sheet->getStyle('A5:H5')->getFont()->setBold(true);
                $event->sheet->getStyle('A5:H5')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF1F3984');
                $event->sheet->getStyle('A5:H5')->getFont()->getColor()->setARGB('FFFFFFFF');

                // Menambahkan border pada tabel
                $highestRow = $event->sheet->getHighestDataRow();
                $event->sheet->getStyle('A5:H' . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Menambahkan footer
                $event->sheet->setCellValue('A' . ($highestRow + 2), 'Total Kegiatan: ' . ($highestRow - 5));
                $event->sheet->setCellValue('A' . ($highestRow + 3), 'Sumber: Sistem Informasi Organisasi');

                // Mengatur lebar kolom otomatis
                foreach (range('A', 'H') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
