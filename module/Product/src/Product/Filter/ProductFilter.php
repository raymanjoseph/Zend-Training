<?php 

namespace Product\Filter;

use Zend\InputFilter\InputFilter;


class ProductFilter extends InputFilter
{
	public function __construct()
	{

        $this->add(
            array(
                'name'     => 'product_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )
        );

        $this->add(array(
            'name'     => 'product_name',
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
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'product_desc',
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
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'unit_price',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 0,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'qty',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 1,
                    ),
                ),
            ),

        ));

        $this->add(array(
            'name'     => 'price',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 0,
                    ),
                ),
            ),
        ));

	}
}