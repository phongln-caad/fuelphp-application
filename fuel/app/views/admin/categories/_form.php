<?php echo Asset::js(array(
    'check_cat.js'
)); ?>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
        <div class="form-group">
            <?php echo Form::label('Parent Id', 'parent_id', array('class'=>'control-label')); ?>
            <br>
            (* Note: Unchecked this if you want to to select another parent)
            <div class="checkbox">
                <label style="font-weight: bold;">
                    <?php echo Form::checkbox('default_parent_id', true, ['checked' => isset($category) && $category->parent_id != Model_Category::DEFAULT_PARENT_ID ? false : true]); ?> Is default parent
                </label>
            </div>

            <div class="input" id="parentIdCustom">
                <?php echo Form::select('parent_id', Input::post('parent_id', isset($category) ? $category->parent_id : Model_Category::DEFAULT_PARENT_ID), $parent_category, array('class' => 'col-md-8 form-control')); ?>
            </div>

        </div>

        <div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($category) ? $category->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

            <?php echo Form::select('user_id', Input::post('user_id', isset($post) ? $post->user_id : $current_user->id), $users, array('class' => 'col-md-8 form-control')); ?>

		</div>

        <div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>
