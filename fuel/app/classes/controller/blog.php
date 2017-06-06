<?php

class Controller_Blog extends Controller_Base
{
    public $template = 'blog/template';

	public function action_index()
	{
	    $view = \Fuel\Core\View::forge('blog/index');

        $where = [];
        $category_id = \Fuel\Core\Input::get('category_id');
        if($category_id != null && $category_id != 'all') {
            $where = ['category_id' => $category_id];
        }
        $view->posts = Model_Post::find('all', [
            'where' => $where
        ]);

        $view->category_list = \Fuel\Core\Arr::assoc_to_keyval(Model_Category::find('all', [
            'where' => [
                ['parent_id', '!=', Model_Category::DEFAULT_PARENT_ID]
            ]
        ]), 'id', 'name');
        $view->active_category = $category_id;

		$this->template->title = 'Blog';
		$this->template->content = $view;
	}

    public function action_view($slug)
    {
        $post = Model_Post::find_by_slug($slug, [
            'related' => [
                'user',
                'comments',
                'category'
            ]
        ]);

        $view = \Fuel\Core\View::forge('blog/view');
        $view->set_global('post', $post);

        $this->template->title = $post->title;
        $this->template->content = $view;
    }

    public function action_comment($post_slug)
    {
        $post = Model_Post::find_by_slug($post_slug);

        if(\Fuel\Core\Input::post('name') && \Fuel\Core\Input::post('email')
                    && \Fuel\Core\Input::post('message')) {
            // Create a new comment
            $post->comments[] = new Model_Comment(array(
                'name' => Input::post('name'),
                'website' => Input::post('website'),
                'email' => Input::post('email'),
                'message' => Input::post('message'),
                'user_id' => $this->current_user->id,
            ));

            // Save the post and the comment will save too
            if ($post->save())
            {
                $comment = end($post->comments);
                Session::set_flash('success', 'Added comment #'.$comment->id.'.');
            }
            else
            {
                Session::set_flash('error', 'Could not save comment.');
            }

            Response::redirect('blog/view/' . $post_slug);
        } else { // Did not have all the fields
            // Just show the view again until they get it right
            Session::set_flash('error', 'Please check again and make sure do not let field `name`, `email` and `comment` blank.');
            $this->action_view($post_slug);
        }

//        $view = View::forge('admin/posts/create');

//        if (Input::method() == 'POST')
//        {
//            $val = Model_Comment::validate('create');
//
//            if ($val->run())
//            {
//                $comment = Model_Comment::forge(array(
//                    'name' => Input::post('name'),
//                    'email' => Input::post('email'),
//                    'website' => Input::post('website'),
//                    'message' => Input::post('message'),
//                    'post_id' => $post->id,
//                ));
//
//                if ($comment and $comment->save())
//                {
//                    Session::set_flash('success', e('Added comment #'.$comment->id.'.'));
//
//                    Response::redirect('blog/view/' . $post_slug);
//                }
//
//                else
//                {
//                    Session::set_flash('error', e('Could not save comment.'));
//                }
//            }
//            else
//            {
//                Session::set_flash('error', $val->error());
//            }
//        }
//
//        $view->set_global('users', \Fuel\Core\Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
//
//        $this->template->title = "Posts";
//        $this->template->content = \Fuel\Core\View::forge('blog/view', [
//            'post' => $post
//        ]);
    }

}
