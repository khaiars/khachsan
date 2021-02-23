<?php
namespace Loaiphong\Entity;
use Doctrine\ORM\Mapping as Mapping ;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="loaiphongs")
 */
class Loaiphongs{

  
    /** @Mapping\Column(name="IdKS") */
    private $IdKS;
    /**
     * @Mapping\ID
     * @Mapping\Column(name="MaLP")
     * @Mapping\GeneratedValue
     */
    private $MaLP;

    /** @Mapping\Column(name="TenLP") */
    private $TenLP;

     /** @Mapping\Column(name="Gia") */
    private $Gia;
    /** @Mapping\Column(name="urlHinh") */
    private $urlHinh;

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
    /**
     * @return
     */
    public function getMaLP(){
        return $this->MaLP;
    }
    /**
     * @param
     */
    public function setMaLP($malp){
        $this ->MaLP= $malp; 
    }

    
    /**
     * @return
     */
    public function getTenLP(){
        return $this->TenLP;
    }
    /**
     * @param
     */
    public function setTenLP($tenlp){
        $this ->TenLP= $tenlp; 
    }

    
    
    /**
     * @return
     */
    public function getGia(){
        return $this->Gia;
    }
    /**
     * @param
     */
    public function setGia($gia){
        $this ->Gia= $gia; 
    }

    /**
     * @return
     */
    public function getIdKS(){
        return $this->IdKS;
    }
    /**
     * @param
     */
    public function setIdKS($idks){
        $this ->IdKS= $idks; 
    }

}


 
?>