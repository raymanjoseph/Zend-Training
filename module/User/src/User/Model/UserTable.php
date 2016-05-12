<?php 

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function ValidateLogin($email,$pw)
	{
		$result = $this->tableGateway->select(array('email' => $email, 'password' => $pw));
		return $result->count() > 0 ? $result->current() : null;
	}

	public function ValidateEmail($email)
	{
		$result = $this->tableGateway->select(array('email' => $email));
		return $result->count() > 0 ? $result->current() : null;
	}

	public function SaveUser(User $User)
	{
		$data = array(
			'first_name' 	=> $User->first_name,
			'last_name' 	=> $User->last_name,
			'email' 		=> $User->email,
			'company_name' 	=> $User->company_name,
			'password' 		=> $User->password,
			'phone' 		=> $User->phone,
		);
		
		$this->tableGateway->insert($data);
		
		$Credentails = array(
			'user_name' => $User->first_name, 
			'user_id' =>$this->tableGateway->getLastInsertValue()
		);
        return $Credentails;
	}
	public function getUserById($id)
	{
		$result = $this->tableGateway->select(array('customer_id' => $id));
		return $result->count() > 0 ? $result->current() : null;
	}
}