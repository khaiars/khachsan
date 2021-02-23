<?php

namespace Users\Service;


use Laminas\Authentication\Adapter\AdapterInterface;
use Users\Entity\Users;
use Laminas\Authentication\Result;
use Laminas\Crypt\Password\Bcrypt;

class AuthAdapter implements AdapterInterface
{
    private $entityManager;
    private $username;
    private $password;
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsename()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function authenticate()
    {
        $user = $this->entityManager->getRepository(Users::class)->findOneByusername($this->username);
        if (!$user) {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, null, ["Tài khoản không tồn tại"]);
        } else {
            $brcypt = new Bcrypt();

             $userPassword = $this->password; // pw do người dùng nhập
             $passwordHash = $user->getPassword(); // pw lưu trong cơ sở dữ liệu

             if($brcypt->verify($userPassword,$passwordHash))
             {   
                return new Result(Result::SUCCESS,$this->username,["Đăng nhập thành công!"]);
             }else
             {
                return new Result(Result::FAILURE_CREDENTIAL_INVALID,null,["Mật khẩu không đúng!"]);
            }

        }
    }
    

}
