<?php

return array(

    'fields' => array(

        'room_type' => array(

            'general' => array(
                /*
                'price' => array(
                    'title' => 'Цена',
                    'type' => 'text',
                    'default' => '',
                    'others' => array(
                        #'placeholder' => 'Укажите цену'
                    ),
                ),
                #*/
                /*
                'description' => array(
                    'title' => 'Описание номера',
                    'type' => 'textarea',
                    'default' => '',
                    'others' => array(
                        'placeholder' => 'Введите описание'
                    ),
                ),
                #*/
            ),

            'i18n' => array(
                'price' => array(
                    'title' => 'Цена',
                    'type' => 'text',
                    'default' => '',
                    'others' => array(
                        #'placeholder' => 'Укажите цену'
                    ),
                ),
                'description' => array(
                    'title' => 'Описание',
                    'type' => 'textarea_redactor',
                    'default' => '',
                    'others' => array(
                        #'placeholder' => 'Укажите описание'
                    ),
                ),
                'image' => array(
                    'title' => 'Основное изображение',
                    'type' => 'image',
                ),
                'gallery' => array(
                    'title' => 'Галерея',
                    'type' => 'gallery',
                    'handler' => function($array) {
                            #Helper::d('Gallery handler!');
                            #Helper::dd($array);
                            return ExtForm::process('gallery', array(
                                'module'  => 'dicval_meta',
                                'unit_id' => '[unknown] - single',
                                'gallery' => $array,
                                'single'  => true,
                            ));
                        }
                ),
            ),

        ),

    ),

    'seo' => array(
        'number_type' => 0,
    ),
);