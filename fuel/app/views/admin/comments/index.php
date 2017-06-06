<h2>Listing Comments</h2>
<br>
<?php if ($comments): ?>
    <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Website</th>
			<th>Message</th>
			<th>Post id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($comments as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->website; ?></td>
			<td><?php echo $item->message; ?></td>
			<td><?php echo $item->post_id; ?></td>
			<td>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?php echo Html::anchor('admin/categories/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('admin/categories/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('admin/categories/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
                </div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Comments.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/comments/create', 'Add new Comment', array('class' => 'btn btn-success')); ?>

</p>
