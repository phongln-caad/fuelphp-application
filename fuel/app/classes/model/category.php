<?php
use Orm\Model;

class Model_Category extends Model
{
    const DEFAULT_PARENT_ID = 0;

    protected static $_belongs_to = [
        'user',
    ];

    protected static $_has_many = [
        'posts'
    ];

	protected static $_properties = array(
		'id',
		'parent_id',
		'name',
		'user_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('parent_id', 'Parent Id', 'required|valid_string[numeric]');
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');

		return $val;
	}

	public static function getParents($catId = null)
    {
        $query = self::query();

        if($catId != null) $query->and_where_open()
            ->where('id', '<>', $catId)
            ->and_where_close();

        return $query->get();
    }

}
