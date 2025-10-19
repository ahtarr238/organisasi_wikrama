<?php

namespace App\Exports;

use App\Models\WorkProgram;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class WorkProgramExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return WorkProgram::with('creator')->get()->map(function ($program, $index) {
            // Format status agar lebih mudah dibaca
            $statusText = $program->status;
            if ($program->status == 'on_going') {
                $statusText = 'Sedang Berlangsung';
            } elseif ($program->status == 'completed') {
                $statusText = 'Selesai';
            } elseif ($program->status == 'cancelled') {
                $statusText = 'Dibatalkan';
            }

            // Hitung durasi dalam hari
            if (is_string($program->tgl_mulai)) {
                $startDate = new \DateTime($program->tgl_mulai);
            } else {
                $startDate = $program->tgl_mulai;
            }
            
            if (is_string($program->tgl_selesai)) {
                $endDate = new \DateTime($program->tgl_selesai);
            } else {
                $endDate = $program->tgl_selesai;
            }
            
            $duration = $startDate->diff($endDate)->days + 1; // +1 untuk menghitung hari pertama

            // Format deskripsi agar lebih rapih
            $description = strip_tags($program->deskripsi);
            if (strlen($description) > 100) {
                $description = substr($description, 0, 100) . '...';
            }

            return [
                'No' => $index + 1,
                'Nama Program' => $program->nama_program,
                'Deskripsi' => $description,
                'Periode' => (is_string($program->tgl_mulai) ? $program->tgl_mulai : $program->tgl_mulai->format('d M Y')) . ' - ' . (is_string($program->tgl_selesai) ? $program->tgl_selesai : $program->tgl_selesai->format('d M Y')),
                'Durasi' => $duration . ' hari',
                'Status' => $statusText,
                'Pembuat' => $program->creator->name ?? 'Unknown',
                'Organisasi' => $program->organization_id == 1 ? 'OSIS' : 'MPK'
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
            'Nama Program',
            'Deskripsi',
            'Periode',
            'Durasi',
            'Status',
            'Pembuat',
            'Organisasi'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Program Kerja';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A1', 'LAPORAN');
                $event->sheet->setCellValue('A2', 'DATA PROGRAM KERJA ORGANISASI');
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
                $event->sheet->setCellValue('A' . ($highestRow + 2), 'Total Program Kerja: ' . ($highestRow - 5));
                $event->sheet->setCellValue('A' . ($highestRow + 3), 'Sumber: Sistem Informasi Organisasi');

                // Mengatur lebar kolom otomatis
                foreach (range('A', 'H') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
