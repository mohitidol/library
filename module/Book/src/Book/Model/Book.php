<?php

namespace Book\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

 class Book
 {
     public $name;
     public $description;
     public $status;
     protected $inputFilter;

     public function exchangeArray($arrData) {
         $this->id          = (!empty($arrData['BookId'])) ? $arrData['BookId'] : null;
         $this->name        = (!empty($arrData['Name'])) ? $arrData['Name'] : null;
         $this->description = (!empty($arrData['Description'])) ? $arrData['Description'] : null;
         $this->status      = (!empty($arrData['Status'])) ? $arrData['Status'] : null;
     }

     public function setInputFilter(InputFilterInterface $inputFilter) {
         throw new \Exception("Not used");
     }

     public function getInputFilter() {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'book_name',
                 'required' => false,
                 'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                 ),
             ));
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }