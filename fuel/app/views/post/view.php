<h2>Viewing <span class='muted'>#<?php echo $post->id; ?></span></h2>

<p>
	<strong>Title:</strong>
	<?php echo $post->title; ?></p>
<p>
	<strong>Content:</strong>
	<?php echo $post->content; ?></p>
<p>
	<strong>Cover:</strong>
	<?php echo $post->cover; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $post->status; ?></p>
<p>
	<strong>Created by:</strong>
	<?php echo $post->created_by; ?></p>
<p>
	<strong>Updated by:</strong>
	<?php echo $post->updated_by; ?></p>

<?php echo Html::anchor('post/edit/'.$post->id, 'Edit'); ?> |
<?php echo Html::anchor('post', 'Back'); ?>