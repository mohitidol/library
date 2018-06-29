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
            return new ViewModel(array(
                'books' => $this->getBookTable()->fetchAll(),
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
            return new ViewModel(array(
                'books' => $this->getBookTable()->fetchAll(),
            ));
        }

        public function issueBookAction(){

            $objForm = new BookForm();
            $objForm->get('submit')->setValue('Issue Book');

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
                    $this->flashMessenger()->addMessage(array('alert-success' => $strMessage));
                    // Redirect to list of books
                    return $this->redirect()->toRoute('book/issuebook');

                }
            }
            return array('form' => $objForm, 'books' => $this->getBookTable()->fetchAll());            
        }

        public function returnBookAction() {
            $objForm = new BookForm();
            $objForm->get('submit')->setValue(' Return Book');

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
                    $this->flashMessenger()->addMessage(array('alert-success' => $strMessage));
                    // Redirect to list of books
                    return $this->redirect()->toRoute('book/returnbook');
                }
            }
            return array('form' => $objForm, 'books' => $this->getBookTable()->fetchAll());
        }

        public function checkAvailabilityAction() {
            //Check if Book has available status in Book Table
            $objForm = new BookForm();
            $objForm->get('submit')->setValue('Check Availability');

            $request = $this->getRequest();
            if ($request->isPost()) {
                $objBook = new Book();
                $objForm->setInputFilter($objBook->getInputFilter());
                $objForm->setData($request->getPost());

                if ($objForm->isValid()) {
                    $objBook->exchangeArray($objForm->getData());
                    $boolIsValid    = $this->getBookTable()->availableBook($objBook);
                    $strMessage     = ( true == $boolIsValid ) ? 'Book is available.' : 'Book is not available.';
                    $this->flashMessenger()->addMessage(array('alert-success' => $strMessage));
                    // Redirect to list of books
                    return $this->redirect()->toRoute('book/checkavailability');
                }
            }

            return array('form' => $objForm, 'books' => $this->getBookTable()->fetchAll());
        }
    }