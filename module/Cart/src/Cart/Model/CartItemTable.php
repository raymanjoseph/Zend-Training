<?php 

namespace Cart\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;

class CartItemTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveProduct(CartItem $CartItem, $cart_id)
	{
		$data = array(
			"cart_id" => $cart_id,
			"product_id" => $CartItem->product_id,
			"weight" => $CartItem->weight,
			"qty" => $CartItem->qty,
			"unit_price" => $CartItem->unit_price,
			"price" => $CartItem->price,
		);

		$this->tableGateway->insert($data);

		return $this->tableGateway->getLastInsertValue();
	}

	public function getCartItemByCartId($id)
	{
		$result = $this->tableGateway->select(array('cart_id' => $id));
        return $result;
	}

	public function getCartItemDetails($CartId)
	{	
		
		$sql 	= $this->tableGateway->getSql();
		$select = $sql->select();
		$select->columns(array('qty' => new Expression('SUM(qty)'), 'total_price' => new Expression('SUM(cart_items.price)'),'count_cart_item' => new Expression('COUNT(cart_item_id)'),'unit_price','weight','cart_item_id','cart_id'));
		$select->join(array('p' => 'products'), 'p.product_id = cart_items.product_id', array('*'), 'LEFT');
		$select->where->equalTo('cart_items.cart_id', $CartId);
		$select->group('p.product_id');

		$result = $this->tableGateway->selectWith($select)->getDataSource();

		return $result;
	}

	public function deleteCartItem($id)
	{
		$cartItem = $this->getCartItemDetails($id);
        if ($cartItem) {
            $this->tableGateway->delete(array('cart_item_id' => $id));
        }
	}

	public function deleteCartItemByCartId($id)
	{
		$this->tableGateway->delete(array('cart_id' => $id));
	}

	public function updateCartId($CartItemId, $CartId)
	{
		$data = array(
                'cart_id' => $CartId,
            );
         $this->tableGateway->update($data, array('cart_item_id' => $CartItemId));
	}

}