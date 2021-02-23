<?php
namespace Khachhangs\Entity;
use Doctrine\ORM\Mapping as Mapping ;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="khachhang")
 */
class Khachhangs{

  // `idKhachHang`, `TenKhachHang`, `DienThoaiKH`, 
  //  `DiaChiKH`, `GioiTinh`, `SoCMND`, `Email`, `Password`, `NgaySinh`

    /**
     * @Mapping\Id
     * @Mapping\Column(name="idKhachHang")
     * @Mapping\GeneratedValue
     */
    private $idKhachHang;

    /** @Mapping\Column(name="TenKhachHang") */
    private $TenKhachHang;

    /** @Mapping\Column(name="Username") */
    private $Username;

    

    /** @Mapping\Column(name="Password") */
    private $Password;

    /** @Mapping\Column(name="DiaChiKH") */
    private $DiaChiKH;

    /** @Mapping\Column(name="Email") */
    private $Email;

    /** @Mapping\Column(name="NgaySinh") */
    private $NgaySinh;

    /** @Mapping\Column(name="DienThoaiKH") */
    private $DienThoaiKH;
    
    // `idKhachHang`, `TenKhachHang`, `DienThoaiKH`, 
  //  `DiaChiKH`, `GioiTinh`, `SoCMND`, `Email`, `Password`, `NgaySinh`
     

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
    public function getDienthoaiKH(){
        return $this->DienThoaiKH;
    }
    /**
     * @param
     */
    public function setDienthoaiKH($dienthoaikh){
        $this ->DienThoaiKH= $dienthoaikh; 
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
  //  DiaChiKH
    /**
     * @return
     */
    public function getDiaChi(){
        return $this->DiaChiKH;
    }
    /**
     * @param
     */
    public function setDiaChi($diaChi){
        $this ->DiaChiKH= $diaChi; 
    }

    /**
     * @return
     */
    public function getPassword(){
        return $this->Password;
    }
    /**
     * @param
     */
    public function setPassword($password){
        $this ->Password= $password; 
    }
    
    /**
     * @return
     */
    public function getUsername(){
        return $this->Username;
    }
    /**
     * @param
     */
    public function setUsername($username){
        $this ->Username= $username; 
    }

    /**
     * @return
     */
    public function getTenKhachHang(){
        return $this->TenKhachHang;
    }
    /**
     * @param
     */
    public function setTenKhachHang($hoten){
        $this ->TenKhachHang= $hoten; 
    }

    /**
     * @return
     */
    public function getIdKhachHang(){
        return $this->idKhachHang;
    }
    /**
     * @param
     */
    public function setIdKhachHang($idkhachhang){
        $this ->idKhachHang= $idkhachhang; 
    }

}
 
?>