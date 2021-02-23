<?php
 namespace Users\Controller;

use Laminas\Authentication\Result;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel as ModelViewModel;
use Users\Form\LoginForm;

class AuthController extends AbstractActionController {
    private $entityManager,$userManager,$authManager, $authService;
  

    public function __construct($entityManager,$userManager,$authManager, $authService)
    {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
    }

    public function loginAction(){
        
        $request = $this->getRequest();
        $form = new LoginForm();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $result = $this->authManager->login($data['username'], $data['password']);
                if ($result->getCode() == Result::SUCCESS) {
                    return $this->redirect()->toRoute('user');
                } else {
                    $message = current($result->getMessages());
                    $this->flashMessenger()->addErrorMessage($message);
                    return $this->redirect()->toRoute('login');
                }
            }
        }
        $this->Layout()->setTemplate('layoutForm');
        return new ModelViewModel(['form'=>$form]);
        
        

    }
    public function logoutAction()
    {
        $result =  $this->authManager->logout();
        if ($result == null) {
            return $this->redirect()->toRoute('login');
        }
    }
 }



?>