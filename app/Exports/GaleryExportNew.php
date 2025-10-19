<?php

namespace App\Exports;

use App\Models\Galery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GaleryExportNew implements FromCollection, WithHeadings, WithTitle, WithEvents
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
                // Memindahkan header ke baris 1
                $event->sheet->getStyle('A1:G1')->getFont()->setBold(true);

                // Menambahkan border pada tabel
                $highestRow = $event->sheet->getHighestDataRow();
                $event->sheet->getStyle('A1:G' . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Menambahkan footer
                $event->sheet->setCellValue('A' . ($highestRow + 2), 'Total Foto: ' . ($highestRow - 1));
                $event->sheet->setCellValue('A' . ($highestRow + 3), 'Sumber: Sistem Informasi Organisasi');

                // Mengatur lebar kolom otomatis
                foreach (range('A', 'G') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
