<?php 

namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class CartController extends AbstractActionController
{


	public function indexAction()
	{		
		$sm = $this->getServiceLocator();

		$Session 		= $sm->get('Session');
		$CartItemTable 	= $sm->get('CartItemTable');
	
		if ($Session->cart_id) {

			$CartDetails = $CartItemTable->getCartItemDetails($Session->cart_id);
		

			$productCount=0;
			foreach($CartDetails as $CartDetail) {
				$Cart[] 	 	= $CartDetail;
				$productCount 	+= $CartDetail['count_cart_item'];
				
			}
			
			$Session->count = $productCount;
			if (!empty($Cart)) {
				return new ViewModel(array(
					'cart_items' => $Cart
				));
			}
		}
	}

	public function deleteByItemAction()
	{
		$sm = $this->getServiceLocator();

		$CartItemTable 	= $sm->get('CartItemTable');

		$id = $this->params()->fromRoute('id', 0);

		if (!$id) {
			$this->redirect()->toRoute('cart');
		}  else {

			$CartItemTable->deleteCartItem($id);
			
			$this->redirect()->toRoute('cart');
		}
		return new ViewModel();
	}
}