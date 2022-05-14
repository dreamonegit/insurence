<?php
namespace App\Exports;

use App\CustomerExports;

use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExports implements FromCollection
{
    public function collection()
    {
        return Customer::all();
    }
}