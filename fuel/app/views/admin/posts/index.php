<h2>Listing Posts</h2>
<br>
<?php if ($posts): ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Title</th>
			<th>Slug</th>
			<th>Summary</th>
			<th>Category</th>
			<th>Author</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($posts as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->slug; ?></td>
			<td><?php echo Str::truncate($item->summary, 60, ' ...'); ?></td>
			<td><?php echo $item->category->name ?></td>
			<td><?php echo $item->user->username; ?></td>
			<td>

                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?php echo Html::anchor('blog/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('admin/posts/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('admin/posts/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
                </div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
    <?php echo \Fuel\Core\Pagination::instance('posts_pagination')->render(); ?>
<?php else: ?>
<p>No Posts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/posts/create', 'Add new Post', array('class' => 'btn btn-success')); ?>

</p>
