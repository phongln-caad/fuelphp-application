<div>
    <?php $cover_path = \Fuel\Core\Config::get('params.folder_upload') . $post->cover; ?>
    <img src="<?php echo \Fuel\Core\Uri::base(false) . (\Fuel\Core\File::exists($cover_path) ? $cover_path : \Fuel\Core\Config::get('params.default_img')); ?>" class="img-responsive">

    <h2><?php echo $post->title ?></h2>
    <span class="pull-right">
        <?php if ($current_user && ($current_user->id == $post->user_id || \Auth\Auth::member(Model_User::ADMIN_GROUP))) : ?>
            <?php echo Html::anchor('admin/posts/edit/'.$post->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit'); ?>
        <?php endif; ?>
    </span>
</div>
<p>
    <strong>Category: </strong><?php echo $post->category->name ?>
</p>
<p>
    <strong>Posted: </strong><?php echo date('nS F, Y', $post->created_at) ?> (<?php echo Date::time_ago($post->created_at)?>)
    by <?php echo $post->user->username ?>
</p>

<p><?php echo nl2br($post->body) ?></p>

<hr />

<h3 id="comments">Comments</h3>

<?php foreach ($post->comments as $comment): ?>

    <p><?php echo Html::anchor($comment->website, $comment->name) ?> said "<?php echo $comment->message?>"</p>

<?php endforeach; ?>

<?php echo render('blog/comments/_form'); ?>