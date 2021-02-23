<?php
namespace Dkdps\Service;

use Dkdps\Entity\Dkdps;

class DkdpManager{

    private $entityManager;
    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }
    public function datPhong($tenKH,$ngayDen,$ngayDi,$maLP){
        $datphong = new Dkdps();
        $datphong->setTenkh($tenKH);
        $datphong->setNgayO($ngayDen);
        $datphong->setNgayDi($ngayDi);
        $datphong->setMaLP($maLP);
        $this->entityManager->persist($datphong);
        $this->entityManager->flush();
        return $datphong;
    }

    public function removeDkdp($dkdp){
        $this->entityManager->remove($dkdp);
        $this->entityManager->flush();
        return $dkdp;
    }

    public function get(){
        $sql= "SELECT dkdp.id, dkdp.tenkh, dkdp.ngayo , dkdp.Ngaydi , dkdp.ghichu , dkdp.MaLP, lp.MaLP, lp.TenLP,lp.Gia,lp.IdKS ,ks.idKS, ks.tenKS 
            FROM Dkdps\Entity\Dkdps dkdp 
            JOIN Loaiphong\Entity\Loaiphongs lp JOIN Khachsan\Entity\Khachsans ks
                 WHERE lp.MaLP = dkdp.MaLP
                 AND ks.idKS= lp.IdKS";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }
   


}
?>