<?php 

namespace Payment\Model;

use Zend\Db\TableGateway\TableGateway;

class JobItemTable 
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveJobItem(JobItem $JobItem)
	{
		$data = array(
			"job_order_id" => $JobItem->job_order_id,
			"product_id" => $JobItem->product_id,
			"weight" => $JobItem->weight,
			"qty" => $JobItem->qty,
			"unit_price" => $JobItem->unit_price,
			"price" => $JobItem->price,
		);

		$this->tableGateway->insert($data);

		return $this->tableGateway->getLastInsertValue();
	}
}