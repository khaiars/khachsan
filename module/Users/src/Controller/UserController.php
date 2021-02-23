<?php
namespace Users\Controller;

use Laminas\View\Helper\ViewModel as HelperViewModel;
use Laminas\View\Model\ViewModel as ModelViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Users;
use Users\Form\UserForm;
use Users\Form\FormLabel;
use Laminas\Authentication\Adapter\AbstractAdapter;
use Laminas\Mvc\Controller\AbstractActionController as ControllerAbstractActionController;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Resolver;
use  Laminas\View\Resolver\TemplateMapResolver;
use Laminas\View\Renderer\RendererInterface;
use Laminas\Mvc\View\DefaultRenderingStrategy;
use Zend\Mvc\MvcEvent;



class UserController extends ControllerAbstractActionController{
    private $entityManager;
    private $userManager;

    // public function onDispat(MvcEvent $e)
    // {
    //     //Thi hành hàm onDispatch mặc định
    //     $response = parent::onDispatch($e);

    //     //Thiết lập layout mới
    //     $this->layout()->setTemplate('layoutproduct');

    //     return $response;
    // }
    public function __construct($entityManager,$userManager){
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }
    
    public function indexAction(){
      //  $this->Layout()->setTemplate('layoutUser');
        $users = $this->entityManager->getRepository(Users::class)->findAll();
        return new ModelViewModel(['users'=>$users]);
    }

    public function addAction()
    {
        $form = new UserForm();
        $form->setForm();
        $form->validator();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if ($form->isValid()) {

                $data = $form->getData();
                // echo "<pre>";
                // print_r($data);
                // echo'</pre>';
                $user = $this->userManager->addUser($data);
                // echo "<pre>";
                // print_r($user);
                // echo'</pre>';
                $this->flashMessenger()->addSuccessMessage('Tạo tài khoản thành công.');
                return $this->redirect()->toRoute('user');
            }
         // dd($data);

        }
        return new ModelViewModel(['form'=>$form]);
    }

    
    public function editAction()
    {
        $idUser =$this-> params()->fromRoute('id',0);
        if($idUser<=0){
            $this->getReponse()->setStatusCode('404');
        }
        $user = $this->entityManager->getRepository(Users::class)->find($idUser);
        if(!$user)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
        //
        $form= new UserForm();
        $form->setForm();
        $form->editvalidator();
        
        if(!$this->getRequest()->isPost()){
            $data= [
                'username'=>$user->getUsername(),
                'email'=>$user->getEmail(),       
                'hoten'=>$user->getHoTen(),
                'ngaysinh'=>$user->getNgaySinh(),
            ];
            $form->setData($data);
            return new ModelViewModel(['form'=>$form,'user'=>$user]);
        }
      //AuthController.php  $data = $this->getRequest()->getPost();
        $data = $this->params()->fromPost();
        $form->setData($data);
        if($form->isValid()){
             $data = $form->getData();
        //$user =$this->userManager->editUser($user,$data);
           $this->userManager->editUser($user,$data);
            $this->flashMessenger()->addSuccessMessage('Chỉnh sửa thành công');
            return $this->redirect()->toRoute('user');
        }
      
        return new ModelViewModel(['form' => $form]);
    }
    public function deleteAction(){
        $idUser =$this-> params()->fromRoute('id',0);
        if($idUser<=0){
            $this->getReponse()->setStatusCode('404');
        }

        $user = $this->entityManager->getRepository(Users::class)->find($idUser);
        if(!$user)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
      
        if($this->getRequest()->isPost()){
            $btn =$this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->userManager->removeUser($user);
                $this->flashMessenger()->addSuccessMessage('xoa thanh cong');
                

            }
            return $this->redirect()->toRoute('user');
        }
        return new ModelViewModel(['user'=>$user]);


    }
    public function registerAction(){
        // if($this->getRequest()->isPost()){
            // $username = $this->getRequest()->getPost('Username');
            // $password = $this->getRequest()->getPost('Password');
            // $email = $this->getRequest()->getPost('Email');

            $username = "sss";
            $password = "dddd";
            $email = "dddd";    

            
            if($username != null && $password !=null && $email !=null ){
                $data = $this->userManager->register($username,$password,$email);
                $response = $this->getResponse();
                $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                $response->setContent(json_encode($data));
                return $response;
            // } 

    }
    }
}
?>