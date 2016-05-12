<?php 

namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ShippingController extends AbstractActionController
{
	public function indexAction()
	{
		return new ViewModel();
	}

	public function infoAction()
	{
		$sm = $this->getServiceLocator();	

		$ShippingForm 	= $sm->get('ShippingForm');
		$Session 		= $sm->get('Session');

		if (!$Session->cart_id || !$Session->user_id) {
			$this->redirect()->toRoute('product');
		} else {
			$request = $this->getRequest();
			if ($request->isPost()) {

				$ShippingFilter = $sm->get('ShippingFilter');
				$ShippingForm->setInputFilter($ShippingFilter);
				$ShippingForm->setData($request->getPost());

				if ($ShippingForm->isValid()) {
					
					$Cart 			= $sm->get('Cart');
					$CartTable 		= $sm->get('CartTable');
					$User 			= $sm->get('User');
					$UserTable 		= $sm->get('UserTable');


					// USER INFO
					$UserInfo 		= $UserTable->getUserById($Session->user_id);

					// GETTING AMOUNTS 
					$method 		= $request->getPost()->shipping_mehod;
					$Amount 		= $this->amount();

					
					//var_dump($Amount);
					if ($Amount['sub_total']) {

						$total_weight   = $Amount['total_weight'];
						$sub_total		= $Amount['sub_total'];
						$total_shipping = $this->shippingRate($method, $total_weight);
						$total_amount 	= $total_shipping+$sub_total;

						$Summation = (object)array(
							'cart_id' 			=> $Session->cart_id,
							'total_weight' 		=> $total_weight,
							'sub_total' 		=> $sub_total,
							'total_shipping' 	=> $total_shipping,
							'total_amount' 		=> $total_amount,
						);

						
						// SAVING TO DB
						$Cart->exchangeArray($ShippingForm->getData()); 
						$return = $CartTable->update($Cart, $UserInfo, $Summation);


						if ($return) {

							$this->redirect()->toRoute('payment');
						}
						
					} 
				} else {
					var_dump('false');
				}
			}
		}
		
		return new ViewModel(array('form' => $ShippingForm));
	}

	public function amount()
	{

		$sm 					= $this->getServiceLocator();
		$CartItemTable 			= $sm->get('CartItemTable');
		$Session 				= $sm->get('Session');
		$cart_id 				= $Session->cart_id;
		$result['total_weight'] = '';
		$result['sub_total'] 	= '';


		
		$cartItems = $CartItemTable->getCartItemByCartId($cart_id);
		
	
		if($cartItems) {

			foreach($cartItems as $cartItem) {

				$result['total_weight'] += $cartItem->weight;
				$result['sub_total'] 	+= $cartItem->price;
			}
		}

		return $result;
	}

	public function shippingRate($method, $input)
	{
		$num 		= ceil($input);
		$total_rate = 0;
		$rate 		= 0;

		if (is_numeric($input)) {

			if ($input < 0) {
				
			} else {
				
				if ($method == 'Ground' || $method == 'ground') {
			
					for ($x=0;$x<=$num; $x++) {
						if ($num >= 0 && $num <= 5) {
							
							$rate += 8;
							break;
							
						} elseif ($num >= 6 && $num <= 10) {
							
							$rate += 12;
							break;
						
						} elseif ($num >= 11 && $num <= 20) {
							
							$rate += 18;
							break;
						} elseif ($num >= 21 && $num <= 40) {
							
							$rate += 25;
							break;
							
						} elseif($num > 40) {

							$rate += 25;
							$num = $num-40;
							$x--;
						}
					}

				} elseif ($method == 'Expedited' || $method == 'expedited') {
					
					for ($x=0;$x<=$num; $x++) {
						if ($num >= 0 && $num <= 5) {
							
							$rate += 12;
							break;
							
						} elseif ($num >= 6 && $num <= 10) {
							
							$rate += 15;
							break;
						
						} elseif ($num >= 11 && $num <= 20) {
							
							$rate += 22;
							break;
						} elseif ($num >= 21 && $num <= 40) {
							
							$rate += 30;
							break;
							
						} elseif($num > 40) {

							$rate += 30;
							$num = $num-40;
							$x--;
						}
					}
					
				} 
			}

			return $rate;
		} 
	}
}