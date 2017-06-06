<?php

namespace Fuel\Migrations;

use Fuel\Core\DB;

class Add_cat_id_to_posts
{
	public function up()
	{
		\DBUtil::add_fields('posts', array(
			'category_id' => array('constraint' => 11, 'type' => 'int', 'after' => 'cover'),

		));

        DB::update('posts')
            ->value("category_id", 1)
            ->execute();
	}

	public function down()
	{
		\DBUtil::drop_fields('posts', array(
			'category_id'

		));
	}
}