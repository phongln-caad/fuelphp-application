<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => 'mysql:host=172.18.0.1;dbname=fuelphp',
            'username'   => 'root',
            'password'   => 'root',
        ),
        'charset'   =>  'utf8',
    )
);
