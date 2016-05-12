<?php 

namespace User\Form;
use Zend\Form\Form;

/**
* 
*/
class SignupForm extends Form
{
	
	public function __construct($name = null)
	{
		parent::__construct('');

		$this->add(array(
			'name' => 'first_name',
			'type' => 'Text',
			'options' => array(
				'label' => 'First Name:'
			),
		));

		$this->add(array(
			'name' => 'last_name',
			'type' => 'Text',
			'options' => array(
				'label' => 'Last Name:'
			),
		));

		$this->add(array(
			'name' => 'phone',
			'type' => 'Text',
			'options' => array(
				'label' => 'Phone Number:'
			),
		));
		$this->add(array(
			'name' => 'email',
			'type' => 'Email',
			'options' => array(
				'label' => 'Email:'
			),
		));

		$this->add(array(
			'name' => 'company_name',
			'type' => 'Text',
			'options' => array(
				'label' => 'Company Name:'
			),
		));

		$this->add(array(
			'name' => 'password',
			'type' => 'Password',
			'options' => array(
				'label' => 'Password:'
			),
		));

		$this->add(array(
			'name' => 'confirm_password',
			'type' => 'Password',
			'options' => array(
				'label' => 'Confirm Password:'
			),
		));

		 $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Sign Up',
                'id' => 'submitbutton',
            ),
        ));
	} 
}
