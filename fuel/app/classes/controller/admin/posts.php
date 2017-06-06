<?php
class Controller_Admin_Posts extends Controller_Admin
{
    public function before()
    {
        parent::before();

        if (Request::active()->controller == 'Controller_Admin_Posts' && in_array(Request::active()->action, array('edit', 'delete')))
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
        $pagination = Pagination::forge('posts_pagination', [
            'pagination_url' => Uri::base(false) .  \Fuel\Core\Request::active()->uri->get(),
            'total_items'    => Model_Post::count(),
            'per_page'       => 10,
            'uri_segment'    => 'page'
        ]);
		$data['pagination'] = $pagination;
		$data['posts'] = Model_Post::query()
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

		$this->template->title = "Posts";
		$this->template->content = View::forge('admin/posts/index', $data);

	}

	public function action_view($id = null)
	{
		$data['post'] = Model_Post::find($id);

		$this->template->title = "Post";
		$this->template->content = View::forge('admin/posts/view', $data);

	}

	public function action_create()
	{
        $view = View::forge('admin/posts/create');

		if (Input::method() == 'POST')
		{
            $_post = Input::post();
            $_post['slug'] = !empty(Input::post('slug')) ? \Fuel\Core\Inflector::friendly_title(Input::post('title'), '-', true) : null;
			$val = Model_Post::validate('create');

			if ($val->run($_post))
			{
				$post = Model_Post::forge($_post);

                $post->uploadCover();

				if ($post and $post->save())
				{
					Session::set_flash('success', e('Added post #'.$post->id.'.'));

					Response::redirect('admin/posts');
				}

				else
				{
					Session::set_flash('error', e('Could not save post.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$view->set_global('users', \Fuel\Core\Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
        $view->set_global('categories', \Fuel\Core\Arr::assoc_to_keyval(Model_Category::find('all'), 'id', 'name'));

		$this->template->title = "Posts";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
        $_post = Input::post();
        $_post['slug'] = (!empty(Input::post('title')) && empty(Input::post('slug'))) ? \Fuel\Core\Inflector::friendly_title(Input::post('title'), '-', true) : Input::post('slug');
        $view = View::forge('admin/posts/edit');

		$post = Model_Post::find($id);
		$val = Model_Post::validate('edit');

		if ($val->run($_post))
		{
			$post->title = $_post['title'];
			$post->slug = $_post['slug'];
			$post->summary = $_post['summary'];
			$post->body = $_post['body'];
            $post->category_id = $_post['category_id'];
			$post->user_id = $_post['user_id'];

            $post->uploadCover();

			if ($post->save())
			{
				Session::set_flash('success', e('Updated post #' . $id));

				if(\Auth\Auth::get('group') == 100) Response::redirect('admin/posts');
                Response::redirect('blog/view/' . $post->slug);
			}

			else
			{
				Session::set_flash('error', e('Could not update post #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$post->title = $val->validated('title');
				$post->slug = $val->validated('slug');
				$post->summary = $val->validated('summary');
				$post->body = $val->validated('body');
				$post->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('post', $post, false);
		}

        $view->set_global('users', \Fuel\Core\Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
        $view->set_global('categories', \Fuel\Core\Arr::assoc_to_keyval(Model_Category::find('all'), 'id', 'name'));

		$this->template->title = "Posts";
		$this->template->content = $view;

	}

	public function action_delete($id = null)
	{
		if ($post = Model_Post::find($id)) {
            Model_Comment::query()->where('post_id', '=', $id)->delete();
            if(!empty($post->cover)) File::delete(\Fuel\Core\Config::get('params.folder_upload') . $post->cover);
			$post->delete();

			Session::set_flash('success', e('Deleted post #'.$id));
		} else {
			Session::set_flash('error', e('Could not delete post #'.$id));
		}

		Response::redirect('admin/posts');

	}

}
