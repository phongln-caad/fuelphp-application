<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($post) ? $post->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Content', 'content', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('content', Input::post('content', isset($post) ? $post->content : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Content')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Cover', 'cover', array('class'=>'control-label')); ?>

				<?php echo Form::input('cover', Input::post('cover', isset($post) ? $post->cover : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cover')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>

				<?php echo Form::input('status', Input::post('status', isset($post) ? $post->status : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Created by', 'created_by', array('class'=>'control-label')); ?>

				<?php echo Form::input('created_by', Input::post('created_by', isset($post) ? $post->created_by : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Created by')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Updated by', 'updated_by', array('class'=>'control-label')); ?>

				<?php echo Form::input('updated_by', Input::post('updated_by', isset($post) ? $post->updated_by : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Updated by')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>