<section id="app" class="container">
	<h1 class="row">User Account - <?php echo isset($user->UserName) ? $user->UserName : "" ?></h1>
	<input type="hidden" value="<?php echo isset($user->UserName) ? $user->UserName : "" ?>" id="username" /> <!-- required for vue script -->
	<!-- ref: https://getbootstrap.com/docs/4.2/components/forms/#switches 15/03/2020 -->
	<div class="custom-control custom-switch mt-4 ml-1 row">
		<input v-on:change="updateIsAdmin()" type="checkbox" class="custom-control-input" id="customSwitch1" <?php echo isset($user->isAdmin) && $user->isAdmin == 1 ? "checked" : "" ?>>
		<label class="custom-control-label" for="customSwitch1">Admin</label>
	</div>
</section>
