<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($comment) ? $comment->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

				<?php echo Form::input('email', Input::post('email', isset($comment) ? $comment->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Website', 'website', array('class'=>'control-label')); ?>

				<?php echo Form::input('website', Input::post('website', isset($comment) ? $comment->website : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Website')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Message', 'message', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('message', Input::post('message', isset($comment) ? $comment->message : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Message', 'style' => 'resize: vertical;')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Post slug', 'post_id', array('class'=>'control-label')); ?>

            <div class="input">
                <?php echo Form::select('post_id', Input::post('post_id', isset($comment) ? $comment->post_id : null), $posts, array('class' => 'col-md-8 form-control')); ?>
            </div>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>