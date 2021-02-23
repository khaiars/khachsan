<?php 
namespace Users\Form;

use Laminas\Form\Annotation\InputFilter as AnnotationInputFilter;
use Laminas\Form\Form as FormForm;
use Laminas\Form\View\Helper\Form as HelperForm;

use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Identical as ValidatorIdentical;
use Laminas\Validator\NotEmpty as ValidatorNotEmpty;
use Laminas\Validator\StringLength as ValidatorStringLength;
use PHPUnit\Framework\Constraint\IsIdentical;
use Zend\Form\Form;

use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\EmailAddress;
use Zend\Validator\Identical;
use Laminas\InputFilter\ArrayInput;
use Laminas\InputFilter\Factory;    
use Laminas\Form\View\Helper\FormLabel;
use Laminas\Form\Element;
use Laminas\Validator\Date;
use Laminas\Validator\EmailAddress as ValidatorEmailAddress;
use Laminas\Validator\Regex;
use Prophecy\Argument\Token\IdenticalValueToken;


class UserForm extends FormForm{
     //private $action;
     public function __construct()
     {
        parent::__construct();
        // $this->setAttributes([
        //      'name'=>'user-form',
        //      'class'=>'form-horizontal',
        //      'method' => 'post'
             
        // ]);
      //   $this->action= $action;
        // $this->addElements();
        // $this->validator();

     }
    
    
    //   //  username
    //     $this->add([
             
    //         'type'=>'text',
    //         'name'=>'username',
    //         'attributes'=>[
                
    //             'class'=>'form-control',
    //                 'placeholder'=>'nhap username',
    //                 'id'=>'username'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap username',
    //             'label_attributes'=>[
    //                 'for'=>'username',
    //                 'class'=>'col-md-3 control-label'
    //             ]
    //         ]
    //     ]);
    //  if($this->action =='add'){
         
    //     $this-> add([
    //         'type'=>'password',
    //         'name'=>'password',
    //         'attributes'=>[
    //            'class'=>'form-control',
    //                'placeholder'=>'nhap password',
    //                'id'=>'password'
    //        ],
    //        'options'=>[
    //            'label'=> 'nhap mat khau',
    //            'label_attributes'=>[
    //                'for'=>'password',
    //                'class'=>'col-md-3 control-label'
    //            ]
    //        ]
    //     ]);
    
    //     // confirm password
   
    //     $this-> add([
    //         'type'=>'password',
    //         'name'=>'confirm_password',
    //         'attributes'=>[
    //             'class'=>'form-control',
    //                'placeholder'=>'nhap lai mat khau',
    //                'id'=>'confirm_password'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap lai mat khau',
    //             'label_attributes'=>[
    //                'for'=>'confirm_password',
    //                'class'=>'col-md-3 control-label'
    //             ]
    //         ]
    //     ]);

    //  }
        
     
        
         
    //     //Hoten

    //     $this->add([
             
    //         'type'=>'text',
    //         'name'=>'hoten',
    //         'attributes'=>[
    //             'class'=>'form-control',
    //             'placeholder'=>'nhap ho ten',
    //             'id'=>'hoten'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap Ho ten',
    //             'label_attributes'=>[
    //                 'for'=>'hoten',
    //                 'class'=>'col-md-3 control-label'
    //             ]
    //         ]
    //     ]);

    //     //birthday 
        
    //     $this->add([
             
    //         'type'=>'date',
    //         'name'=>'ngaysinh',
    //          'attributes'=>[
    //             'class'=>'form-control',
    //                'placeholder'=>'nhap ngay sinh',
    //                'id'=>'ngaysinh'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap ngay sinh',
    //             'label_attributes'=>[
    //                'for'=>'ngaysinh',
    //                'class'=>'col-md-3 control-label'
    //            ]
    //         ]
    //     ]);
        

    //     //gender

    //     $this->add([
             
    //         'type'=>'Radio',
    //         'name'=>'gioitinh',
    //          'attributes'=>[
    //             'style'=>'margin-left:20px',
    //             'value'=>'nam', 
    //             'id'=>'gioitinh'
    //         ],
            
    //         'options'=>[
    //             'label'=>'nhap gioi tinh',
    //             'label_attributes'=>[
    //                 'class'=>'control-label'
    //             ],
    //             'value_options'=>[
    //                 'nu'=>'Nu',
    //                 'nam'=>'Nam'
    //             ]
    //         ]
    //     ]);

