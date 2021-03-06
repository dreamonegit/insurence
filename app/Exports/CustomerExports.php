<?php
namespace App\Exports;

use App\Models\Healthinsurance;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
class CustomerExports implements FromCollection,WithHeadings,WithMapping
{
	 protected $post;

	 function __construct($postdata) {
			$this->post = $postdata;
	 }

    public function collection()
    {
    	if($this->post['insurance_type'] == '0')
    	{
    		$rquery =  Healthinsurance::select('health_insurance.*','customers.*')->leftJoin("customers", "customers.id", "=", "health_insurance.customer_id")->where('health_insurance.status','1');
    	}
    	else if($this->post['insurance_type'] > 0 && $this->post['start_date'] == '' || $this->post['end_date'] == '')
    	{
    		$rquery = Healthinsurance::select('health_insurance.*','customers.*')->leftJoin("customers", "customers.id", "=", "health_insurance.customer_id")->where('health_insurance.insurance_type',$this->post['insurance_type'])->where('health_insurance.status','1');
    	}   
    	else
    	{
        	//return Healthinsurance::select('health_insurance.*','customers.*')->leftJoin("customers", "customers.id", "=", "health_insurance.customer_id")->where('health_insurance.insurance_type',$this->post['insurance_type'])->where('health_insurance.status','1')->whereBetween('health_insurance.created_at', [$this->post['start_date'], $this->post['end_date']])->get();
        	$rquery = Healthinsurance::select('health_insurance.*','customers.*')->leftJoin("customers", "customers.id", "=", "health_insurance.customer_id")->where('health_insurance.insurance_type',$this->post['insurance_type'])->where('health_insurance.status','1')->whereDate('health_insurance.created_at','>=',Carbon::parse($this->post['start_date']))->whereDate('health_insurance.created_at','<=',Carbon::parse($this->post['end_date']));
		}

		if($this->post['cid'] != '')
		{
			$rquery->where('health_insurance.staff_id',$this->post['cid']);
		}

		$rquery = $rquery->get(); 

		return $rquery;
    }
    public function map($row): array
    {
    	if($row->insurance_type == '1')
    	{
    		$i_type = 'Health Insurance';
    	}
    	else if($row->insurance_type == '2'){
    		$i_type = 'Motor Insurance';
    	}
    	else
    	{
    		$i_type = 'Life Insurance';
    	}
    	

        return [
		    $row->customer_id,
            $row->first_name." ".$row->last_name,
			$row->mobile,
            $row->email,
            $row->city,
            $i_type,
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
		    'Customer Name',
		    'Customer Mobile',
		    'Customer Email',
		   	'Customer City',
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