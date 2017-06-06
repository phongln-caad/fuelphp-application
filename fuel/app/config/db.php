<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => 'mysql:host=127.0.0.1:3306;dbname=fuelphp',
            'username'   => 'root',
            'password'   => 'root',
        ),
        'charset'   =>  'utf8',
    )
);
