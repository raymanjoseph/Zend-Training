<?php 

namespace Payment\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;

class JobOrderTable 
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveJobOrder(JobOrder $JobOrder)
	{
		$data = array(
			"customer_id" 		=> $JobOrder->customer_id,
			"order_datetime" 	=> $JobOrder->order_datetime,
			"sub_total" 		=> $JobOrder->sub_total,
			"taxable_amount" 	=> $JobOrder->taxable_amount,
			"discount" 			=> $JobOrder->discount,
			"tax" 				=> $JobOrder->tax,
			"shipping_total" 	=> $JobOrder->shipping_total,
			"total_amount" 		=> $JobOrder->total_amount,
			"total_weight" 		=> $JobOrder->total_weight,
			"company_name" 		=> $JobOrder->company_name,
			"email" 			=> $JobOrder->email,
			"first_name" 		=> $JobOrder->first_name,
			"last_name" 		=> $JobOrder->last_name,
			"phone" 			=> $JobOrder->phone,
			"shipping_mehod" 	=> $JobOrder->shipping_method,
			"shipping_name" 	=> $JobOrder->shipping_name,
			"shipping_address1" => $JobOrder->shipping_address1,
			"shipping_address2" => $JobOrder->shipping_address2,
			"shipping_address3" => $JobOrder->shipping_address3,
			"shipping_city" 	=> $JobOrder->shipping_city,
			"shipping_state" 	=> $JobOrder->shipping_state,
			"shipping_country" 	=> $JobOrder->shipping_country,
		);

		$this->tableGateway->insert($data);

        return $this->tableGateway->getLastInsertValue();
	}

	public function getJobOrders($cartId)
	{	

		$sql 	= $this->tableGateway->getSql();
		$select = $sql->select();
		$select->join(array('ji' => 'job_items'), 'ji.job_order_id = job_orders.job_order_id', array('total_price' => new Expression('ji.price'), 'job_item_id','unit_price','qty'), 'LEFT');
		$select->join(array('p' => 'products'), 'p.product_id = ji.product_id', array('product_name','product_image','product_desc'), 'LEFT');
		$select->where->equalTo('job_orders.job_order_id', $cartId);
	
		$result = $this->tableGateway->selectWith($select)->getDataSource();
		return $result;

	}
}