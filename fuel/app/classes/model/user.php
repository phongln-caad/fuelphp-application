<?php

class Model_User extends \Orm\Model
{
    const ADMIN_GROUP = 100;
    const GUEST_GROUP = 0;
    const USER_GROUP = 1;
    const MODERATOR_GROUP = 50;
    const BANNED_GROUP = -1;

    protected static $_has_many = [
        'posts',
        'comments'
    ];
    protected static $_belongs_to = [
        'user'
    ];

	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'users';

}
