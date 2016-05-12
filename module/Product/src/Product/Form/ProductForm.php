<?php 

namespace Product\Form;
use Zend\Form\Form;

class ProductForm extends Form
{
	
	public function __construct($name = null)
	{
		parent::__construct('');

		$this->add(array(
			'name' => 'product_id',
			'type' => 'Hidden',
		));

		$this->add(array(
			'name' => 'product_name',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'product_desc',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'unit_price',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'qty',
			'type' => 'text',
		));
		$this->add(array(
			'name' => 'price',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'weight',
			'type' => 'Hidden',
		));
		$this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Add to Cart',
                'id' => 'submitbutton',
            ),
        ));
	} 
}
