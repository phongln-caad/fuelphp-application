<?php

namespace Fuel\Migrations;

class Add_cover_to_posts
{
	public function up()
	{
		\DBUtil::add_fields('posts', array(
			'cover' => array('type' => 'text', 'after' => 'body', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('posts', array(
			'cover'

		));
	}
}