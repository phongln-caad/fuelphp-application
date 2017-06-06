<h2>Editing Post</h2>
<br>

<?php echo render('admin/posts/_form'); ?>
<p>
	<?php echo Html::anchor('blog/view/'.$post->slug, 'View'); ?> |
	<?php echo Html::anchor('admin/posts', 'Back'); ?></p>
