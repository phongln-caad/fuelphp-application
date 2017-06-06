<h2>Editing <span class='muted'>Category</span></h2>
<br>

<?php echo render('admin/categories/_form'); ?>
<p>
	<?php echo Html::anchor('admin/categories/view/'.$category->id, 'View'); ?> |
	<?php echo Html::anchor('admin/categories', 'Back'); ?></p>
