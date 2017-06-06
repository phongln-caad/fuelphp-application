<h2>Viewing <span class='muted'>#<?php echo $category->id; ?></span></h2>

<p>
	<strong>Parent id:</strong>
	<?php echo $category->parent_id; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $category->name; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $category->user_id; ?></p>

<?php echo Html::anchor('categories/edit/'.$category->id, 'Edit'); ?> |
<?php echo Html::anchor('categories', 'Back'); ?>