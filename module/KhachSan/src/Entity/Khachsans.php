<?php
namespace Khachsan\Entity;
use Doctrine\ORM\Mapping as Mapping ;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="khachsan")
 */
class Khachsans{

   

    /** @Mapping\Column(name="idTP") */
    private $idTP;
     /**
     * @Mapping\Id
     * @Mapping\Column(name="idKS")
     * @Mapping\GeneratedValue
     */
    private $idKS;

    /** @Mapping\Column(name="tenKS") */
    private $tenKS;

    
    

     /** @Mapping\Column(name="DiaChi") */
    private $DiaChi;

    


     
     /** @Mapping\Column(name="HinhKS") */
    private $HinhKS;

   
    /**
     * @return
     */
    public function getIdKS(){
        return $this->idKS;
    }
    
    /**
     * @param
     */
    public function setIdKS($idks){
        $this ->idKS= $idks; 
    }
    /**
     * @return
     */
    public function getTenKS(){
        return $this->tenKS;
    }
    /**
     * @param
     */
    public function setTenKS($tenks){
        $this ->tenKS= $tenks; 
    }

    
    
    /**
     * @return
     */
    public function getDiaChi(){
        return $this->DiaChi;
    }
    /**
     * @param
     */
    public function setDiaChi($diachi){
        $this ->DiaChi= $diachi; 
    }

    

    /**
     * @return
     */
    public function getHinhKS(){
        return $this->HinhKS;
    }
    /**
     * @param
     */
    public function setHinhKS($hinhks){
        $this ->HinhKS= $hinhks; 
    }

    /**
     * @return
     */
    public function getidTP(){
        return $this->idTP;
    }
    /**
     * @param
     */
    public function setidTP($idtp){
        $this ->idTP= $idtp; 
    }

}

/**
 * @Mapping\Entity
 * @Mapping\Table(name="khachsan")
 */

//  class Khachsan{

//     /**
//      * @Mapping\Id
//      * @Mapping\Column(name="IdKS")
//      * @Mapping\GeneratedValue
//      */
//     private $IdKS;

//     /** @Mapping\Column(name="tenKS") */
//     private $tenKS;
//     /**
//      * @return
//      */
//     public function getIdKS(){
//         return $this->IdKS;
//     }
    
//     /**
//      * @param
//      */
//     public function setIdKS($idks){
//         $this ->IdKS= $idks; 
//     }
//     /**
//      * @return
//      */
//     public function getTenKS(){
//         return $this->tenKS;
//     }
//     /**
//      * @param
//      */
//     public function setTenKS($tenks){
//         $this ->tenKS= $tenks; 
//     }
    
//  }
 
?>