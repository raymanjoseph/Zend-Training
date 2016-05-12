<?php 

namespace Payment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PaymentController extends AbstractActionController
{
	public function indexAction()
	{	
		$sm = $this->getServiceLocator();
		$Session = $sm->get('Session');
		
		if ($Session->cart_id && $Session->user_id) {
			
			$CartTable		= $sm->get('CartTable');
			$CartDetails 	= $CartTable->getCartDetails($Session->cart_id);

			foreach($CartDetails as $CartDetail) {
				$Cart[] = $CartDetail;
				$CheckCustomerId = $CartDetail['customer_id'];
			}
			if (!empty($Cart)) {
				return new ViewModel(array(
					'cart_items' 	 	=> $Cart,
					'CheckCustomerId' 	=> $CheckCustomerId,
				));
			}
		} else {
			$this->redirect()->toRoute('product');
		}
	}

	public function checkoutAction()
	{
		$sm			= $this->getServiceLocator();
		$Session 	= $sm->get('Session');
		

		if ($Session->cart_id && $Session->user_id) {

			$CartTable 			= $sm->get('CartTable');
			$CartItemTable		= $sm->get('CartItemTable');

			$JobOrder			= $sm->get('JobOrder');
			$JobOrderTable 		= $sm->get('JobOrderTable');
			$JobItem			= $sm->get('JobItem');
			$JobItemTable		= $sm->get('JobItemTable');
			$ProductTable 		= $sm->get('ProductTable');

			$CartDetails 		= $CartTable->getCartDetails($Session->cart_id);
			$CartItemDetails 	= $CartItemTable->getCartItemDetails($Session->cart_id);

			foreach ($CartDetails as $Cart) {
			 	$JobOrder->exchangeArray($Cart);
			
			} 
		
			$JobOrderId = $JobOrderTable->saveJobOrder($JobOrder);
			$Session->job_id = $JobOrderId;
			if ($JobOrderId) {
				$joId = array('job_order_id' => $JobOrderId);
				$qty  =0;
				$pid  =0;
				foreach ($CartItemDetails as $CartItem) {


					//UPDATE QTY OF PRODUCT	
					$qty = abs($CartItem['qty'] - $CartItem['stock_qty']);
					$pid = $CartItem['product_id'];
					$updateQty = $ProductTable->updateQty($pid,$qty);


					// ARRAY MERGE
					$JOmerge = array_merge($CartItem, $joId);
					$JobItem->exchangeArray($JOmerge);
					$result = $JobItemTable->saveJobItem($JobItem);
				}
				$this->redirect()->toRoute('payment', array('action' => 'confirm'));
			}	
		
		} else {
			$this->redirect()->toRoute('product');
		}
	}

	public function confirmAction()
	{
		$sm 		= $this->getServiceLocator();
		$Session 	= $sm->get('Session');
		if ($Session->cart_id && $Session->user_id) {

			$JobOrderTable 	= $sm->get('JobOrderTable');

			$Results = $JobOrderTable->getJobOrders($Session->job_id);

			foreach ($Results as $result) {
				$JobOrders[] 	= $result;
				$shippingInfo 	= $result;
			}
			
			if (!empty($JobOrders)) {
				return new ViewModel(array(
					'JobOrders' 	=> $JobOrders,
					'ShippingInfo'	=> $shippingInfo,
				));
			}
		} else {
			$this->redirect()->toRoute('product');
		}
	}

	public function successAction()
	{
		$sm = $this->getServiceLocator();
		$Session = $sm->get('Session');
		if ($Session->cart_id && $Session->user_id) {
			$this->deleteCart($Session->cart_id);
			unset($Session->count); 
			unset($Session->cart_id); 
			return new ViewModel(array('success' => 'Thank you for shopping!'));
		} else {
			$this->redirect()->toRoute('product');
		}
	}
	public function deleteCart($id)
	{
		$sm = $this->getServiceLocator();
		$CartTable 		= $sm->get('CartTable');
		$CartItemTable	= $sm->get('CartItemTable');

		if ($id) {
			$CartTable->deleteCart($id);
			$CartItemTable->deleteCartItemByCartId($id);
		}
	}
}