    //     //diachi

    //     $this->add([
             
    //         'type'=>'text',
    //         'name'=>'diachi',
    //         'attributes'=>[
    //             'class'=>'form-control',
    //                 'placeholder'=>'nhap DiaChi',
    //                 'id'=>'diachi'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap DiaChi',
    //             'label_attributes'=>[
    //                 'for'=>'diachi',
    //                 'class'=>'col-md-3 control-label'
    //             ]
    //         ]
    //     ]);

    //     //email

    //     $this->add([
             
    //         'type'=>'text',
    //         'name'=>'email',
    //         'attributes'=>[
    //             'class'=>'form-control',
    //                 'placeholder'=>'nhap Email',
    //                 'id'=>'email'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap Email',
    //             'label_attributes'=>[
    //                 'for'=>'email',
    //                 'class'=>'col-md-3 control-label'
    //             ]
    //         ]
    //     ]);

    //     //dienthoai

    //     $this->add([
             
    //         'type'=>'text',
    //         'name'=>'dienthoai',
    //         'attributes'=>[
    //             'class'=>'form-control',
    //                 'placeholder'=>'nhap Dienthoai',
    //                 'id'=>'dienthoai'
    //         ],
    //         'options'=>[
    //             'label'=> 'nhap Dienthoai',
    //             'label_attributes'=>[
    //                 'for'=>'dienthoai',
    //                 'class'=>'col-md-3 control-label'
    //             ]
    //         ]
    //     ]);

    //     //btnsubmit

    //     $this->add([
    //         'type' => 'submit',
    //         'name'=>'btnSubmit',
    //         'attributes'=>[
    //             'class'=>'btn btn-success',
    //             'value'=>'Save' 
    //         ],
            
