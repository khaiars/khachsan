<?php
namespace Thanhpho\Controller;

use khachsan;
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
use LoaiPhong;
use Loaiphong\Entity\Khachsan as EntityKhachsan;
use Loaiphong\Entity\Loaiphongs;
use LoaiPhongs\Form\LoaiPhongForm as FormLoaiPhongForm;
use Phongs\Entity\Phongs;
use Phongs\Form\PhongForm;
use Zend\Mvc\MvcEvent;
use Loaiphong\Form\LoaiphongForm;
use Thanhpho\Entity\Thanhphos;
use Thanhpho\Form\ThanhPhoForm;

class ThanhphoController extends ControllerAbstractActionController{
    private $entityManager;
    private $thanhphoManager;

    // public function onDispat(MvcEvent $e)
    // {
    //     //Thi hành hàm onDispatch mặc định
    //     $response = parent::onDispatch($e);

    //     //Thiết lập layout mới
    //     $this->layout()->setTemplate('layoutproduct');

    //     return $response;
    // }
    public function __construct($entityManager,$thanhphoManager){
        $this->entityManager = $entityManager;
        $this->thanhphoManager = $thanhphoManager;
       
    }

    public function indexAction()
    {

        //$thanhphos = $this->thanhphoManager->getThanhPho();
        
          $thanhphos = $this->entityManager->getRepository(Thanhphos::class)->findAll();
        return new ModelViewModel(['thanhphos' => $thanhphos]);
       
    }

    public function addAction(){
        $form= new ThanhPhoForm("add");
        $form->setaddForm();
        $form->validator();
        $request= $this->getRequest();
        if($request->isPost()){
            $data =$this->params()->fromPost();
            $data = $this->getRequest()->getPost();
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($post);
               if( $form->isValid()){
                  $data = $form->getData();
              // echo "<pre>";
               // print_r($file);
              //  echo'</pre>';
                $lp =$this->thanhphoManager->addTP($data);
               // $ks =$this->loaiphongManager->addLP($data);
                $this->flashMessenger()->addSuccessMessage('Thêm Thành Phố Thành Công');
                return $this->redirect()->toRoute('thanhpho');
            }
        }
        return new ModelViewModel(['form'=>$form]);
    }
    public function editAction()
    {
        $Id =$this-> params()->fromRoute('id',0);
        if($Id<=0){
            $this->getReponse()->setStatusCode('404');
        }
        $tp = $this->entityManager->getRepository(Thanhphos::class)->find($Id);
        if(!$tp)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
        //
        $form= new ThanhPhoForm();
        $form->setaddForm();
        $form->editvalidator();
        $request = $this->getRequest();
        if(!$this->getRequest()->isPost()){
            $data= [
                'tentp'=>$tp->getTenTP(),
                'urlhinh'=>$tp->geturlHinh('urlhinh','name'),
                
            ];
            $form->setData($data);
            return new ModelViewModel(['form'=>$form,'tp'=>$tp]);
        }
      //AuthController.php  $data = $this->getRequest()->getPost();
        $data = $this->params()->fromPost();
        $form->setData($data);
        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );
        $form->setData($post);
        if($form->isValid()){
             $data = $form->getData();
        //$user =$this->userManager->editUser($user,$data);
           $this->thanhphoManager->editTP($tp,$data);
            $this->flashMessenger()->addSuccessMessage('Chỉnh sửa thành công');
            return $this->redirect()->toRoute('thanhpho');
        }
      
        return new ModelViewModel(['form' => $form]);
    }
    public function deleteAction(){
        $idTP =$this-> params()->fromRoute('id',0);
        if($idTP<=0){
            $this->getReponse()->setStatusCode('404');
        }

        $tp = $this->entityManager->getRepository(Thanhphos::class)->find($idTP);
        if(!$tp)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
      
        if($this->getRequest()->isPost()){
            $btn =$this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->thanhphoManager->removeTP($tp);
                $this->flashMessenger()->addSuccessMessage('Xoá thành công');


            }
            return $this->redirect()->toRoute('thanhpho');
        }
        return new ModelViewModel(['tp'=>$tp]);


    }
    public function getAction(){
        $data = $this->thanhphoManager->getThanhPho();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
        return $response;
    }
}
?>