<?php

namespace App\Exports;

use App\Models\Galery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GaleryExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Galery::with('uploader')->get()->map(function ($gallery, $index) {
            // Format deskripsi agar lebih rapih
            $description = strip_tags($gallery->description);
            if (strlen($description) > 100) {
                $description = substr($description, 0, 100) . '...';
            }

            // Format uploaded_at
            $uploadedAt = is_string($gallery->uploaded_at) ? $gallery->uploaded_at : $gallery->uploaded_at->format('d M Y H:i');

            return [
                'No' => $index + 1,
                'Judul' => $gallery->title,
                'Kategori' => strtoupper($gallery->category),
                'Deskripsi' => $description,
                'Nama File Foto' => $gallery->photo_url,
                'Pengunggah' => $gallery->uploader->name ?? 'Unknown',
                'Tanggal Unggah' => $uploadedAt
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
            'Judul',
            'Kategori',
            'Deskripsi',
            'Nama File Foto',
            'Pengunggah',
            'Tanggal Unggah'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Galeri';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A1', 'LAPORAN');
                $event->sheet->setCellValue('A2', 'DATA GALERI ORGANISASI');
                $event->sheet->setCellValue('A3', 'Dicetak pada: ' . date('d M Y H:i:s'));

                // Membuat judul menjadi bold
                $event->sheet->getStyle('A1:A2')->getFont()->setBold(true);

                // Membuat judul menjadi lebih besar
                $event->sheet->getStyle('A1')->getFont()->setSize(16);
                $event->sheet->getStyle('A2')->getFont()->setSize(14);

                // Menambahkan baris kosong setelah judul
                $event->sheet->insertNewRowBefore(5, 1);

                // Memindahkan header ke baris 5
                $event->sheet->getStyle('A5:G5')->getFont()->setBold(true);
                $event->sheet->getStyle('A5:G5')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF1F3984');
                $event->sheet->getStyle('A5:G5')->getFont()->getColor()->setARGB('FFFFFFFF');

                // Menambahkan border pada tabel
                $highestRow = $event->sheet->getHighestDataRow();
                $event->sheet->getStyle('A5:G' . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Menambahkan footer
                $event->sheet->setCellValue('A' . ($highestRow + 2), 'Total Foto: ' . ($highestRow - 5));
                $event->sheet->setCellValue('A' . ($highestRow + 3), 'Sumber: Sistem Informasi Organisasi');

                // Mengatur lebar kolom otomatis
                foreach (range('A', 'G') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
