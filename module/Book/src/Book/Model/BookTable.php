<?php 
 namespace Book\Model;

 use Zend\Db\TableGateway\TableGateway;

 class BookTable
 {
     protected $tableGateway;
     public $strStatus;

     public function __construct(TableGateway $objTableGateway)
     {
         $this->tableGateway = $objTableGateway;
     }

     public function fetchAll() {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getBook($strName) {
        $strName   = strip_tags(trim($strName));
        $rowset    = $this->tableGateway->select(array('name' => $strName));
        $row       = $rowset->current();
        $this->strStatus = $row->strStatus;
        if (!$row) {
            return false;
        }
        return $row;
     }

     public function issueBook( Book $objBook) {
        $arrData = array(
            'status'=> 'Issued'
        );

        $strName = trim( $objBook->name );
        if ($this->getBook($strName)) {
            if( 'Issued' == $this->strStatus ) 
                return false;
            else {     
                $this->tableGateway->update($arrData, array('name' => $strName));
                return true;
            }
        } else {
            return false;
        }
    }

    public function returnBook(Book $objBook) {
        $arrData = array(
            'status'=> 'Available'
        );

        $strName = trim($objBook->name);
        if ($this->getBook($strName)) {
            if('Available' == $this->strStatus) 
                return false;
            else {     
                $this->tableGateway->update($arrData, array('name' => $strName));
                return true;
            }
            return true;
        } else {
            return false;
        }
    }

    public function availableBook(Book $objBook) {
        $arrData = array(
            'name'=>$objBook->name,
        );
        $strName    = strip_tags(trim( $objBook->name));
        $strStatus  = 'Available';
        $rowset     = $this->tableGateway->select(array('name' => $strName, 'status'=>$strStatus));
        $row        = $rowset->current();
        $boolIsValid = (!$row) ? false : true;

        return $boolIsValid;
    }

 }