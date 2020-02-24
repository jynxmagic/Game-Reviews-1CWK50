<?php echo doctype() ?>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
	<?php echo meta('viewport', 'width=device-width, initial-scale=1, shrink-to-fit=no'); ?>
	<?php if(isset($title)) echo meta('title', $title); ?>
	<?php if(isset($description)) echo meta('description', $description) ?>


	<?php echo link_tag('application/css/bootstrap.min.css'); ?>
	<?php echo link_tag('application/images/favicon.png', 'shortcut icon', 'image/ico'); ?>

</head>
<body class="bg-dark text-white min-vh-100">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">

			<a href="<?php echo base_url() ?>"><p class="text-white font-weight-bolder pl-1 mt-3">Game Reviews</p> </a>


			<?php if(isset($is_logged_in) && isset($username)) echo "<p class=\"text-white pl-5 mt-3\">Hi, $username. Nice to see you.</p>"?>

			<ul class="nav float-right pl-4">
				<li class="nav-item pr-4"><a href="<?php  echo base_url('/login') ?>">Login</a></li>
				<li class="nav-item pr-4"><a href="<?php  echo base_url('/logout') ?>">Logout</a></li>
				<li class="nav-item pr-4"><a href="<?php  echo base_url('/register') ?>">Register</a></li>
				<li class="nav-item pr-4"><a href="<?php  echo base_url('/reviews') ?>">Latest Reviews</a></li>
				<?php
				if(isset($is_logged_in) && isset($username)) {
					$href = base_url('account/'.$username);
					echo "<li class=\"nav-item pr-4\"><a href=\"$href\">My Account</a></li>";
				}
				?>
			</ul>
		</nav>
	</header>
