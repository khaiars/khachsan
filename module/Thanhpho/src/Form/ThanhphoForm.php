<?php

namespace Thanhpho\Form;

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


class ThanhPhoForm extends FormForm
{
    //private $action;
    public function __construct()
    {
        parent::__construct();
    }
    public function setaddForm()
    {
        $this->setAttributes([
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ]);
        $tentp = new Element\Text('tentp');
        $tentp->setLabel('Tên thành phố');
        $tentp->setLabelAttributes([
            'for' => 'tenlp',
            'class' => 'col-md-3 control-label'
        ]);
        $tentp->setAttributes([
            'class' => 'form-control',
            'id'    => 'tentp',
            'placeholder' => 'Nhập tên thành phố',
        ]);



        $btnSubmit  = new Element\Button('btnSubmit');
        $btnSubmit->setAttributes(
            [
                'class' => 'btn btn-success',
                'id'    => 'btnSubmit',
                'value' => 'Thêm ',
            ]
        );


        $urlhinh = new Element\File('urlhinh');
        $urlhinh->setLabel('hình ảnh');
        $urlhinh->setLabelAttributes(
            [
                'for' => 'image-file',
                'class' => 'col-md-3 control-label'
            ]
        );

        $this->add($tentp);
        $this->add($urlhinh);
        $this->add($btnSubmit);
    }



    public function validator()
    {
        $inputfilter = new InputFilter();
        $this->setInputFilter($inputfilter);
        $inputfilter->add([
            'name' => 'tentp',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines']
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'break_chain_on_failure' => true,
                        'messages' => [
                            ValidatorNotEmpty::IS_EMPTY => 'Tên thành phố không được rỗng',
                            
                        ]
                    ]
                ],
                

            ]

        ]);
        


        $inputfilter->add(
            [
                'name' => 'urlhinh',
                'required' => true,
                'filters' => [
                    [
                        'name' => 'filerenameupload',
                        'options' => [
                            'target' => 'images/thanhpho', //Thư mục
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
                            'extension' => ['jpg', 'png', 'gif', 'jpeg'],
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


    public function editvalidator()
    {
        $inputfilter = new InputFilter();
        $this->setInputFilter($inputfilter);
        //username
        $inputfilter->add([
            'name' => 'tentp',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
               
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines']
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'break_chain_on_failure' => true,
                        'messages' => [
                            ValidatorNotEmpty::IS_EMPTY => 'Tên thành phố không được rỗng',
                        ]
                    ]
                ],
                

            ]

        ]);
        


        $inputfilter->add(
            [
                'name' => 'urlhinh',
                'required' => true,
                'filters' => [
                    [
                        'name' => 'filerenameupload',
                        'options' => [
                            'target' => 'images/thanhpho', //Thư mục
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
                            'extension' => ['jpg', 'png', 'gif', 'jpeg'],
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
