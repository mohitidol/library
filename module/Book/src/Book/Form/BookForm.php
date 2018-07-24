<?php 
namespace Book\Form;

use Zend\Form\Form;
use Zend\Form\Element;
class BookForm extends Form
{
    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('book');

        $this->add(array(
            'name' => 'Name',
            'type' => 'Text',
            'attributes'=>array('id'=>'book_name',
                                'placeholder'=>'Enter book name',
                                'class' => 'form-control',
                                'autocomplete' => 'off',
                                'style'=>'margin-left: -20px;'),
        ));

        $button = new Element\Button('issue');
        $button->setLabel('Issue')
            ->setAttributes( array(
                'class'=> 'btn btn-primary issue margin2',
            ));
        $this->add($button);

        $button = new Element\Button('return');
        $button->setLabel('Return')
            ->setAttributes( array(
                'class'=> 'btn btn-primary return margin2',
            ));
        $this->add($button);

        $button = new Element\Button('availability');
        $button->setLabel('Check Availability')
            ->setAttributes( array(
                'class'=> 'btn btn-primary availability margin2',
            ));
        $this->add($button);
    }
    
}