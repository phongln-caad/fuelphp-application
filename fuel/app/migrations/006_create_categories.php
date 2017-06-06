<?php

namespace Fuel\Migrations;

use Fuel\Core\DB;
use Fuel\Core\DBUtil;

class Create_categories
{
	public function up()
	{
		\DBUtil::create_table('categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'parent_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		DB::insert("categories")->values([NULL, 1, "Default", 1, date("U"), date("U")])->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('categories');
	}
}