<?php
namespace Dkdps\Controller;

use Dkdps\Entity\Dkdps;
use Dkdps\Form\DkdpForm;
use Laminas\View\Helper\ViewModel as HelperViewModel;
use Laminas\View\Model\ViewModel as ModelViewModel;
use Laminas\Authentication\Adapter\AbstractAdapter;
use Laminas\Mvc\Controller\AbstractActionController;




class DkdpController extends AbstractActionController{
    private $entityManager;
    private $dangkydatphongManager;

 
    public function __construct($entityManager,$dangkydatphongManager){
        $this->entityManager = $entityManager;
        $this->dangkydatphongManager = $dangkydatphongManager;
    }
    
    public function indexAction(){
        $dkdps = $this->dangkydatphongManager->get();
        return new ModelViewModel(['dkdps'=>$dkdps]);
       
    }

    public function deleteAction(){
        $id =$this-> params()->fromRoute('id',0);
        if($id<=0){
            $this->getReponse()->setStatusCode('404');
        }
        $dkdp = $this->entityManager->getRepository(Dkdps::class)->find($id);
        if(!$dkdp)
        {
            $this->getResponse()->setStatusCode('404');
            return;
        }
      
        if($this->getRequest()->isPost()){
            $btn =$this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->dangkydatphongManager->removeDkdp($dkdp);
                $this->flashMessenger()->addSuccessMessage('Xoá thành công');
            }
            return $this->redirect()->toRoute('dangkydatphong');
        }
        return new ModelViewModel(['dkdp'=>$dkdp]);


    }
    public function datphongAction()
    {
        if ($this->getRequest()->isPost()) {
            $tenKH = $this->getRequest()->getPost('tenkh');
            $ngayDen = $this->getRequest()->getPost('ngayo');
            $ngayDi = $this->getRequest()->getPost('Ngaydi');
            $maLP = $this->getRequest()->getPost('MaLP');

            if ($tenKH != null && $ngayDen != null && $ngayDi!= null && $maLP !=null) {
                $data = $this->dangkydatphongManager->datPhong($tenKH,$ngayDen,$ngayDi,$maLP);
                if ($data != null) {
                    $res['success'] = 1;
                    $res['messages'] = "Đặt phòng thành công";
                //    echo($data);
                  
                }else{
                    $res['success'] = 0;
                    $res['messages'] = "Đã xảy ra lỗi!";
                    
                }
            }

            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode($res));
            return $response;
        }
        
    }
}
?>