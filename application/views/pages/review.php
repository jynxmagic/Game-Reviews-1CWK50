<section class="container text-center">

	<h1>Reivew of - <?php echo $review->GameName ?></h1>
	<h2>Review by <a href="<?php echo site_url('/account/').$review->UserName ?>"><?php echo $review->UserName ?></a></h2>

	<?php echo img('application/images/'.$review->ReviewImage); ?>

	<article class="mt-5">
		<?php echo $review->GameBlurb ?>
	</article>
	<article class="mt-5">
		<?php echo $review->GameReview ?>
	</article>


	<?php if($review->GameComments_YN == "Y"): ?>
	<section id="app" class="mt-5 border-top border-light pt-3 mb-5 pb-5">
		<h3 class="">Comments</h3>
		<!-- post new comment -->
		<div class="input-group row mt-3 align-items-center mb-3">
			<label for="commentInput" class="form-check-label col-2">Add new comment</label>
			<input type="text" class="input-group-text col-10"  id="commentInput" />
		</div>

		<div class="row mb-3">
			<div class="col-6"><button v-on:click="getComments()" class="btn-lg btn-success">Reload Comments</button></div>
			<div class="col-6"><button v-on:click="postNewComment()" class="btn-lg btn-success pl-4 pr-4">Submit</button></div>
		</div>

		 <!-- Check if there are more than 0 comments, if so display them. If not, display a message explaining there are no comments. -->
		<div v-if="Comments.length == 0">
			<p>No Comments have been added to this review yet.</p>
		</div>
		<div v-else>
			<div v-for="comment in Comments">
				<div class="row bg-light border-dark text-dark mt-3 comment align-items-center">
					<div class="col-3">Comment by: <a href="#">{{comment.UserName}}</a></div>
					<div class="col-9">{{comment.UserComment}}<br></div>
				</div>
			</div>
		</div>
	</section>

	<input type="hidden" value="<?php echo $review->ID?>" id="review_id" /> <!-- this value is used in vue_review.js -->

	<?php endif; ?>

</section>
