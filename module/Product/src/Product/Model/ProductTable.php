<?php 

namespace Product\Model;

use Zend\Db\TableGateway\TableGateway;

class ProductTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$result = $this->tableGateway->select();
		return $result;
	}

	public function fetchById($id)
	{
		$result = $this->tableGateway->select(array('product_id' => $id));
		return $result->current();
	}

	public function updateQty($pid,$qty)
	{
		$data = array(
                'stock_qty' => $qty,
            );
         $this->tableGateway->update($data, array('product_id' => $pid));
	}
}