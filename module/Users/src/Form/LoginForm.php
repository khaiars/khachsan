<?php 


namespace Users\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\NotEmpty;

class LoginForm extends Form{

  public function __construct()
  {
      parent::__construct();
      $this->loginForm();
      $this->validateLoginForm();

  }


  private function loginForm()
  {
    $username = new Element\Text('username');
    $username->setLabel('Tài Khoản');
    $username->setLabelAttributes(
        [
            'for' => 'exampleInputEmail1'  
        ]
    );
    $username->setAttributes(
        [
            'class' => 'form-control input-lg',
            'id' => 'exampleInputEmail1',
            'placeholder' => 'Vui lòng nhập tên tài khoản!',
            'autocomplete' =>'off'
        ]
    );

    $password = new Element\Password('password');
    $password->setLabel('Mật khẩu');
    $password->setLabelAttributes(
        [
            'for' => 'exampleInputPassword1',
            'class' => 'text-dark'
        ]
    );
    $password->setAttributes(
        [
            'class' => 'form-control input-lg',
            'id' => 'exampleInputPassword1',
            'placeholder' => 'Vui lòng nhập mật khẩu!'
        ]
    );
    $btnSubmit  = new Element\Button('btnSubmit');
    $btnSubmit->setAttributes(
        [
            'class' => 'btn btn-success btn-labeled pull-right',
            'id'    => 'btnSubmit',
            'value' => 'Đăng Nhập',
        ]
    );

    $btnReset = new Element\Button('btnReset');
    $btnReset->setAttributes(
        [
            'type' => 'reset',
            'id'   => 'btnReset',
            'class' => 'btn btn-danger',
            'value' => 'Quên Mật Khẩu',
        ]
    );

    $this->add($username);
    $this->add($password);
    $this->add($btnSubmit);
    $this->add($btnReset);

  }

  private function validateLoginForm()
  {
    $inputFilter = new InputFilter();
    $this->setInputFilter($inputFilter);

    $inputFilter->add(
        [
            'name' => 'username',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StringToLower'],
                ['name' => 'StripNewlines']
            ],
            'validators' => [
                [
                    'name'  => 'NotEmpty',
                    'options' => [
                        'break_chain_on_failure' => true,
                        'messages' => [
                            NotEmpty::IS_EMPTY => "Tên tài khoản không được để trống!",
                        ]
                    ]
                ],
            ],
        ]
    );

    $inputFilter->add(
        [
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StringToLower'],
                ['name' => 'StripNewlines']
            ],
            'validators' => [
                [
                    'name'  => 'NotEmpty',
                    'options' => [
                        'break_chain_on_failure' => true,
                        'messages' => [
                            NotEmpty::IS_EMPTY => "Mật khẩu không được để trống!",
                        ]
                    ]
                ],
            ],
        ]
    );
  }

}
?>