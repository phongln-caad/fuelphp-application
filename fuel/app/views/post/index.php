<h2>Listing <span class='muted'>Posts</span></h2>
<br>
<?php if ($posts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Content</th>
			<th>Cover</th>
			<th>Status</th>
			<th>Created by</th>
			<th>Updated by</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($posts as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->content; ?></td>
			<td><?php echo $item->cover; ?></td>
			<td><?php echo $item->status; ?></td>
			<td><?php echo $item->created_by; ?></td>
			<td><?php echo $item->updated_by; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('post/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('post/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('post/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Posts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('post/create', 'Add new Post', array('class' => 'btn btn-success')); ?>

</p>
