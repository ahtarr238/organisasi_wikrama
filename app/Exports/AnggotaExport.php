<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Role',
            'Tanggal Bergabung',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }

    /**
    * @param User $user
    * @return array
    */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->role,
            $user->join_date ? $user->join_date->format('d M Y') : '-',
            $user->created_at->format('d M Y H:i'),
            $user->updated_at->format('d M Y H:i')
        ];
    }
}