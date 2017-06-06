<?php
class Controller_Post extends Controller_Template
{

	public function action_index()
	{
		$data['posts'] = Model_Post::find('all');
		$this->template->title = "Posts";
		$this->template->content = View::forge('post/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('post');

		if ( ! $data['post'] = Model_Post::find($id))
		{
			Session::set_flash('error', 'Could not find post #'.$id);
			Response::redirect('post');
		}

		$this->template->title = "Post";
		$this->template->content = View::forge('post/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Post::validate('create');

			if ($val->run())
			{
				$post = Model_Post::forge(array(
					'title' => Input::post('title'),
					'content' => Input::post('content'),
					'cover' => Input::post('cover'),
					'status' => Input::post('status'),
					'created_by' => Input::post('created_by'),
					'updated_by' => Input::post('updated_by'),
				));

				if ($post and $post->save())
				{
					Session::set_flash('success', 'Added post #'.$post->id.'.');

					Response::redirect('post');
				}

				else
				{
					Session::set_flash('error', 'Could not save post.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Posts";
		$this->template->content = View::forge('post/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('post');

		if ( ! $post = Model_Post::find($id))
		{
			Session::set_flash('error', 'Could not find post #'.$id);
			Response::redirect('post');
		}

		$val = Model_Post::validate('edit');

		if ($val->run())
		{
			$post->title = Input::post('title');
			$post->content = Input::post('content');
			$post->cover = Input::post('cover');
			$post->status = Input::post('status');
			$post->created_by = Input::post('created_by');
			$post->updated_by = Input::post('updated_by');

			if ($post->save())
			{
				Session::set_flash('success', 'Updated post #' . $id);

				Response::redirect('post');
			}

			else
			{
				Session::set_flash('error', 'Could not update post #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$post->title = $val->validated('title');
				$post->content = $val->validated('content');
				$post->cover = $val->validated('cover');
				$post->status = $val->validated('status');
				$post->created_by = $val->validated('created_by');
				$post->updated_by = $val->validated('updated_by');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('post', $post, false);
		}

		$this->template->title = "Posts";
		$this->template->content = View::forge('post/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('post');

		if ($post = Model_Post::find($id))
		{
			$post->delete();

			Session::set_flash('success', 'Deleted post #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete post #'.$id);
		}

		Response::redirect('post');

	}

}
