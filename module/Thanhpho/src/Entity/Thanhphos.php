<?php
namespace Thanhpho\Entity;
use Doctrine\ORM\Mapping as Mapping ;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="thanhpho")
 */
class Thanhphos{

 
   
    /**
     * @Mapping\ID
     * @Mapping\Column(name="Id")
     * @Mapping\GeneratedValue
     */
    private $Id;

    /** @Mapping\Column(name="TenTP") */
    private $TenTP;

     /** @Mapping\Column(name="urlHinh") */
    private $urlHinh;

   
    /**
     * @return
     */
    public function getId(){
        return $this->Id;
    }
    /**
     * @param
     */
    public function setId($id){
        $this ->Id= $id; 
    }

    
    /**
     * @return
     */
    public function getTenTP(){
        return $this->TenTP;
    }
    /**
     * @param
     */
    public function setTenTP($tentp){
        $this ->TenTP= $tentp; 
    }

    
    
    /**
     * @return
     */
    public function geturlHinh(){
        return $this->urlHinh;
    }
    /**
     * @param
     */
    public function seturlHinh($urlhinh){
        $this ->urlHinh= $urlhinh; 
    }

    

}


?>