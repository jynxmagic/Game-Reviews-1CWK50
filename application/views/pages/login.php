<?php echo validation_errors(); ?>


<?php
$username_input_config = array (
	'name'          => 'username',
	'id'            => 'username',
	'value'         => set_value('username'),
	'maxlength'     => '16',
	'required'		=> true,
	'class'			=> 'col-9'
);
$password_input_config= array (
	'name'          => 'password',
	'id'            => 'password',
	'value'         => set_value('password'),
	'maxlength'     => '16',
	'required'		=> true,
	'class'			=> 'col-9'
);
?>

<section class="container mt-3">
	<h1 class="row border-bottom mb-3 pb-3 justify-content-center">Login page</h1>
	<div class="row">
		<?php echo form_fieldset('User Information'); ?>
	</div>
	<?php if(isset($error)) echo $error ?>

	<?php echo form_open('login/do-login'); ?>
	<div class="form-group row">

		<?php echo form_label('Username:', 'username', array('class' => 'col-form-label col-3 font-weight-bold', 'for' => 'username')); ?>
		<?php echo form_input($username_input_config ); ?>
	</div>
	<div class="form-group row mt-3">
		<?php echo form_label('Password:', 'password', array('class' => 'col-form-label col-3 font-weight-bold', 'for' => 'password')); ?>
		<?php echo form_password($password_input_config); ?>
	</div>
	<div class="row justify-content-center">
		<?php echo form_submit('submit', 'Submit', 'class="btn-lg justify-content-before mt-4"') ?>
	</div>
		<?php echo form_fieldset_close() ?>

</section>
