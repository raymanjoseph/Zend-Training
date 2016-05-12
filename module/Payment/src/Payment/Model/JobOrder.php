<?php 

namespace Payment\Model;

class JobOrder
{
	public $job_order_id;
	public $customer_id;
	public $order_datetime;
	public $sub_total;
	public $taxable_amount;
	public $discount;
	public $tax;
	public $shipping_total;
	public $total_amount;
	public $total_weight;
	public $company_name;
	public $email;
	public $first_name;
	public $last_name;
	public $phone;
	public $shipping_method;
	public $shipping_name;
	public $shipping_address1;
	public $shipping_address2;
	public $shipping_address3;
	public $shipping_city;
	public $shipping_state;
	public $shipping_country;


	public function exchangeArray($data)
	{
		$this->job_order_id 		= (!empty($data['job_order_id'])) 		? $data['job_order_id'] 		: 0;
		$this->customer_id   		= (!empty($data['customer_id'])) 		? $data['customer_id'] 			: 0;
		$this->order_datetime 		= (!empty($data['order_datetime'])) 	? $data['order_datetime'] 		: 0;
		$this->sub_total 			= (!empty($data['sub_total'])) 			? $data['sub_total']			: 0;
		$this->taxable_amount 		= (!empty($data['taxable_amount'])) 	? $data['taxable_amount'] 		: 0;
		$this->discount 			= (!empty($data['discount'])) 			? $data['discount'] 			: 0;
		$this->tax 					= (!empty($data['tax'])) 				? $data['tax'] 					: 0;
		$this->shipping_total   	= (!empty($data['shipping_total'])) 	? $data['shipping_total'] 		: 0;
		$this->total_amount 		= (!empty($data['total_amount'])) 		? $data['total_amount'] 		: 0;
		$this->total_weight 		= (!empty($data['total_weight'])) 		? $data['total_weight']			: 0;
		$this->company_name 		= (!empty($data['company_name'])) 		? $data['company_name'] 		: null;
		$this->email 				= (!empty($data['email'])) 				? $data['email'] 				: 0;
		$this->first_name 			= (!empty($data['first_name'])) 		? $data['first_name'] 			: 0;
		$this->last_name 			= (!empty($data['last_name'])) 			? $data['last_name'] 			: 0;
		$this->phone   				= (!empty($data['phone'])) 				? $data['phone'] 				: null;
		$this->shipping_method 		= (!empty($data['shipping_method'])) 	? $data['shipping_method'] 		: 0;
		$this->shipping_name 		= (!empty($data['shipping_name'])) 		? $data['shipping_name']		: 0;
		$this->shipping_address1	= (!empty($data['shipping_address1'])) 	? $data['shipping_address1'] 	: 0;
		$this->shipping_address2 	= (!empty($data['shipping_address2'])) 	? $data['shipping_address2'] 	: null;
		$this->shipping_address3 	= (!empty($data['shipping_address3']))	? $data['shipping_address3']	: null;
		$this->shipping_city   		= (!empty($data['shipping_city'])) 		? $data['shipping_city'] 		: 0;
		$this->shipping_state 		= (!empty($data['shipping_state'])) 	? $data['shipping_state'] 		: 0;
		$this->shipping_country 	= (!empty($data['shipping_country'])) 	? $data['shipping_country']		: 0;

	}

	public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}