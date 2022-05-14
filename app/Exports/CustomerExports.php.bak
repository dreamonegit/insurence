<?php
namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

class StaffExports implements FromCollection,WithHeadings,WithMapping
{
	 protected $post;

	 function __construct($postdata) {
			$this->post = $postdata;
	 }
    public function collection()
    {
        return User::select('id','name','email','mobile','status','created_at','updated_at')->whereBetween('created_at', [$this->post['start_date'], $this->post['end_date']])->where('role',2)->get();
    }
    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->email,
			$row->mobile,
			$row->status == 0 ? 'Active' : 'In-Active',
            date('Y-m-d', strtotime($row->created_at)),
			date('Y-m-d', strtotime($row->updated_at)),
        ];
    }
     public function headings(): array
    {
        return [
            'id',
            'Name',
			'E-mail',
			'Mobile Number',
			'Status',
			'Created At',
			'Updated At',
        ];
    }
}