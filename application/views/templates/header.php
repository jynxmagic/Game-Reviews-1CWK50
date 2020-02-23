<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('libs/css/bootstrap.min.css')?>">
	<?php if(isset($css_link)) echo $css_link ?>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="color: white">
			<?php if(isset($is_logged_in) && $is_logged_in == 1 && isset($username)) echo "Hi, $username. Nice to see you." ?>

			<ul class="nav float-right pl-4">
				<li class="nav-item pr-4"><a href="<?  echo base_url('/login') ?>">Login</a></li>
				<li class="nav-item pr-4"><a href="<?  echo base_url('/logout') ?>">Logout</a></li>
				<li class="nav-item pr-4"><a href="<?  echo base_url('/register') ?>">Register</a></li>
			</ul>
		</nav>
	</header>
