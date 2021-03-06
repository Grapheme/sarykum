<?php

return array(

    'fields_i18n' => function() {

        return array(
            'prices' => array(
                'title' => 'Цены размещения',
                'type' => 'textarea',
                'default' => '',
            ),
            #/*
            'price' => array(
                'title' => 'Цена одноместного размещения ***',
                'type' => 'text',
                'default' => '',
                'others' => array(
                    #'placeholder' => 'Укажите цену'
                ),
            ),
            'price2' => array(
                'title' => 'Цена двухместного размещения ***',
                'type' => 'text',
                'default' => '',
                'others' => array(
                    #'placeholder' => 'Укажите цену'
                ),
            ),
            #*/
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
        );
    },

    'seo' => 1

);