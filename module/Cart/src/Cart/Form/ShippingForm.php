<?php 

namespace Cart\Form;
use Zend\Form\Form;
use Zend\Form\Element\Radio;

class ShippingForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('');

		$this->add(array(
			'name' => 'shipping_name',
			'text' => 'Text',
			'class' => 'form-control',
			'options' => array(
				'label' => 'Name:',
			),
		));

		$this->add(array(
			'name' => 'shipping_address1',
			'text' => 'Text',
			'options' => array(
				'label' => 'Address 1:',
			),
		));

		$this->add(array(
			'name' => 'shipping_address1',
			'text' => 'Text',
			'options' => array(
				'label' => 'Address 1:',
			),
		));

		$this->add(array(
			'name' => 'shipping_address2',
			'text' => 'Text',
			'options' => array(
				'label' => 'Address 2:',
			),
		));

		$this->add(array(
			'name' => 'shipping_address3',
			'text' => 'Text',
			'options' => array(
				'label' => 'Address 3:',
			),
		));
		
		$this->add(array(
			'name' => 'shipping_city',
			'text' => 'Text',
			'options' => array(
				'label' => 'City:',
			),
		));

		$this->add(array(
			'name' => 'shipping_state',
			'text' => 'Text',
			'options' => array(
				'label' => 'State:',
			),
		));

		$this->add(array(
			'name' => 'shipping_country',
			'text' => 'Text',
			'options' => array(
				'label' => 'Country:',
			),
		));

		$this->add(array(
	        'name' => 'shipping_mehod',
	        'type' => 'Radio',
	        'options' => array(
	            'label' => '',
	            'value_options' => array(
	                'Ground' 	=> 'Ground Shipping',
	                'Expedited' => 'Expedited Shipping',
	            ),
	        ),
    	));

	    $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Continue',
                'id' => 'submitbutton',
           
            ),
            'options' => array(

            ),
        ));
	}
}