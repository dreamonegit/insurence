<?php
namespace App\Exports;

use App\Models\Healthinsurance;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExports implements FromCollection,WithHeadings,WithMapping
{
	 protected $post;

	 function __construct($postdata) {
			$this->post = $postdata;
	 }

    public function collection()
    {
        return Healthinsurance::select('*','created_at','updated_at')->whereBetween('created_at', [$this->post['start_date'], $this->post['end_date']])->get();
    }
    public function map($row): array
    {
        return [
		    $row->customer_id,
            $row->insurance_type,
			$row->insurance_date,
			$row->insurance_expiry_date,
            $row->sm_ssm_name,
            $row->payonehub_code,
			$row->policybazaar_code	,
            $row->advisor_name,
			$row->application_no,
            $row->company_name,
			$row->plan_name,
            $row->sum_assured,
			$row->emi,
            $row->emi_month,
            $row->emi_due,
            $row->premium_paying_term,
			$row->policy_term,
            $row->gross_premium,
            $row->net_premium,
            $row->policy_no,
			$row->status == 1 ? 'Active' : 'In-Active',
            date('Y-m-d', strtotime($row->created_at)),
			date('Y-m-d', strtotime($row->updated_at)),
        ];
    }
     public function headings(): array
    {
        return [
		    'Customer Id',
			'Insurance Type',
			'Insurance Date',
			'Insurance Expiry Date',
			'SM/SSM Name',
			'Advisor Payonehub Code',
			'Advisor Policybazaar code',
			'Advisor Name',
			'Application Number',
			'Company Name',
			'Plan Name',
			'Sum Assumed',
			'EMI',
			'EMI Month',
			'EMI Due',
			'Premium Paying Term',
			'Policy Term (Total Coverage)',
			'Gross Premium (With GST)',
			'Net Premium',
			'Policy No',
			'Status',
			'Created At',
			'Updated At',
        ];
    }
}