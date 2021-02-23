<?php
namespace Loaiphong\Controller;

use khachsan;
use Laminas\View\Model\ViewModel as ModelViewModel;
use Laminas\Mvc\Controller\AbstractActionController as ControllerAbstractActionController;
use Loaiphong\Entity\Loaiphongs;
use Loaiphong\Form\LoaiphongForm;


class LoaiphongController extends ControllerAbstractActionController{
    private $entityManager;
    private $loaiphongManager;

    // public function onDispat(MvcEvent $e)
    // {
    //     //Thi hành hàm onDispatch mặc định
    //     $response = parent::onDispatch($e);

    //     //Thiết lập layout mới
    //     $this->layout()->setTemplate('layoutproduct');

    //     return $response;
    // }
    public function __construct($entityManager,$loaiphongManager){
        $this->entityManager = $entityManager;
        $this->loaiphongManager = $loaiphongManager;
       
    }
    
    public function indexAction(){
        
        $loaiphongs = $this->loaiphongManager->get();
       
       // dd ($loaiphongs);
        return new ModelViewModel(['loaiphongs'=>$loaiphongs]);
       
    }

    public function addAction(){
        $form= new LoaiphongForm();
        $form->setaddForm();
        $form->validator();
        $request= $this->getRequest();
        $khachsans = $this->loaiphongManager->getKhachSan();
        $form->get('tenks')->setValueOptions($khachsans);
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
                $lp =$this->loaiphongManager->addLP($data);
                $this->flashMessenger()->addSuccessMessage('Thêm Loại Phòng Thành Công');
                return $this->redirect()->toRoute('lp');
            } 
        }
        return new ModelViewModel(['form'=>$form]);
    }
    public function editAction()
    {
        $MaLP =$this-> params()->fromRoute('id',0);
        if($MaLP<=0){
            $this->getReponse()->setStatusCode('404');
        }
        $lp = $this->entityManager->getRepository(Loaiphongs::class)->find($MaLP);
        if(!$lp)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
        $form= new LoaiphongForm();
        $form->setaddForm();
        $form->editvalidator();
        $khachsans = $this->loaiphongManager->getKhachSan();
        $form->get('tenks')->setValueOptions($khachsans);
        $request = $this->getRequest();
        if(!$request->isPost()){
            $data= [
                'tenlp'=>$lp->getTenLP(),
                'gia'=>$lp->getGia(),       
                'idks'=>$lp->getIdKS(),
                'urlhinh'=>$lp->getUrlhinh('urlhinh','name'),
               
            ];
            $form->setData($data);
            return new ModelViewModel(['form'=>$form,'lp'=>$lp]);
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
            $this->loaiphongManager->editLp($lp,$data);
            $this->flashMessenger()->addSuccessMessage('Chỉnh sửa thành công');
            return $this->redirect()->toRoute('lp');
        }
      
        return new ModelViewModel(['form' => $form]);
    }
    public function deleteAction(){
        $MaLP =$this-> params()->fromRoute('id',0);
        if($MaLP<=0){
            $this->getReponse()->setStatusCode('404');
        }

        $lp = $this->entityManager->getRepository(Loaiphongs::class)->find($MaLP);
        if(!$lp)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
      
        if($this->getRequest()->isPost()){
            $btn =$this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->loaiphongManager->removeLp($lp);
                $this->flashMessenger()->addSuccessMessage('Xoá thành công');
            }
            return $this->redirect()->toRoute('lp');
        }
        return new ModelViewModel(['lp'=>$lp]);
    }

    public function getdanhsachAction(){
        if($this->getRequest()->isPost()){
            $idks = $this->getRequest()->getPost('idks',null);
            if($idks != null){
                $data = $this->loaiphongManager->getDanhSachLoaiPhong($idks);
                $response = $this->getResponse();
                $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                $response->setContent(json_encode($data));
                return $response;
            } 

    }
}

}
?>