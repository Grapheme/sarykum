<?php

return array(

    'feedback' => array(
        'address' => 'support@grapheme.ru',
        #'address' => 'az@grapheme.ru',
        #'address' => 'reserved@mail.ru',
        #'subject' => 'ВидеоГид, обратная связь',
        'cc' => array('info@sarykum.com'),
    ),

    'driver' => 'smtp',
    'host' => 'in.mailjet.com',
    'port' => 587,
    'from' => array(
        #'address' => 'support@grapheme.ru',
        'address' => 'no-reply@sarykum.com',
        'name' => 'Sarykum'
    ),
    'username' => '0d8dd8623bd38b41c43683c41c0558eb',
    'password' => '465c500abd5f680f0b20405deb967b36',

    'sendmail' => '/usr/sbin/sendmail -bs',
    'encryption' => 'tls',

    'pretend' => 0,
);