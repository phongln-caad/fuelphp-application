<?php
$active_category = isset($active_category) ? $active_category : 'all';
?>
<ul class="nav nav-pills">
    <li role="presentation" class="<?php echo $active_category == 'all' ? 'active' : ''; ?>"><a href="<?php echo \Fuel\Core\Uri::update_query_string(['category_id' => 'all']) ?>">All</a></li>
    <?php foreach($category_list as $cat_id => $cat_name) : ?>
        <li role="presentation" class="<?php echo $active_category == $cat_id ? 'active' : ''; ?>"><a href="<?php echo \Fuel\Core\Uri::update_query_string([
                'category_id' => $cat_id
            ]) ?>"><?php echo $cat_name; ?></a></li>
    <?php endforeach; ?>
</ul>
<hr>
<h2>Recent Posts</h2>
<?php foreach ($posts as $post): ?>
    <div>
        <h3><?php echo Html::anchor('blog/view/' . $post->slug, $post->title) ?></h3>

        <p>
            <?php $cover_path = \Fuel\Core\Config::get('params.folder_upload') . $post->cover; ?>
            <a href="<?php echo \Fuel\Core\Uri::create('blog/view/'.$post->slug) ?>">
                <img src="<?php echo \Fuel\Core\Uri::base(false) . (\Fuel\Core\File::exists($cover_path) ? $cover_path : \Fuel\Core\Config::get('params.default_img')); ?>" class="img-responsive">
            </a>
        </p>

        <p>
            <?php echo $post->summary ?>
        </p>
        <a href="<?php echo \Fuel\Core\Uri::create('blog/view/'.$post->slug) ?>" class="btn btn-primary">Read More</a>
    </div>
<?php endforeach; ?>