<section id="app" class="container">
	<?php
	if(isset($username) && $username != $user->UserName)
	{
		$disabled = "disabled";
	}
	else
	{
			$disabled = "";
	}?>

	<h1 class="row">User Account - <?php echo isset($user->UserName) ? $user->UserName : "" ?></h1>
	<input type="hidden" value="<?php echo isset($user->UserName) ? $user->UserName : "" ?>" id="username" /> <!-- required for vue script -->
	<!-- ref: https://getbootstrap.com/docs/4.2/components/forms/#switches 15/03/2020 -->
	<div class="custom-control custom-switch mt-4 ml-1 row">
		<input <?php echo $disabled?> v-on:change="updateIsAdmin()" type="checkbox" class="custom-control-input <?php echo $disabled?>" id="customSwitch1" <?php echo isset($user->isAdmin) && $user->isAdmin == 1 ? "checked" : "" ?>>
		<label class="custom-control-label" for="customSwitch1">Admin</label>
	</div>
	<div class="custom-control custom-switch mt-4 ml-1 row">
		<input <?php echo $disabled?> v-on:change="updateDarkMode()" type="checkbox" class="custom-control-input <?php echo $disabled?>" id="customSwitch2" <?php echo isset($user->DarkMode) && $user->DarkMode == 1 ? "checked" : "" ?>>
		<label class="custom-control-label" for="customSwitch2">Dark Mode</label>
	</div>
</section>
