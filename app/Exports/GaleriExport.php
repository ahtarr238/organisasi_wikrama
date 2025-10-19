<?php

namespace App\Exports;

use App\Models\Galery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GaleriExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Galery::with('uploader')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Kategori',
            'Deskripsi',
            'Pengunggah',
            'Tanggal Unggah',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }

    /**
    * @param Galery $galeri
    * @return array
    */
    public function map($galeri): array
    {
        return [
            $galeri->id,
            $galeri->title,
            strtoupper($galeri->category),
            $galeri->description,
            $galeri->uploader->name ?? '-',
            $galeri->uploaded_at->format('d M Y H:i'),
            $galeri->created_at->format('d M Y H:i'),
            $galeri->updated_at->format('d M Y H:i')
        ];
    }
}