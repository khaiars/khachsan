<?php
namespace Users\Service;


use DoctrineORMModuleTest\Assets\GraphEntity\User;
use Users\Entity\Users;

use Laminas\Crypt\Password\Bcrypt;


class UserManager{

    private $entityManager;

    public function __construct($entityManager){
        $this->entityManager = $entityManager;

    }
    public function checkUsernameExists($username){
        $user = $this ->entityManager->getRepository(Users::class)->findOneBy(array('username'=>$username));
        //if ($username!= null) return true;
        //return false;
        return $user!==null;
    }
    public function checkEmailExists($email){
        $user = $this ->entityManager->getRepository(Users::class)->findOneBy(array('Email'=>$email));
        //if ($username!= null) return true;
        //return false;
        return $user!==null;
    }
   

    public function addUser($data)
    {
        if($this->checkUsernameExists($data['username'])){
            throw new \Exception("Username ".$data['username']." đã có người sử dụng");

        }
        if($this->checkEmailExists($data['email'])){
            throw new \Exception("Email ".$data['email']." đã có người sử dụng");

        }
        $user =new Users();
        $user->setUsername($data['username']);
        $user->setHoTen($data['hoten']);
      //  $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setNgaySinh($data['ngaysinh']);
        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($data['password']);
        $user->setPassword($securePass); 
        $this->entityManager-> persist($user);
        $this->entityManager->flush();
        return $user;

    }
    public function editUser($user,$data){
        // if($this->checkEmailExists($data['email'])){
        //     throw new \Exception("Email ".$data['email']." đã có người sử dụng");

        // }
        
            
            $sql = "select u from Users\Entity\Users u where u.Email ='".$data['email']."' and u.username !='".$data['username']."'";
            $q = $this->entityManager->createQuery($sql);
            $users = $q->getResult();
          
            if(!empty($users)){
                throw new \Exception("Email ".$data['email']." đã có người sử dụng");
            }
            $user->setUsername($data['username']);
            $user->setHoTen($data['hoten']);
            $user->setEmail($data['email']);
            $user->setNgaySinh($data['ngaysinh']); 
            $this->entityManager->flush();
            return $user;
       
    }
    public function removeUser($user){
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return $user;

    }
    public function register($username,$password,$email){
        $user = new Users();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}
?>