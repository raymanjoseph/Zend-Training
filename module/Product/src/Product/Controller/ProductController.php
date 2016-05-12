<?php 

namespace Product\Controller;

use Product\Filter\ProductFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class ProductController extends AbstractActionController
{

	public function indexAction()
	{	
		$sm = $this->getServiceLocator();

		$ProductTable = $sm->get('ProductTable');
		
		$products = $ProductTable->fetchAll();

		$data = array('products'=>$products);
		return new ViewModel($data);
	}

	public function productAction()
	{	
		
		$id = $this->params()->fromRoute('id', 0);
		$sm = $this->getServiceLocator();
		
		$Session = $sm->get('Session');

		if (!$id) { 
			$this->redirect()->toRoute('product');
		}  else {
			
			$ProductTable 	= $sm->get('ProductTable');
			$ProductForm 	= $sm->get('ProductForm');
			$product = $ProductTable->fetchById($id);
			
			$request = $this->getRequest();
			if ($request->isPost()) {
				$ProductFilter = $sm->get('ProductFilter');
				$ProductForm->setInputFilter($ProductFilter);
				$ProductForm->setData($request->getPost());
				
				if ($ProductForm->isValid()) {
					$CartItemTable 	= $sm->get('CartItemTable');
					$CartItem 		= $sm->get('CartItem');
					$Cart 			= $sm->get('Cart');
					$CartTable 		= $sm->get('CartTable');
					$Session 		= $sm->get('Session');
					
					$date 			= date('Y-m-d H:i:s');
					$customer_id 	= $Session->user_id;
					$cartDetail = array('order_datetime' => $date, 'customer_id' =>$customer_id);
					if (!isset($Session->cart_id)) {
						$Cart->exchangeArray($cartDetail );
						
						$CartId = $CartTable->saveCart($Cart);
						$Session->cart_id = $CartId;
					}
					$CartItem->exchangeArray($ProductForm->getData());
					$CartItemTable->saveProduct($CartItem, $Session->cart_id);

					$this->redirect()->toRoute('cart');
				}
			} 
		}

		return new ViewModel(array('product' => $product, 'form' => $ProductForm));
	}
}