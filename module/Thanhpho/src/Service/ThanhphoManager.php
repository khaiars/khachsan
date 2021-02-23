<?php

namespace Thanhpho\Service;

use Thanhpho\Entity\Thanhphos;

class ThanhphoManager
{

    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function addTP($data)
    {
        $tp = new Thanhphos;
        $tp->setTenTP($data['tentp']);
        $tp->seturlHinh($data['urlhinh']['name']);
        $this->entityManager->persist($tp);
        $this->entityManager->flush();
        return $tp;
    }
    public function editTP($tp, $data)
    {

        $tp->setTenTP($data['tentp']);
        $tp->seturlHinh($data['urlhinh']['name']);

        $this->entityManager->flush();
        return $tp;
    }
    public function removeTP($tp)
    {
        $this->entityManager->remove($tp);
        $this->entityManager->flush();
        return $tp;
    }


    public function getThanhPho()
    {
        $sql = "SELECT tp.Id , tp.TenTP , tp.urlHinh 
        FROM Thanhpho\Entity\Thanhphos tp ";
        $query = $this->entityManager->createQuery($sql);
        $data = $query->getResult();
        return $data;
    }
}
