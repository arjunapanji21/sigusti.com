<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::where('is_admin', false)->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Status',
            'Joined Date'
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->phone ?? 'Not set',
            $user->email_verified_at ? 'Verified' : 'Unverified',
            $user->created_at->format('d/m/Y H:i:s')
        ];
    }
}
