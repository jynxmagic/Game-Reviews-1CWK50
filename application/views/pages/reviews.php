<div class="container mt-3">
	<h1>Latest Reviews: </h1>
<?php $i = 2; ?>
<?php foreach($reviews as $review): ?>
<?php if($i%2 == 0) echo '<div class="row">'; ?>
	<div class="col-6">
		<div class="card mb-4">
			<img class="card-img-top" src="<?php echo base_url('/application/images/'.$review->ReviewImage) ?>" />
			<div class="text-dark card-body text-center">
				<div class="card-title font-weight-bolder"><?php echo $review->GameName ?></div>
				<div class="card-text"><?php echo $review->GameReview ?></div>
				<a href="<?php echo site_url('review/'.$review->ID) ?>" class="mt-2 btn btn-primary">Check out this review</a>
			</div>
		</div>
	</div>
<?php if($i%2 == 1) echo '</div>';  ?>
<?php $i++; ?>
<?php endforeach; ?>
	</div> <!-- closing row div outside foreach -->
	<div class="row justify-content-center"><?php if(isset($pagination)) echo $pagination; ?></div>
</div>
