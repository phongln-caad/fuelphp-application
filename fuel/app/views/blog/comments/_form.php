<h3>Write a comment</h3>

<?php echo Form::open('blog/comment/' . $post->slug) ?>

    <div class="form-group">
        <label for="name" style="font-weight: bold;">Name:</label>
        <div class="input"><?php echo Form::input('name', $current_user ? $current_user->username : null, ['class' => 'col-md-12', 'readonly' => $current_user ? true : false]); ?></div>
    </div>

    <div class="form-group">
        <label for="website" style="font-weight: bold;">Website:</label>
        <div class="input"><?php echo Form::input('website', null, ['class' => 'col-md-12']); ?></div>
    </div>

    <div class="form-group">
        <label for="email" style="font-weight: bold;">Email:</label>
        <div class="input"><?php echo Form::input('email', $current_user ? $current_user->email : null, ['class' => 'col-md-12', 'readonly' => $current_user ? true : false]); ?></div>
    </div>

    <div class="form-group">
        <label for="message" style="font-weight: bold;">Comment:</label>
        <div class="input"><?php echo Form::textarea('message', null, ['class' => 'col-md-12', 'style' => 'resize: vertical;']); ?></div>
    </div>

    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <div class="input"><?php echo Form::submit('submit', 'Submit', ['class' => 'btn btn-primary']); ?></div>
    </div>

<?php echo Form::close() ?>
