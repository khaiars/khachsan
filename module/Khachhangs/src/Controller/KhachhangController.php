<?php
namespace Khachhangs\Controller;

use Dkdps\Entity\Dkdps;
use Khachhangs\Entity\Khachhangs;
use Khachhangs\Entity\Khachhangs as EntityKhachhangs;
use KhachHangs\Form\KhachHangForm;
use Laminas\View\Helper\ViewModel as HelperViewModel;
use Laminas\View\Model\ViewModel as ModelViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Users;
use Users\Form\UserForm;
use Users\Form\FormLabel;
use Laminas\Authentication\Adapter\AbstractAdapter;
use Laminas\Crypt\Password\Bcrypt;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Resolver;
use  Laminas\View\Resolver\TemplateMapResolver;
use Laminas\View\Renderer\RendererInterface;
use Laminas\Mvc\View\DefaultRenderingStrategy;
use Zend\Mvc\MvcEvent;




class KhachhangController extends AbstractActionController{
    private $entityManager;
    private $khManager;

   
    public function __construct($entityManager,$khManager){
        $this->entityManager = $entityManager;
        $this->khManager = $khManager;
    }
    
    public function indexAction(){
      
        $khachhangs = $this->entityManager->getRepository(Khachhangs::class)->findAll();
        return new ModelViewModel(['khachhangs'=>$khachhangs]);
    }


    public function registerAction()
    {
        if ($this->getRequest()->isPost()) {
            $username = $this->getRequest()->getPost('Username');
            $password = $this->getRequest()->getPost('Password');
            $email = $this->getRequest()->getPost('Email');


            $checkUsername = $this->entityManager->getRepository(Khachhangs::class)->findOneBy(['Username' => $username]);
            $checkEmail = $this->entityManager->getRepository(Khachhangs::class)->findOneBy(['Email' => $email]);
            if ($checkUsername != null) {
                $res['success'] = 0;
                $res['messages'] = "Tên đăng nhập đã tồn tại!";
            } else if ($checkEmail != null) {
                $res['success'] = 0;
                $res['messages'] = "Email đã tồn tại!";
            } else {


                if ($username != null && $password != null && $email != null) {
                    $data = $this->khManager->register($username, $password, $email);
                    if ($data != null) {
                        $res['success'] = 1;
                        $res['messages'] = "Đăng ký tài khoản thành công";
                    } else {
                        $res['success'] = 0;
                        $res['messages'] = "Đăng xảy ra lỗi!";
                    }
                }
            }

            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode($res));
            return $response;
        }
    }

    public function loginAction(){
       
        $request = $this->getRequest();
        if ($request->isPost()) {
          $username = $request->getPost("Username");
          $password = $request->getPost("Password");
      
          $data = $this->entityManager->getRepository(Khachhangs::class)->findOneBy(array('Username'=>$username));
            
          if ($data == null) {
            $res['success'] = 0;
            $res['messages'] = "Tài khoản không đúng!";
            $res['userId'] = null;
            $res['userPassword'] = null;
            $res['userName'] = null;
          
          } else {
      
              $brcypt = new Bcrypt();
              $userPassword = $password; // pw do người dùng nhập
              $passwordHash = $data->getPassword(); // pw lưu trong cơ sở dữ liệu
      
              if ($brcypt->verify($password, $passwordHash)) {
               
                 $res['success'] = 1;
                 $res['messages'] = "Đăng nhập thành công!";
                 $res['userId'] = $data->getIdKhachHang();
                 $res['userPassword'] = $data->getPassword();
                 $res['userName'] = $username;
               
      
             } else {
              $res['success'] = 0;
              $res['messages'] = "Mat khau khong dung!";
              $res['userId'] = null;
              $res['userPassword'] = null;
              $res['userName'] = null;
            
            }
          }
      
      
          $response = $this->getResponse();
          $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
          $response->setContent(json_encode($res));
          return $response;
        }
    }
    
    
    public function deleteAction(){
        $idKH =$this-> params()->fromRoute('id',0);
        if($idKH<=0){
            $this->getReponse()->setStatusCode('404');
        }

        $KH = $this->entityManager->getRepository(Khachhangs::class)->find($idKH);
        if(!$KH)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
      
        if($this->getRequest()->isPost()){
            $btn =$this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->khachhangManager->removeKhachHang($KH);
                $this->flashMessenger()->addSuccessMessage('Xoá thành công');
            }
            return $this->redirect()->toRoute('khachhang');
        }
        return new ModelViewModel(['khachhang'=>$KH]);


    }

    }

?>