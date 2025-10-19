<?php

namespace App\Exports;

use App\Models\DailyActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KegiatanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DailyActivity::with('user')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Judul Kegiatan',
            'Deskripsi',
            'Pelaksana',
            'Tanggal Kegiatan',
            'Status',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }

    /**
    * @param DailyActivity $kegiatan
    * @return array
    */
    public function map($kegiatan): array
    {
        return [
            $kegiatan->id,
            $kegiatan->title,
            $kegiatan->description,
            $kegiatan->user->name ?? '-',
            $kegiatan->activity_date->format('d M Y'),
            $kegiatan->status,
            $kegiatan->created_at->format('d M Y H:i'),
            $kegiatan->updated_at->format('d M Y H:i')
        ];
    }
}