    //     ]);
 //   }
    public function setForm()
    {
        
        $ngaysinh = new Element\Date('ngaysinh');
        $ngaysinh->setLabel(' ngaysinh:');
        $ngaysinh->setLabelAttributes([
            'for' => 'ngaysinh',
            'class'=>'col-md-3 control-label'
        ]);
        $ngaysinh->setAttributes([
            'class' => 'form-control',
            'id'    => 'ngaysinh',
           
        ]);
        $username = new Element\Text('username');
        $username->setLabel('Tên username:');
        $username->setLabelAttributes([
            'for' => 'username',
            'class'=>'col-md-3 control-label'
        ]);
        $username->setAttributes([
            'class' => 'form-control',
            'id'    => 'username',
            'placeholder' => 'Nhập username',
        ]);
    
        $email = new Element\Email('email');
        $email->setLabel('Email');
        $email->setLabelAttributes(
            [
                'for' => 'inputEmail',
                'class'=>'col-md-3 control-label'
            ]
        );
        $email->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'inputEmail',
                'placeholder' => 'Vui lòng nhập địa chỉ email!'
            ]
        );
        


        $password = new Element\Password('password');
        $password->setLabel('Mật khẩu');
        $password->setLabelAttributes(
            [
                'for' => 'inputPassword',
                'class'=>'col-md-3 control-label'
            ]
        );
        
        $password->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'Password',
                'placeholder' => 'Vui lòng nhập mật khẩu!'
            ]
        );

        $confirm_password = new Element\Password('confirm_password');
        $confirm_password->setLabel('Xác nhận mật khẩu');
        $confirm_password->setLabelAttributes(
            [
                'for' => 'inputRePassword',
                'class'=>'col-md-3 control-label'
            ]
        );
        $confirm_password->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'confirm_password',
                'placeholder' => 'Vui lòng xác nhận mật khẩu!'
            ]
        );
        
        $hoten = new Element\Text('hoten');
        $hoten->setLabel('Họ tên:');
        $hoten->setLabelAttributes(
            [
                'for' => 'hoten',
                'class'=>'col-md-3 control-label'
            ]
        );
        $hoten->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'hoten',
                'placeholder' => 'Vui lòng nhập họ tên!'
            ]
        );


        $address = new Element\Text('address');
        $address->setLabel('Địa chỉ:');
        $address->setLabelAttributes(
            [
                'for' => 'address',
                'class'=>'col-md-3 control-label'
            ]
        );
        $address->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'address',
                'placeholder' => 'Vui lòng nhập địa chỉ!'
            ]
        );

        $btnSubmit  = new Element\Button('btnSubmit');
        $btnSubmit->setAttributes(
            [
                'class' => 'btn btn-success',
                'id'    => 'btnSubmit',
                'value' => 'Đăng ký',
            ]
        );

        $btnReset = new Element\Button('btnReset');
        $btnReset->setAttributes(
            [
                'type' => 'reset',
                'id'   => 'btnReset',
                'class' => 'btn btn-primary',
                'value' => 'Xóa',
            ]
        );
        $this->add($username);
        $this->add($hoten);
        $this->add($email);
        $this->add($password);
        $this->add($confirm_password);
        $this->add($ngaysinh);
        $this->add($btnSubmit);
        $this->add($btnReset);
    }







    //     $singer = new Element\Select('singer');
    //     $singer->setLabel("Ca Sĩ Thể Hiện:");
    //     $singer->setLabelAttributes([
    //        'for' => 'inputSinger'
    //     ]);
    //     $singer->setAttributes([
    //         'class' => 'form-control',
    //         'id'    => 'inputSinger',

    //     ]);



    //     $image = new Element\File('image');
    //     $image->setLabel('Ảnh Album:');
    //     $image->setLabelAttributes([
    //         'for' => 'inputImage',
    //     ]);
    //     $image->setAttributes([
    //         'id' => 'inputImage',
    //     ]);


 


    public function validator(){
        $inputfilter = new InputFilter();
        $this-> setInputFilter($inputfilter);
        //username
        $inputfilter ->add([
            'name'=>'username',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StringToLower'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
            [
                'name'=>'NotEmpty',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'Username khong duoc rong',
                    ]
                ]
            ],
            [
                'name'=>'StringLength',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'min'=>5,
                    'max'=>10,
                    'messages'=>[
                        ValidatorStringLength::TOO_SHORT=>'username it nhat %min% ky tu',
                        ValidatorStringLength::TOO_LONG=>'username khong qua %max% ky tu'
                    ]
                ]
            ] 

            ]

        ]);
        
            $inputfilter ->add([
                'name'=>'password',
                'required'=>true,
                'filters'=>[
                    ['name'=>'StringTrim'],
                    ['name'=>'StripTags'],
                    ['name'=>'StripNewlines']
                ],
                'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            ValidatorNotEmpty::IS_EMPTY=>'password khong duoc rong',
                        ]
                    ]
                ],
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'min'=>5,
                        'max'=>20,
                        'messages'=>[
                            ValidatorStringLength::TOO_SHORT=>'password it nhat %min% ky tu',
                            ValidatorStringLength::TOO_LONG=>'password khong qua %max% ky tu'
                        ]
                    ]
                ]    
    
                ]
    
            ]);
            //confirm pass
            $inputfilter ->add([
                'name'=>'confirm_password',
                'required'=>true,
                'filters'=>[
                    ['name'=>'StringTrim'],
                    ['name'=>'StripTags'],
                    ['name'=>'StripNewlines']
                ],
                'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            ValidatorNotEmpty::IS_EMPTY=>' Vui lòng xác nhận mật khẩu!',
                        ]
                    ]
                ],
                [
                    'name'=>'Identical',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'token'=>"password",
                        'messages'=>[
                            ValidatorIdentical::NOT_SAME=>"Mật khẩu nhập lại không đúng!",
                            
                        ]
                    ]
                ] 
    
            ]
    
            ]);
                  
        
        
        //hoten
        $inputfilter ->add([
            'name'=>'hoten',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
            [
                'name'=>'NotEmpty',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'ten khong duoc rong',
                    ]
                ]
            ],
            [
                'name'=>'StringLength',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'max'=>20,
                    'messages'=>[
                        
                        ValidatorStringLength::TOO_LONG=>'hoten khong qua %max% ky tu'
                    ]
                ]
            ] 

            ]

        ]);
        //email
        $inputfilter ->add([
            'name'=>'email',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[ 
            [
                'name'=>'Regex',
                'break_chain_on_failure'=>true,
                'options'=>[
                    'pattern'=>"/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",
                        
                    'message'=>[
                        Regex::NOT_MATCH=>'email phai chua cac ky tu %pattern%'
                    ]
                ]
            ],
            [
                'name'=>'NotEmpty',
                'break_chain_on_failure'=>true,
                'options'=>[
                   
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'Email khong duoc rong',
                    ]   
                ]
            ],
            [
                'name'=>'StringLength',
                'break_chain_on_failure'=>true,
                'options'=>[
                    
                    'min'=>5,
                    'max'=>20,
                    'messages'=>[
                        ValidatorStringLength::TOO_SHORT=>'email it nhat %min% ky tu',
                        ValidatorStringLength::TOO_LONG=>'email khong qua %max% ky tu'
                        
                    ]
                ]
            ],
            [
                'name'=>'EmailAddress',
                'break_chain_on_failure'=>true,
                'options'=>[
                    
                    'message'=>[
                        ValidatorEmailAddress::INVALID_FORMAT=>'email khong dung dinh dang',
                        ValidatorEmailAddress::INVALID_HOSTNAME=>'host name khong dung',
                    ]
                ]
            ],
            

            

        ]

        ]);
        //ngay sinh
        $inputfilter ->add([
            'name'=>'ngaysinh',
            'required'=>true,
           
            'validators'=>[
            [
                'name'=>'Date',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        Date::INVALID_DATE=>'khong dung dinh dang',
                        
                    ]

                ]
            ]  ,      
            [
                'name'=>'NotEmpty',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'ngaysinh khong duoc rong',
                        
                    ]
                ]
               
            ],
            
            
            ]

        ]);
    }
    

    public function editvalidator(){
        $inputfilter = new InputFilter();
        $this-> setInputFilter($inputfilter);
        //username
        $inputfilter ->add([
            'name'=>'username',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StringToLower'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
            [
                'name'=>'NotEmpty',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'Username khong duoc rong',
                    ]
                ]
            ],
            [
                'name'=>'StringLength',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'min'=>5,
                    'max'=>10,
                    'messages'=>[
                        ValidatorStringLength::TOO_SHORT=>'username it nhat %min% ky tu',
                        ValidatorStringLength::TOO_LONG=>'username khong qua %max% ky tu'
                    ]
                ]
            ] 

            ]

        ]);
        
        
        
        //hoten
        $inputfilter ->add([
            'name'=>'hoten',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
            [
                'name'=>'NotEmpty',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'ten khong duoc rong',
                    ]
                ]
            ],
            [
                'name'=>'StringLength',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'max'=>20,
                    'messages'=>[
                        
                        ValidatorStringLength::TOO_LONG=>'hoten khong qua %max% ky tu'
                    ]
                ]
            ] 

            ]

        ]);
        //email
        $inputfilter ->add([
            'name'=>'email',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[ 
            [
                'name'=>'Regex',
                'break_chain_on_failure'=>true,
                'options'=>[
                    'pattern'=>"/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",
                        
                    'message'=>[
                        Regex::NOT_MATCH=>'email phai chua cac ky tu %pattern%'
                    ]
                ]
            ],
            [
                'name'=>'NotEmpty',
                'break_chain_on_failure'=>true,
                'options'=>[
                   
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'Email khong duoc rong',
                    ]   
                ]
            ],
            [
                'name'=>'StringLength',
                'break_chain_on_failure'=>true,
                'options'=>[
                    
                    'min'=>5,
                    'max'=>20,
                    'messages'=>[
                        ValidatorStringLength::TOO_SHORT=>'email it nhat %min% ky tu',
                        ValidatorStringLength::TOO_LONG=>'email khong qua %max% ky tu'
                        
                    ]
                ]
            ],
            [
                'name'=>'EmailAddress',
                'break_chain_on_failure'=>true,
                'options'=>[
                    
                    'message'=>[
                        ValidatorEmailAddress::INVALID_FORMAT=>'email khong dung dinh dang',
                        ValidatorEmailAddress::INVALID_HOSTNAME=>'host name khong dung',
                    ]
                ]
            ],
            

            

        ]

        ]);
        //ngay sinh
        $inputfilter ->add([
            'name'=>'ngaysinh',
            'required'=>true,
           
            'validators'=>[
            [
                'name'=>'Date',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        Date::INVALID_DATE=>'khong dung dinh dang',
                        
                    ]

                ]
            ]  ,      
            [
                'name'=>'NotEmpty',
                'options'=>[
                    'break_chain_on_failure'=>true,
                    'messages'=>[
                        ValidatorNotEmpty::IS_EMPTY=>'ngaysinh khong duoc rong',
                        
                    ]
                ]
               
            ],
            
            
            ]

        ]);
    }

    

}
?>