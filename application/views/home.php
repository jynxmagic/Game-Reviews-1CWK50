<div class="">
	<div class="">
		<div id="carouselHome" class="carousel">
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

					$url = base_url('img/'.$row->ReviewImage);

					echo <<<EOT
				<div class="$class img-fluid">
					<div class="position-relative img-fade">
						<img src="$url" alt="row->imgName" height="500px" width="100%">
					</div>
					<div class="carousel-caption d-none d-md-block">
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
	</div>
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

<!-- This section needs editing to create the chat system using HTML -->
<button id="chatButton" class="open-button btn btn-success" onclick="openForm()">Chat</button>
<div class="chat-popup pull-right" id="myForm">
<form id="myform" class="form-container">
</form>
