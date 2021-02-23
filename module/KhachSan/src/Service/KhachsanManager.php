<?php
namespace Khachsan\Service;

use Khachsan\Entity\Khachsans;
use Loaiphong\Entity\Khachsan;
use Loaiphong\Entity\Loaiphongs;

class KhachsanManager{

    private $entityManager;
    
     

    public function __construct($entityManager){
        $this->entityManager = $entityManager;
        
    }
    public function addKS($data)
    {
       
        $ks = new Khachsans;
        $ks ->setTenKS($data['tenks']);
        $ks ->setDiaChi($data['diachi']);
        $ks->setHinhKS($data['hinhks']['name']);
        $ks ->setidTP($data['tentp']);
        $this->entityManager->persist($ks);
        $this->entityManager->flush();
        return $ks;

    }
    public function editKS($ks,$data){

           
            $ks ->setTenKS($data['tenks']);
            $ks ->setDiaChi($data['diachi']);
            $ks->setHinhKS($data['hinhks']['name']);
            $ks ->setidTP($data['idtp']);
            $this->entityManager->flush();
            return $ks;
       
    }
    public function removeKS($ks){
        $this->entityManager->remove($ks);
        $this->entityManager->flush();
        return $ks;
    }

    public function get(){
        $sql= "SELECT ks.idKS, ks.tenKS , ks.HinhKS , ks.idTP, ks.DiaChi, tp.Id, tp.TenTP  FROM Khachsan\Entity\Khachsans ks INNER JOIN Thanhpho\Entity\Thanhphos tp WHERE ks.idTP= tp.Id  ";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }

    public function getKhachSan(){
        $sql = "SELECT ks.idKS, ks.tenKS , ks.HinhKS FROM Khachsan\Entity\Khachsans ks";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }
    public function getKhachSanDay(){
        $sql = "SELECT  ks.idKS, ks.tenKS , ks.HinhKS  FROM Khachsan\Entity\Khachsans ks LIMIT 3,4 ";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;

    }
    public function getDanhSachKhachSan($idThanhPho){
            $sql = "SELECT  ks.idKS, ks.tenKS , ks.HinhKS, ks.idTP  FROM Khachsan\Entity\Khachsans ks WHERE ks.idTP =$idThanhPho";
            $query = $this->entityManager->createQuery($sql);
            $data = $query->getResult();
            return $data;
    }
    public function timKhachSan($tukhoa){
        $sql = "SELECT ks.idKS, ks.tenKS , ks.HinhKS, ks.idTP FROM Khachsan\Entity\Khachsans ks WHERE lower(ks.tenKS) LIKE '%$tukhoa%'";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }
    public function getThanhPho(){
        $sql = "SELECT tp.Id, tp.TenTP FROM Thanhpho\Entity\Thanhphos tp";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $this->decodeArray($data);
    }


    public function decodeArray($array)
    {
        $list = [];
        foreach ($array as $arr => $value) {
            $list[$value['Id']] = $value['TenTP'];
        }
        return $list;
    }
}



?>