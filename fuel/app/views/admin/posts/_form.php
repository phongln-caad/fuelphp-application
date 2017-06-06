<?php echo Form::open(array("class"=>"form-horizontal", 'enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($post) ? $post->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Slug', 'slug', array('class'=>'control-label')); ?>

				<?php echo Form::input('slug', Input::post('slug', isset($post) ? $post->slug : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Slug')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Summary', 'summary', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('summary', Input::post('summary', isset($post) ? $post->summary : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Summary', 'style' => 'resize: vertical;')); ?>

		</div>
		<div class="form-group">
            <?php echo Form::label('Body', 'body', array('class'=>'control-label')); ?>

            <?php echo Form::textarea('body', Input::post('body', isset($post) ? $post->body : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Body', 'style' => 'resize: vertical;')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Cover', 'cover', array('class'=>'control-label')); ?>

            <?php echo Form::file('cover', array('class' => 'col-md-4 form-control', 'placeholder'=>'Cover', 'value' => isset($post) ? $post->cover : '')); ?>

        </div>
        <?php if(isset($post) && !empty($post->cover) && \Fuel\Core\File::exists(\Fuel\Core\Config::get('params.folder_upload') . $post->cover)) : ?>
            <div class="form-group">
                * Note: This post had already being have cover image. Upload another image if you want to change.
                <img src="<?php echo \Fuel\Core\Uri::base(false) . \Fuel\Core\Config::get('params.folder_upload') . $post->cover; ?>" class="img-responsive">
            </div>

        <?php endif; ?>

        <div class="form-group">
            <?php echo Form::label('Category', 'category_id', array('class'=>'control-label')); ?>

            <div class="input">
                <?php echo Form::select('category_id', Input::post('category_id', isset($post) ? $post->category_id : null), $categories, array('class' => 'col-md-8 form-control')); ?>
            </div>

        </div>

		<div class="form-group">
			<?php echo Form::label('Username', 'user_id', array('class'=>'control-label')); ?>
            <div class="input">
                <?php echo Form::select('user_id', Input::post('user_id', isset($post) ? $post->user_id : $current_user->id), $users, array('class' => 'col-md-8 form-control')); ?>
            </div>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>