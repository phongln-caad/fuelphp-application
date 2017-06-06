<?php
class Model_Post extends \Orm\Model
{
    protected static $_belongs_to = [
        'user',
        'category'
    ];
    protected static $_has_many = [
        'comments'
    ];

	protected static $_properties = array(
		'id',
		'title',
		'slug',
		'summary',
		'body',
        'cover',
        'category_id',
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
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('slug', 'Slug', 'required|max_length[255]');
		$val->add_field('summary', 'Summary', 'required');
		$val->add_field('body', 'Body', 'required');
        $val->add_field('category_id', 'Category', 'required|valid_string[numeric]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');

		return $val;
	}

	 public function uploadCover() {
         // if there are any valid files
         if (Upload::is_valid())
         {
             Upload::save(\Fuel\Core\Config::get('params.upload_path'));
             $_files = Upload::get_files(0);

             $this->cover = $_files['saved_as'];
         }
     }

}
