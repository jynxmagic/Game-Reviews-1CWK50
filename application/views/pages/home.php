
<div id="carouselHome" class="carousel slide" data-ride="carousel">
	<!-- Carousel Indicators -->
	<ol class="carousel-indicators">
		<?php
		##removing the first slide (with active tag) from the foreach allows us to not perform logic over the loop
		echo "<li data-target='carouselHome' data-slide-to='0' class='active'></li>";
		for($i = 1; $i < sizeof($result); $i++)
		{
			echo "<li data-target='carouselHome' data-slide-to='$i'></li>";
		}
		?>
	</ol>

	<!-- Carousel Images -->
	<div class="carousel-inner">

		<?php
		$class = "carousel-item active";
		foreach($result as $row)
		{
			$img_url = base_url('application/images/'.$row->ReviewImage);
			$account_url = site_url('account/'.$row->UserName);
			echo <<<EOT
		<div class="$class img-fluid">
			<img src="$img_url" alt="$row->GameName" height="500px" width="100%">
			<div class="carousel-caption d-none d-md-block bg-dark border-top border-left border-right pb-5 rounded-top" style="bottom: 0;">
				<h5>$row->GameName</h5>
				<p>$row->GameReview</p>
				<small>Review by: <a href="$account_url">$row->UserName</a></small>
			</div>
		</div>
EOT;
			$class = "carousel-item";
		}
		?>
	</div>
	<a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
		<span class="carousel-control-next-icon"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<div class="container mt-5">
	<div class="row mb-5 pb-3 border-bottom">
		<h1 class="col-6">Latest Reviews: </h1>
		<select class="col-6" id="slug_select">
			<option value="">All</option>
			<?php
			foreach($slugs as $slug)
			{
				echo "<option id='".$slug->slug."' value='".$slug->slug."'>".$slug->GameName."</option>";
			}
			?>
		</select>
	</div>
	<?php $i = 3; ?>
	<?php $reviews_size = sizeof($reviews); ?>
	<?php foreach($reviews as $review): ?>
		<?php if($i%3 == 0) echo '<div class="row">'; ?>
		<div class="col-4">
			<div class="card mb-4">
				<img class="card-img-top" src="<?php echo base_url('/application/images/'.$review->ReviewImage) ?>" />
				<div class="text-dark card-body text-center">
					<div class="card-title font-weight-bolder"><?php echo $review->GameName ?></div>
					<div class="card-text"><?php echo $review->GameReview ?></div>
					<a href="<?php echo site_url('review/'.$review->ID) ?>" class="mt-2 btn btn-primary">Check out this review</a>
				</div>
			</div>
		</div>
		<?php $i++; ?>
		<?php if($i%4 == 2 || $i == $reviews_size+3) echo '</div>'; //these numbers are not made up ?>
	<?php endforeach; ?>
	<nav aria-label="Pagination" class="row justify-content-center"><?php if(isset($pagination)) echo $pagination; ?></nav>

</div>
