<?php 
namespace Khachsan\Form;

use Laminas\Form\Annotation\InputFilter as AnnotationInputFilter;
use Laminas\Form\Annotation\Validator;
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


class KhachsanForm extends FormForm{
     //private $action;
     public function __construct()
     {
        parent::__construct();
        // $this->setAttributes([
        //      'name'=>'user-form',
        //      'class'=>'form-horizontal',
        //      'method' => 'post'
             
        // ]);
        // $this->action= $action;
        // $this->setaddForm();
        // $this->validator();
     }
    public function setaddForm()
    {
        $this->setAttributes([
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ]);
        $tenks = new Element\Text('tenks');
        $tenks->setLabel('Tên Khách sạn');
        $tenks->setLabelAttributes([
            'for' => 'tenlp',
            'class'=>'col-md-3 control-label'
        ]);
        $tenks->setAttributes([
            'class' => 'form-control',
            'id'    => 'tenlp',
            'placeholder' => 'Nhập tên khách sạn',
        ]);
    
        $gia = new Element\Text('gia');
        $gia->setLabel('Giá');
        $gia->setLabelAttributes(
            [
                'for' => 'gia',
                'class'=>'col-md-3 control-label'
            ]
        );
        $gia->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'gia',
                'placeholder' => 'Giá'
            ]
        );
        
        $btnSubmit  = new Element\Button('btnSubmit');
        $btnSubmit->setAttributes(
            [
                'class' => 'btn btn-success',
                'id'    => 'btnSubmit',
                'value' => 'Thêm',
            ]
        );
        
        $diachi = new Element\Text('diachi');
        $diachi->setLabel('Địa chỉ');
        $diachi->setLabelAttributes(
            [
                'for' => 'diachi',
                'class'=>'col-md-3 control-label'
            ]
        );
        $diachi->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'diachi',
                'placeholder' => 'Địa chỉ'
            ]
        );

        $tentp = new Element\Select('tentp');
        $tentp->setLabel('Tên Thành Phố');
        $tentp->setLabelAttributes(
            [
                'for' => 'tentp',
                'class'=>'col-md-3 control-label'
            ]
        );
        $tentp->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'tentp',
                
            ]
        );
        $hinhks = new Element\File('hinhks');
        $hinhks->setLabel('hình ảnh');
        $hinhks->setLabelAttributes(
            [
                'for' => 'image-file',
                'class'=>'col-md-3 control-label'
            ]
        );
        $this->add($diachi);
        $this->add($tenks);
        $this->add($hinhks);
        $this->add($tentp);
        $this->add($btnSubmit);    
    }



    public function validator(){
        $inputfilter = new InputFilter();
        $this-> setInputFilter($inputfilter);
        $inputfilter ->add([
            'name'=>'tenks',
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
                        ValidatorNotEmpty::IS_EMPTY=>'Tên loại phòng không được rỗng',
                    ]
                ]
            ],
            

            ]

        ]);
        $inputfilter ->add([
            'name'=>'diachi',
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
                        ValidatorNotEmpty::IS_EMPTY=>'Tên loại phòng không được rỗng',
                    ]
                ]
            ]
            ]
            ]);
            
        $inputfilter->add(
            [
                'name' => 'hinhks',
                'required' => true,
                'filters'=>[
                    [
                        'name' => 'filerenameupload',
                        'options' => [
                            'target' => 'images/khachsan', //Thư mục
                            'use_upload_name' => true, //Sử dụng tên file gốc
                            'use_upload_extension' => true, //Sử dụng tên file gốc
                            'overwrite' => true,
                            'randomize' => false,
                        ]
                    ],
                ],
                'validators' => [
                    [
                        'name' => \Laminas\Validator\File\Extension::class,
                        'options' => [
                            //Loại file được upload
                            'extension' => ['jpg','png','gif','jpeg'],
                            'case' => false //không phân biệt HOA/thường
                        ]
                    ],
                    [
                        //Phải là file ảnh
                        'name' => \Laminas\Validator\File\IsImage::class,
                    ],
                ],
    
    
            ]
        );
            
            
    
        
                  
        
        
       
        
    }
    

    public function editvalidator(){
        $inputfilter = new InputFilter();
        $this-> setInputFilter($inputfilter);
        //username
        $inputfilter ->add([
            'name'=>'tenks',
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
                        ValidatorNotEmpty::IS_EMPTY=>'Tên loại phòng không được rỗng',
                    ]
                ]
            ],
            

            ]

        ]);
        $inputfilter ->add([
            'name'=>'diachi',
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
                        ValidatorNotEmpty::IS_EMPTY=>'Tên loại phòng không được rỗng',
                    ]
                ]
            ]
            ]
            ]);
            $inputfilter ->add([
                'name'=>'idtp',
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
                            ValidatorNotEmpty::IS_EMPTY=>'Phải nhập Id thành phố',
                        ]
                    ]
                ]
                ]
                ]);
        
        $inputfilter->add(
            [
                'name' => 'hinhks',
                'required' => true,
                'filters'=>[
                    [
                        'name' => 'filerenameupload',
                        'options' => [
                            'target' => 'images/khachsan', //Thư mục
                            'use_upload_name' => true, //Sử dụng tên file gốc
                            'use_upload_extension' => true, //Sử dụng tên file gốc
                            'overwrite' => true,
                            'randomize' => false,
                        ]
                    ],
                ],
                'validators' => [
                    [
                        'name' => \Laminas\Validator\File\Extension::class,
                        'options' => [
                            //Loại file được upload
                            'extension' => ['jpg','png','gif','jpeg'],
                            'case' => false //không phân biệt HOA/thường
                        ]
                    ],
                    [
                        //Phải là file ảnh
                        'name' => \Laminas\Validator\File\IsImage::class,
                    ],
                ],
    
    
            ]
        );
            
            
    
        
                  
        
        
       
        
    }

    

}
?>