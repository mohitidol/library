<?php 
	
    namespace Book\Controller;
    error_reporting(0);
    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    use Book\Model\Book;
    use Book\Form\BookForm;

    class BookController extends AbstractActionController {

        protected $objBookTable;

        public function indexAction() {
            //Listing of all the books on home page.
            $objForm = new BookForm();
            return new ViewModel(array(
                'books' => $this->getBookTable()->fetchAll(),
                'form' => $objForm,
            ));
        }

        public function getBookTable() {
            if (!$this->objBookTable) {
                $sm = $this->getServiceLocator();
                $this->objBookTable = $sm->get('Book\Model\BookTable');
            }
            return $this->objBookTable;
        }

        public function listBookAction() {
            //Display only books
            if ($this->getRequest()->isXmlHttpRequest()) {
                $objViewModel = new ViewModel();
                $objViewModel->setVariables(array( 'books' => $this->getBookTable()->fetchAll()))
                            ->setTerminal(true);
                return $objViewModel;
                        
            }
        }

        /**
         * Action to issue the book from library. It also check if the book is available or not.
         * 
         */

        public function issueBookAction(){

            $objForm = new BookForm();
            $request = $this->getRequest();

            if ($request->isPost()) {
                $objBook = new Book();
                $objForm->setInputFilter($objBook->getInputFilter());
                $objForm->setData($request->getPost());
                if ($objForm->isValid()) {
                    $objBook->exchangeArray($objForm->getData());
                    //Update the status of the Book in Book Table Issued
                    $boolIsIssued = $this->getBookTable()->issueBook($objBook);
                    $strMessage = ( true == $boolIsIssued ) ? 'Book issued successfully' : 'The Book that you are requesting is not in Library.';
                    // Redirect to list of books
                    echo json_encode( array( 'status'=>$boolIsIssued, 'message'=>$strMessage));
                } else {
                    echo json_encode( array( 'status'=>false, 'message'=>'Please enter book name'));
                }
                die;
            }
            return $this->redirect()->toRoute('book');
        }

        /**
         * Action to return the book to the  library.
         * 
         */

        public function returnBookAction() {
            $objForm = new BookForm();
            $request = $this->getRequest();

            if ($request->isPost()) {
                $objBook = new Book();
                $objForm->setInputFilter($objBook->getInputFilter());
                $objForm->setData($request->getPost());
                if ($objForm->isValid()) {
                    $objBook->exchangeArray($objForm->getData());
                    //Update the status of the Book in Book Table to Available
                    $boolIsReturned = $this->getBookTable()->returnBook($objBook);
                    $strMessage = ( true == $boolIsReturned ) ? 'Book returned successfully' : 'The Book cannot be returned to Library.';
                    // Redirect to list of books
                    echo json_encode( array( 'status'=>$boolIsReturned, 'message'=>$strMessage));
                }else {
                    echo json_encode( array( 'status'=>false, 'message'=>'Please enter book name'));
                }
                die;
            }
            return $this->redirect()->toRoute('book');
        }

        /**
        * Action to check the availibility of the book in the  library.
        * 
        */

        public function checkAvailabilityAction() {
            //Check if Book has available status in Book Table
            $objForm = new BookForm();
            $request = $this->getRequest();

            if ($request->isPost()) {
                $objBook = new Book();
                $objForm->setInputFilter($objBook->getInputFilter());
                $objForm->setData($request->getPost());
                if ($objForm->isValid()) {
                    $objBook->exchangeArray($objForm->getData());
                    $boolIsValid    = $this->getBookTable()->availableBook($objBook);
                    $strMessage     = ( true == $boolIsValid ) ? 'Book is available.' : 'Book is not available.';
                    echo json_encode( array( 'status'=>$boolIsValid, 'message'=>$strMessage));
                }else {
                    echo json_encode( array( 'status'=>false, 'message'=>'Please enter book name'));
                }
                die;
            }
            return $this->redirect()->toRoute('book');
        }
    }