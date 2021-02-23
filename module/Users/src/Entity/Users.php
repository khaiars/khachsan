<?php
namespace Users\Entity;
use Doctrine\ORM\Mapping as Mapping ;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="users")
 */
class Users{

   // `idUser`, `HoTen`, `Username`, `Password`, `DiaChi`, `Dienthoai`,
    // `Email`, `NgayDangKy`, `idGroup`, `NgaySinh`, `GioiTinh`, `urlHinh`, `active`, `randomkey`

    /**
     * @Mapping\Id
     * @Mapping\Column(name="idUser")
     * @Mapping\GeneratedValue
     */
    private $idUser;

    /** @Mapping\Column(name="HoTen") */
    private $HoTen;

     /** @Mapping\Column(name="username") */
    private $username;

    /** @Mapping\Column(name="password") */
    private $password;

    /** @Mapping\Column(name="DiaChi") */
    private $DiaChi;

    /** @Mapping\Column(name="Dienthoai") */
    private $Dienthoai;

    /** @Mapping\Column(name="Email") */
    private $Email;

    

   

    /** @Mapping\Column(name="NgaySinh") */
    private $NgaySinh;
    
     // `idUser`, `HoTen`, `Username`, `Password`, `DiaChi`, `Dienthoai`,
    // `Email`, `NgayDangKy`, `idGroup`, `NgaySinh`, `GioiTinh`, `urlHinh`, `active`, `randomkey`

    /**
     * @return
     */
    public function getNgaySinh(){
        return $this->NgaySinh;
    }
    /**
     * @param
     */
    public function setNgaySinh($ngaysinh){
        $this ->NgaySinh= $ngaysinh; 
    }

    


    /**
     * @return
     */
    public function getDienthoai(){
        return $this->Dienthoai;
    }
    /**
     * @param
     */
    public function setDienthoai($dienthoai){
        $this ->Dienthoai= $dienthoai; 
    }

    /**
     * @return
     */
    public function getEmail(){
        return $this->Email;
    }
    /**
     * @param
     */
    public function setEmail($email){
        $this ->Email= $email; 
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
    public function setDiaChi($diaChi){
        $this ->DiaChi= $diaChi; 
    }

    /**
     * @return
     */
    public function getPassword(){
        return $this->password;
    }
    /**
     * @param
     */
    public function setPassword($password){
        $this ->password= $password; 
    }
    
    /**
     * @return
     */
    public function getUsername(){
        return $this->username;
    }
    /**
     * @param
     */
    public function setUsername($username){
        $this ->username= $username; 
    }

    /**
     * @return
     */
    public function getHoTen(){
        return $this->HoTen;
    }
    /**
     * @param
     */
    public function setHoTen($hoten){
        $this ->HoTen= $hoten; 
    }

    /**
     * @return
     */
    public function getIdUser(){
        return $this->idUser;
    }
    /**
     * @param
     */
    public function setIdUser($iduser){
        $this ->idUser= $iduser; 
    }

}
 
?>