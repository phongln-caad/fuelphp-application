<?php
/**
 * Created by PhpStorm.
 * User: dt0343
 * Date: 3/2/17
 * Time: 09:09
 */
return [
    'groups' => [
        -1 => ['name' => 'Banned', 'roles' => ['banned']],
        0 => ['name' => 'Guests', 'roles' => []],
        1 => ['name' => 'Users', 'roles' => ['user']],
        50 => ['name' => 'Moderators', 'roles' => ['user', 'moderator']],
        100  => ['name' => 'Administrators', 'roles' => ['user', 'moderator', 'admin']],
    ]
];