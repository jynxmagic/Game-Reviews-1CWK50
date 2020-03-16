<section id="app" class="container">
	<h1 class="row">User Account - <?php echo isset($user->UserName) ? $user->UserName : "" ?></h1>
	<input type="hidden" value="<?php echo isset($user->UserName) ? $user->UserName : "" ?>" id="username" /> <!-- required for vue script -->
	<!-- ref: https://getbootstrap.com/docs/4.2/components/forms/#switches 15/03/2020 -->
	<div v-if="is_admin == 1">
		<div class="custom-control custom-switch mt-4 ml-1 row">
			<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
			<label class="custom-control-label" for="customSwitch1">Admin</label>
		</div>
	</div>
	<div v-else>
		<div class="custom-control custom-switch mt-4 ml-1 row">
			<input type="checkbox" class="custom-control-input" id="customSwitch1">
			<label class="custom-control-label" for="customSwitch1">Admin</label>
		</div>
	</div>
</section>
