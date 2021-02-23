<?php
namespace Dkdps\Entity;
use Doctrine\ORM\Mapping as Mapping ;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="dangkydatphong")
 */
class Dkdps{

    // `MaKH`, `NgayDat`, `NgayO`, `NgayDi`, `GhiChu`, `MaLP`, `MaPhong`

    /**
     * @Mapping\Id
     * @Mapping\Column(name="id")
     * @Mapping\GeneratedValue
     */
    private $id;

     /** @Mapping\Column(name="tenkh") */
     private $tenkh;

   

     /** @Mapping\Column(name="ngayo") */
    private $ngayo;

    /** @Mapping\Column(name="Ngaydi") */
    private $Ngaydi;

    /** @Mapping\Column(name="ghichu") */
    private $ghichu;

    /** @Mapping\Column(name="MaLP") */
    private $MaLP;

  

   
    
     // `MaKH`, `NgayDat`, `NgayO`, `NgayDi`, `GhiChu`, `MaLP`, `MaPhong`


    /**
     * @return
     */
    public function getId(){
        return $this->id;
    }
    /**
     * @param
     */
    public function setId($id){
        $this ->id= $id; 
    }

    /**
     * @return
     */
    public function getTenkh(){
        return $this->tenkh;
    }
    /**
     * @param
     */
    public function setTenkh($tenkh){
        $this ->tenkh= $tenkh; 
    }

    
   

    /**
     * @return
     */
    public function getNgayO(){
        return $this->ngayo;
    }
    /**
     * @param
     */
    public function setNgayO($ngayo){
        $this ->ngayo= $ngayo; 
    }

    /**
     * @return
     */
    public function getNgayDi(){
        return $this->Ngaydi;
    }
    /**
     * @param
     */
    public function setNgayDi($ngaydi){
        $this ->Ngaydi= $ngaydi; 
    }

    /**
     * @return
     */
    public function getGhiChu(){
        return $this->ghichu;
    }
    /**
     * @param
     */
    public function setGhiChu($ghichu){
        $this ->ghichu= $ghichu; 
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

  
    

}
 
?>