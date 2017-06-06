<?php
class Controller_Admin_Categories extends Controller_Admin
{
    public function before()
    {
        parent::before();

        if (Request::active()->controller == 'Controller_Admin_Categories' && in_array(Request::active()->action, array('edit', 'delete')))
        {
            $post = Model_Post::find(end(\Fuel\Core\Request::active()->method_params));
            $postByUserId = !empty($post) ? $post->user_id : null;
            $admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;

            if ( !Auth::member($admin_group_id) && \Auth\Auth::get('id') != $postByUserId)
            {
                Session::set_flash('error', e('You don\'t have access to the edit/delete this post.'));
                Response::redirect(\Fuel\Core\Input::referrer());
            }
        }
    }

	public function action_index()
	{
		$data['categories'] = Model_Category::find('all');
		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/categories/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('categories');

		if ( ! $data['category'] = Model_Category::find($id))
		{
			Session::set_flash('error', 'Could not find category #'.$id);
			Response::redirect('categories');
		}

		$this->template->title = "Category";
		$this->template->content = View::forge('admin/categories/view', $data);

	}

	public function action_create()
	{
        $view = View::forge('admin/categories/create');

		if (Input::method() == 'POST')
		{
            $_post = Input::post();

            if(!empty($_post['default_parent_id'])) {
                $_post['parent_id'] = 0;
            }

			$val = Model_Category::validate('create');

			if ($val->run($_post))
			{
				$category = Model_Category::forge(array(
					'parent_id' => $_post['parent_id'],
					'name' => $_post['name'],
					'user_id' => $_post['user_id'],
				));

				if ($category and $category->save())
				{
					Session::set_flash('success', 'Added category #'.$category->id.'.');

					Response::redirect('admin/categories');
				}

				else
				{
					Session::set_flash('error', 'Could not save category.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

        $view->set_global('users', \Fuel\Core\Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
        $view->set_global('parent_category', \Fuel\Core\Arr::assoc_to_keyval(Model_Category::getParents(), 'id', 'name'));

		$this->template->title = "Categories";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('categories');
        $view = View::forge('admin/categories/edit');

		if ( ! $category = Model_Category::find($id))
		{
			Session::set_flash('error', 'Could not find category #'.$id);
			Response::redirect('categories');
		}

        $_post = Input::post();

		if(!empty($_post['default_parent_id'])) {
		    $_post['parent_id'] = Model_Category::DEFAULT_PARENT_ID;
        }
        if(!empty($_post['parent_id']) && $_post['parent_id'] == $id) {
            Session::set_flash('error', 'Cannot make this category became child of itself #'.$id);
            Response::redirect('admin/categories/edit' . "/$id");
        }

		$val = Model_Category::validate('edit');

		if ($val->run($_post))
		{
			$category->parent_id = $_post['parent_id'];
			$category->name = $_post['name'];
			$category->user_id = $_post['user_id'];

			if ($category->save())
			{
				Session::set_flash('success', 'Updated category #' . $id);

				Response::redirect('admin/categories');
			}

			else
			{
				Session::set_flash('error', 'Could not update category #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$category->parent_id = $val->validated('parent_id');
				$category->name = $val->validated('name');
				$category->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('category', $category, false);
		}

        $view->set_global('users', \Fuel\Core\Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
        $view->set_global('parent_category', \Fuel\Core\Arr::assoc_to_keyval(Model_Category::getParents($id), 'id', 'name'));

		$this->template->title = "Categories";
		$this->template->content = $view;

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('categories');

		if ($category = Model_Category::find($id))
		{
			$category->delete();

			Session::set_flash('success', 'Deleted category #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete category #'.$id);
		}

		Response::redirect('categories');

	}

}
