
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

			$url = base_url('application/images/'.$row->ReviewImage);

			echo <<<EOT
		<div class="$class img-fluid">
			<img src="$url" alt="$row->GameName" height="500px" width="100%">
			<div class="carousel-caption d-none d-md-block bg-dark border-top border-left border-right pb-5 rounded-top" style="bottom: 0;">
				<h5>$row->GameName</h5>
				<p>$row->GameReview</p>
				<small>row->author</small>
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


<script defer>

	//ES5 onload https://developer.mozilla.org/en-US/docs/Web/API/GlobalEventHandlers/onload

	options = {
	    interval : 2000,
		ride: "cycle"
	};
	const loadCarousel = () => {
	    $('.carousel').carousel(options);
	};
	window.onload = loadCarousel;

</script>

<div class="container-fluid mt-4">
	<div class="row">
		<section class="col-12 text-white text-center">
			<h1 class="display-1">Game Reviews</h1>
			<p class="pt-2">What else is there to say?</p>
			<p class="pt-2">OH YEAH!</p>
			<h2 class="pt-2 display-2">GAME REVIEWS!</h2>
			<small class="small pt-6">here's a footer: </small>
		</section>
	</div>
</div>

<!-- TODO This section needs editing to create the chat system using HTML
<button id="chatButton" class="open-button btn btn-success" onclick="openForm()">Chat</button>
<div class="chat-popup pull-right" id="myForm">
<form id="myform" class="form-container">
</form> -->
