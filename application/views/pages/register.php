<?php
echo validation_errors(); ?>

<?php
$username_input_config = array (
	'name'          => 'username',
	'id'            => 'username',
	'value'         => set_value('username'),
	'maxlength'     => '16',
	'required'		=> true,
	'placeholder'	=> 'Username'
);
$password_input_config= array (
	'name'          => 'password',
	'id'            => 'password',
	'value'         => set_value('password'),
	'maxlength'     => '16',
	'required'		=> true,
	'placeholder'	=> 'Password'
);
?>

<section>
	<h1>Register page</h1>
	<?php if(isset($error)) echo $error ?>

	<?php echo form_open('register/do-register'); ?>
	<?php echo form_fieldset('User Information'); ?>
	<?php echo form_label('Username:', 'username'); ?>
	<?php echo form_input($username_input_config ); ?>
	<?php echo form_label('Password:', 'password'); ?>
	<?php echo form_password($password_input_config); ?>
	<?php echo form_submit('submit', 'Submit', 'class="btn-lg"') ?>
	<?php echo form_fieldset_close() ?>
</section>
