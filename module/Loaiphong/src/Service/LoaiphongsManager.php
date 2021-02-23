<?php
namespace Loaiphong\Service;

use Loaiphong\Entity\Khachsan;
use Loaiphong\Entity\Loaiphongs;

class LoaiphongsManager{

    private $entityManager;
    
     

    public function __construct($entityManager){
        $this->entityManager = $entityManager;
      
        
    }
    public function addLP($data)
    {
       
        $lp =new Loaiphongs;
        $lp->setTenLP($data['tenlp']);
        $lp->setGia($data['gia']);
        $lp->setIdKS($data['tenks']);
        $lp->seturlHinh($data['urlhinh']['name']);
        $this->entityManager-> persist($lp);
        $this->entityManager->flush();
        return $lp;

    }
    public function editLp($lp,$data){

            $lp->setTenLP($data['tenlp']);
            $lp->setGia($data['gia']);
            $lp->setIdKS($data['tenks']);
            $lp->seturlHinh($data['urlhinh']['name']);
            $this->entityManager->flush();
            return $lp;
       
    }
    public function removeLp($lp){
        $this->entityManager->remove($lp);
        $this->entityManager->flush();
        return $lp;

    }
    public function get(){
        $sql = "SELECT lp.MaLP, lp.TenLP,lp.Gia, lp.urlHinh,lp.IdKS, ks.tenKS, ks.idKS FROM Loaiphong\Entity\Loaiphongs lp INNER JOIN Khachsan\Entity\Khachsans ks WHERE lp.IdKS= ks.idKS";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }
    public function getDanhSachLoaiPhong($idks){
        $sql = "SELECT lp.MaLP, lp.TenLP,lp.Gia, lp.urlHinh,lp.IdKS FROM Loaiphong\Entity\Loaiphongs lp WHERE lp.IdKS= $idks";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }

    public function getKhachSan(){
        $sql = "SELECT ks.idKS, ks.tenKS FROM Khachsan\Entity\Khachsans ks";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $this->decodeArray($data);
    }


    public function decodeArray($array)
    {
        $list = [];
        foreach ($array as $arr => $value) {
            $list[$value['idKS']] = $value['tenKS'];
        }
        return $list;
    }


}
?>