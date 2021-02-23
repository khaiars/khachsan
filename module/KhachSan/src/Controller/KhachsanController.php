<?php
namespace Khachsan\Controller;

use khachsan;
use Khachsan\Entity\Khachsan as KhachsanEntityKhachsan;
use Khachsan\Entity\Khachsans;
use Khachsan\Form\KhachsanForm;
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



class KhachsanController extends ControllerAbstractActionController{
    private $entityManager;
    private $khachsanManager;

   
    public function __construct($entityManager,$khachsanManager){
        $this->entityManager = $entityManager;
        $this->khachsanManager = $khachsanManager;
       
    }
    
    public function indexAction(){
        $khachsans = $this->khachsanManager->get();
        return new ModelViewModel(['khachsans'=>$khachsans]);
    }

    public function addAction(){
        $form= new KhachsanForm();
        $form->setaddForm();
        $form->validator();
        $request= $this->getRequest();
        $thanhphos = $this->khachsanManager->getThanhPho();
        $form->get('tentp')->setValueOptions($thanhphos);
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
                $ks =$this->khachsanManager->addKS($data);
                $this->flashMessenger()->addSuccessMessage('Thêm Khách Sạn Thành Công');
                return $this->redirect()->toRoute('khachsan');
            }
        }
        return new ModelViewModel(['form'=>$form]);
    }
    public function editAction()
    {
        $idKS =$this-> params()->fromRoute('id',0);
        if($idKS<=0){
            $this->getReponse()->setStatusCode('404');
        }
        $ks = $this->entityManager->getRepository(Khachsans::class)->find($idKS);
        if(!$ks)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
        //
        $form= new KhachsanForm();
        $form->setaddForm();
        $form->editvalidator();
        $request = $this->getRequest();
        $thanhphos = $this->khachsanManager->getThanhPho();
        $form->get('tentp')->setValueOptions($thanhphos);
        if(!$this->getRequest()->isPost()){
            $data= [
                'tenks'=>$ks->getTenKS(),
                'diachi'=>$ks->getDiaChi(),       
                'idtp'=>$ks->getidTP(),
                'hinhks'=>$ks->getHinhKS('hinhks','name'),
               
            ];
            $form->setData($data);
            return new ModelViewModel(['form'=>$form,'ks'=>$ks]);
        }
        $data = $this->params()->fromPost();
        $form->setData($data);
        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );
        $form->setData($post);
        if($form->isValid()){
            $data = $form->getData();
            $this->khachsanManager->editKS($ks,$data);
            $this->flashMessenger()->addSuccessMessage('Chỉnh sửa thành công');
            return $this->redirect()->toRoute('khachsan');
        }
      
        return new ModelViewModel(['form' => $form]);
    }
    public function deleteAction(){
        $idKS =$this-> params()->fromRoute('id',0);
        if($idKS<=0){
            $this->getReponse()->setStatusCode('404');
        }

        $ks = $this->entityManager->getRepository(Khachsans::class)->find($idKS);
        if(!$ks)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
      
        if($this->getRequest()->isPost()){
            $btn =$this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->khachsanManager->removeKS($ks);
                $this->flashMessenger()->addSuccessMessage('Xoá thành công');


            }
            return $this->redirect()->toRoute('khachsan');
        }
        return new ModelViewModel(['ks'=>$ks]);


    }



    // API METHODl

    public function getAction()
    {
        $data = $this->khachsanManager->getKhachSan();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
        return $response;
    }
    public function getdayAction()
    {
        $data = $this->khachsanManager->getKhachSan();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
        return $response;
    }
    public function getdanhsachAction()
    {
        if($this->getRequest()->isPost()){
            $idThanhPho = $this->getRequest()->getPost('idthanhpho',null);
            if($idThanhPho != null){
                $data = $this->khachsanManager->getDanhSachKhachSan($idThanhPho);
                $response = $this->getResponse();
                $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                $response->setContent(json_encode($data));
                return $response;
            } 
        }
        
    }
    public function timkiemAction(){
        if($this->getRequest()->isPost()){
            $tukhoa = $this->getRequest()->getPost('tukhoa',null);
            if($tukhoa != null){
                $data = $this->khachsanManager->timKhachSan($tukhoa);
                $response = $this->getResponse();
                $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                $response->setContent(json_encode($data));
                return $response;
            } 
        }
    }
}
?>