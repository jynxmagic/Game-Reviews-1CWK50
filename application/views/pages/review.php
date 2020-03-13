<section class="container text-center">

	<h1>Reivew of - <?php echo $review->GameName ?></h1>
	<h2>Review by <a href="<?php echo base_url('/account/') ?>">Account name placeholder</a></h2>

	<?php echo img('application/images/'.$review->ReviewImage); ?>

	<article class="mt-5">
		<?php echo $review->GameBlurb ?>
	</article>
	<article class="mt-5">
		<?php echo $review->GameReview ?>
	</article>


	<?php if($review->GameComments_YN == "Y"): ?>
	<div id="app" class="mt-5 border-top border-light pt-3">

		<!-- post new comment -->
		<input type="textarea" id="commentInput" />
		<button v-on:click="postNewComment()" class="btn-lg btn-success">Submit</button>
		 <!-- Check if there are more than 0 comments, if so display them. If not, display a message explaining there are no comments. -->
		<div v-if="Comments.length == 0">
			<p>No Comments have been added to this review yet.</p>
		</div>
		<div v-else>
			<div v-for="comment in Comments">
				<div class="row justify-content-center bg-light border-dark text-dark mt-3">
					ID: {{comment.UserID}}<br>
					{{comment.UserComment}}<br>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" value="<?php echo $review->ID?>" id="review_id" /> <!-- this value is used in vue_review.js -->

	<?php endif; ?>

</section>
