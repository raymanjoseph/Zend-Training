<?php 

namespace Cart\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;

class CartTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function getCartDetails($cartId)
	{	

		$sql 	= $this->tableGateway->getSql();
		$select = $sql->select();
		$select->join(array('ci' => 'cart_items'), 'ci.cart_id = carts.cart_id',array('qty' => new Expression('SUM(qty)'), 'total_price' => new Expression('SUM(ci.price)'),'unit_price','weight','cart_item_id','cart_id'), 'LEFT');
		$select->join(array('p' => 'products'), 'p.product_id = ci.product_id', array('product_name','product_image','product_desc'), 'LEFT');
		$select->where->equalTo('carts.cart_id', $cartId);
		$select->group('p.product_id');
	
		$result = $this->tableGateway->selectWith($select)->getDataSource();
		return $result;
	}



	public function deleteCart($id)
	{
		 $this->tableGateway->delete(array('cart_id' => $id));
	}

	public function update(Cart $Cart, $User, $Summation)
	{
		$data = array(
			"customer_id" 		=> $User->customer_id,
			"sub_total" 		=> $Summation->sub_total,
			"shipping_total" 	=> $Summation->total_shipping,
			"total_amount" 		=> $Summation->total_amount,
			"total_weight" 		=> $Summation->total_weight,
			"company_name" 		=> $User->company_name,
			"email" 			=> $User->email,
			"first_name" 		=> $User->first_name,
			"last_name" 		=> $User->last_name,
			"phone" 			=> $User->phone,
			"shipping_mehod" 	=> $Cart->shipping_mehod,
			"shipping_name" 	=> $Cart->shipping_name,
			"shipping_address1" => $Cart->shipping_address1,
			"shipping_address2" => $Cart->shipping_address2,
			"shipping_address3" => $Cart->shipping_address3,
			"shipping_city" 	=> $Cart->shipping_city,
			"shipping_state" 	=> $Cart->shipping_state,
			"shipping_country" 	=> $Cart->shipping_country,
		);
		
		$result = $this->tableGateway->update($data, array('cart_id' => $Summation->cart_id));
		
        return $result;
	}

	public function saveCart(Cart $Cart)
	{
		$date = date('Y-m-d H:i:s');
	
		$data = array(
			"customer_id" 		=> $Cart->customer_id,
			"order_datetime" 	=> $date,
			"sub_total" 		=> $Cart->sub_total,
			"taxable_amount" 	=> $Cart->taxable_amount,
			"discount" 			=> $Cart->discount,
			"tax" 				=> $Cart->tax,
			"shipping_total" 	=> $Cart->shipping_total,
			"total_amount" 		=> $Cart->total_amount,
			"total_weight" 		=> $Cart->total_weight,
			"company_name" 		=> $Cart->company_name,
			"email" 			=> $Cart->email,
			"first_name" 		=> $Cart->first_name,
			"last_name" 		=> $Cart->last_name,
			"phone" 			=> $Cart->phone,
			"shipping_mehod" 	=> $Cart->shipping_mehod,
			"shipping_name" 	=> $Cart->shipping_name,
			"shipping_address1" => $Cart->shipping_address1,
			"shipping_address2" => $Cart->shipping_address2,
			"shipping_address3" => $Cart->shipping_address3,
			"shipping_city" 	=> $Cart->shipping_city,
			"shipping_state" 	=> $Cart->shipping_state,
			"shipping_country" 	=> $Cart->shipping_country,
		);
		$this->tableGateway->insert($data);

        return $this->tableGateway->getLastInsertValue();
	}
}