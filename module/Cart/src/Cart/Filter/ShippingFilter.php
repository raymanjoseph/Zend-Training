<?php 

namespace Cart\Filter;

use Zend\InputFilter\InputFilter;

class ShippingFilter extends InputFilter
{
	public function __construct()
	{
        $this->add(array(
            'name'     => 'shipping_name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'shipping_address1',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'shipping_address2',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'shipping_address3',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));

       	$this->add(array(
            'name'     => 'shipping_city',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'shipping_state',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'shipping_country',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));
         $this->add(array(
            'name'     => 'shipping_mehod',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 35,
                    ),
                ),
            ),
        ));
	}
}