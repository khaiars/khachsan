<?php

namespace Loaiphong\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\StringLength;
use Laminas\Validator\File\IsImage;
use Laminas\Validator\Regex;

class LoaiPhongForm extends Form
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

        $tenlp = new Element\Text('tenlp');
        $tenlp->setLabel('Tên loại phòng');
        $tenlp->setLabelAttributes([
            'for' => 'tenlp',
            'class' => 'col-md-3 control-label'
        ]);
        $tenlp->setAttributes([
            'class' => 'form-control',
            'id'    => 'tenlp',
            'placeholder' => 'Nhập tên loại phòng',
        ]);

        $gia = new Element\Text('gia');
        $gia->setLabel('Giá');
        $gia->setLabelAttributes(
            [
                'for' => 'gia',
                'class' => 'col-md-3 control-label'
            ]
        );
        $gia->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'gia',
                'placeholder' => 'Giá'
            ]
        );
        
        $tenks = new Element\Select('tenks');
        $tenks->setLabel('Khách Sạn');
        $tenks->setLabelAttributes(
            [
                'for' => 'Tên Khách Sạn',
                'class' => 'col-md-3 control-label'
            ]
        );
        $tenks->setAttributes(
            [
                'class' => 'form-control',
                'id' => 'tenks',
                
                
            ]
        );
        $urlhinh = new Element\File('urlhinh');
        $urlhinh->setLabel('Hình ảnh');
        $urlhinh->setLabelAttributes(
            [
                'for' => 'image-file',
                'class' => 'col-md-3 control-label'
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
        $this->add($urlhinh);
        $this->add($tenks);
        
        $this->add($tenlp);
        $this->add($gia);
        $this->add($btnSubmit);
    }



    public function validator()
    {
        $inputfilter = new InputFilter();
        $this->setInputFilter($inputfilter);
        //username
        $inputfilter->add([
            'name' => 'tenlp',
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
                            NotEmpty::IS_EMPTY => 'Tên loại phòng không được rỗng',
                        ]
                    ]
                ],


            ]

        ]);


        $inputfilter->add([
            'name' => 'gia',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines']
            ],
            'validators' => [
                [
                    'name' => 'Regex',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'pattern' => "/^[1-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]*$/",
                        //'pattern'=>"/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",

                        'message' => [
                            Regex::NOT_MATCH => 'Giá không chỉ bao gồm số và lớn hơn 100000'
                        ]
                    ]
                ],
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [

                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Giá khong duoc rong',
                        ]
                    ]
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [


                        'max' => 20,
                        'messages' => [

                            StringLength::TOO_LONG => 'Giá khong qua %max% ky tu'

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
                            'target' => 'images/loaiphong', //Thư mục
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
            'name' => 'tenlp',
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
                            NotEmpty::IS_EMPTY => 'Tên loại phòng không được rỗng',
                        ]
                    ]
                ],
            ]
        ]);

        $inputfilter->add([
            'name' => 'gia',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines']
            ],
            'validators' => [
                [
                    'name' => 'Regex',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'pattern' => "/^[1-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]*$/",
                        //'pattern'=>"/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",

                        'message' => [
                            Regex::NOT_MATCH => 'Giá không chỉ bao gồm số và lớn hơn 100000'
                        ]
                    ]
                ],
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [

                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Giá khong duoc rong',
                        ]
                    ]
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'max' => 20,
                        'messages' => [
                            StringLength::TOO_LONG => 'Giá khong qua %max% ky tu'
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
                            'target' => 'images/loaiphong', //Thư mục
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
