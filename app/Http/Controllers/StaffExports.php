<?php
namespace App\Exports;

use App\Staff;

use Maatwebsite\Excel\Concerns\FromCollection;

class StaffExports implements FromCollection
{
    public function collection()
    {
        return Staff::all();
    }
}