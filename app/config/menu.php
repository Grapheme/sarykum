<?php

return array(
	
	'header_menu' => function($params = array()) {

        return array(

            'active_class' => 'active',

            'tpl' => array(
                'container' => '
<ul class="nav-ul">%elements%
</ul>',
                'element_container' => '
    <li class="nav-li"%attr%>%element%',
                'element' => '
        <a data-hover="%text%" href="%url%"%attr%>
            <span>%text%
        </a>',
            ),

            'elements' => array(

                array(
                    '_route' => 'page',
                    '_params' => 'rooms',
                    '_text' => trans('interface.menu.rooms'),
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'spa',
                    '_text' => trans('interface.menu.spa'),
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'restaurant',
                    '_text' => trans('interface.menu.restaurant'),
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'services',
                    '_text' => trans('interface.menu.services'),
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'discover',
                    '_text' => trans('interface.menu.discover'),
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'actions',
                    '_text' => trans('interface.menu.actions'),
                ),

                /*
                array(
                    '_raw' => '123123123',
                    '_container_attributes' => array(
                        'class' => 'normal_li'
                    ),
                ),
                array(
                    '_href' => 'http://ya.ru',
                    '_text' => 'Яндекс',
                    'target' => '_blank',
                ),
                */
            ),
        );
    }

);
