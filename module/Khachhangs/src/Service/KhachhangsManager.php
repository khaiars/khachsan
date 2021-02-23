<?php
namespace Khachhangs\Service;


use DoctrineORMModuleTest\Assets\GraphEntity\User;
use Khachhangs\Entity\Khachhangs;
use Khachsan\Entity\Khachsans;
use Laminas\Crypt\Password\Bcrypt;


class KhachhangsManager{

    private $entityManager;
   
    public function __construct($entityManager){
        $this->entityManager = $entityManager;

    }
   
    public function checkUsernameExists($username){
        $KH = $this ->entityManager->getRepository(Khachhangs::class)->findOneBy(array('Username'=>$username));
        //if ($username!= null) return true;
        //return false;
        return $KH!==null;
    }
    public function checkEmailExists($email){
        $KH = $this ->entityManager->getRepository(Khachhangs::class)->findOneBy(array('Email'=>$email));
        //if ($username!= null) return true;
        //return false;
        return $KH!==null;
    }
   

    public function addKH($data)
    {
        if($this->checkUsernameExists($data['username'])){
            throw new \Exception("Username ".$data['username']." đã có người sử dụng");

        }
        if($this->checkEmailExists($data['email'])){
            throw new \Exception("Email ".$data['email']." đã có người sử dụng");

        }
        $KH =new KhachHangs;
        $KH->setUsername($data['username']);
        $KH->setTenKhachHang($data['hoten']);
      //  $user->setPassword($data['password']);
        $KH->setEmail($data['email']);
        $KH->setNgaySinh($data['ngaysinh']);
        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($data['password']);
        $KH->setPassword($securePass);
        
        
        
        $this->entityManager-> persist($KH);
        $this->entityManager->flush();
        return $KH;

    }
    
    public function removeKhachHang($KH){
        $this->entityManager->remove($KH);
        $this->entityManager->flush();
        return $KH;

    }

    public function register($username,$password,$email){
        $user = new Khachhangs();
        $user->setUsername($username);
        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($password);
        $user->setPassword($securePass);
        $user->setEmail($email);
        $this->entityManager-> persist($user);
        $this->entityManager->flush();
        return $user;
    }

    public function login($username,$userPassword){
        $user = $this->entityManager->getRepository(Khachhangs::class)
         ->findOneBy(['Username' => $username]);
        $brcypt = new Bcrypt();
        $userPassword = $this->password; // pw do người dùng nhập
        $passwordHash = $user->getPassword(); // pw lưu trong cơ sở dữ liệu
        if($brcypt->verify($userPassword,$passwordHash)){
         return $user;
        
        }
    }
}
// $user = $this->entityManager->getRepository(Khachhangs::class)->findOneBy(['Username' => $username, 'Password' => $password]);
