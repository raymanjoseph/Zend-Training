<?php 

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class UserController extends AbstractActionController
{

	public function indexAction()
	{	
       return new ViewModel();
	}

	public function loginAction()
	{
		$sm 		= $this->getServiceLocator(); 
  		$LoginForm 	= $sm->get('LoginForm');

		$request 	= $this->getRequest();
		$error 		= array();

		if ($request->isPost()) {
			$LoginFilter = $sm->get('LoginFilter');
			$LoginForm->setInputFilter($LoginFilter);
			$LoginForm->setData($request->getPost());

			if ($LoginForm->isValid()) {

				$UserTable 	= $sm->get('UserTable');
				$User 		= $sm->get('User');
				$Session 	= $sm->get('Session');

				$User->exchangeArray($LoginForm->getData());
				
				$userIdentity = $UserTable->ValidateLogin($User->email, $User->password);

				if ($userIdentity != '') {

					$UserSession = array(
						$Session->user_id 	= $userIdentity->customer_id, 
						$Session->user_name = $userIdentity->first_name,
					);
					
					if ($Session->cart_id) {
						$this->redirect()->toRoute('shipping', array('action' => 'info'));
					} else {
						$this->redirect()->toRoute('product');
					}
				} else {
					$error[] = 'The email and password you entered don\'t match.';
					
				}
			}
		}
		return new ViewModel(array("form" => $LoginForm, "errors" =>$error));
	} 

	public function signupAction()
	{
		$sm 		= $this->getServiceLocator();
		$SignupForm = $sm->get('SignupForm');
		$request 	= $this->getRequest();
		$error		= array();
		if ($request->isPost()) {
			$SignupFilter = $sm->get('SignupFilter');
			$SignupForm->setInputFilter($SignupFilter);
			$SignupForm->setData($request->getPost());

			if ($SignupForm->isValid()) {
				$User 		= $sm->get('User');
				$Session 	= $sm->get('Session');

				$result = $request->getPost();
				if ($result->password == $result->confirm_password) {
					
					$UserTable = $sm->get('UserTable');
					$Session   = $sm->get('Session');
					$ValidateEmail = $UserTable->ValidateEmail($result->email);
					if ($ValidateEmail) {
						$error[] = 'Email already exists';
					} else {
						$User->exchangeArray($SignupForm->getData());
						
						$user = $UserTable->SaveUser($User);
						//var_dump($User);
						$Session->user_name = $user['user_name'];
						$Session->user_id 	= $user['user_id'];

						if ($Session->cart_id) {
							$this->redirect()->toRoute('shipping', array('action' => 'info'));
						} else {
							$this->redirect()->toRoute('product');
						}
					}
				} else {
					$error[] = 'Password Dont Match';
				}

			}
		}
		return new ViewModel(array("form" => $SignupForm, "errors" => $error));
	}

	public function logoutAction() 
	{
		$sm = $this->getServiceLocator();
		$Session = $sm->get('Session');
		$this->deleteCart($Session->cart_id);
	
		unset($Session->count);
		unset($Session->user_id);
		unset($Session->user_name);
		unset($Session->cart_id); 

		$this->redirect()->toRoute('product');

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