<?php 
namespace Book\Form;

use Zend\Form\Form;

class BookForm extends Form
{
    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('book');

        $this->add(array(
            'name' => 'Name',
            'type' => 'Text',
            'class' => 'form-group',
            'options' => array(
                'label' => 'Book Name ',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Issue Book',
                'id' => 'issuebutton',
            ),
        ));
    }
}