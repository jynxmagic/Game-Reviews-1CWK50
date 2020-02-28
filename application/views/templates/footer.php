<div id="chat" class="position-fixed fixed-bottom col-3 bg-light text-dark rounded border">
	<div v-if="code == 200">
		<!-- chat server is online! -->
		Chat online

		<div id="chatbox" class="row">

		</div>

		<input id="message" type="text" class="row"/>
		<button v-on:click="sendMessage()" class="btn row bg-white btn-hover" id="chatsubmit">Send Message</button>
	</div>
	<div v-else>
		Chat offline: {{reason}}
	</div>
</div>

<footer class="footer mt-5 pt-2 rounded-top page-footer py-3" style="background-color: black">
	<div class="container-fluid">
		<div class="row pb-3">
			<div class="col-4">
				<address class="text-white">
					<p class="text-bold text-capitalize"><b>Address:</b></p>
					<p class="small">
						MMU,<br>
						Near oxford road,<br>
						Just passed the bridge</p>
				</address>
			</div>
			<div class="col-4">
				<p class="text-bold text-white"><b>Email:</b> <a href="mailto://17105584@stu.mmu.ac.uk">17105584@stu.mmu.ac.uk</a></p>
			</div>
			<div class="col-4">
				<div class="text-white">Some badges to show the site is certified: </div>
				<div class="row mt-4 ml-1">
					<!-- <img class='border-light border' alt="W3 Verification Badge" height="61" src="#" />
					<img class="ml-4" alt="Google Lighthouse Logo" width="auto" height="61" src="/img/footer_badges/lighthouse-logo.svg" />
					<img class="border-light border mt-3 ml-2" alt="Google Lighthouse Report" width="303" height="122" src="/img/footer_badges/lighthouse_report.PNG"/> -->
				</div>
			</div>
		</div>
		<div class="blockquote-footer text-center text-info border-top border-white pt-1">Created with ❤ by: <span class="text-white">Chris Carr</span></div>
	</div>
</footer>




<!-- base url from CodeIgniter required for vue scripts -->
<input type="hidden" value="<?php echo base_url() ?>" id="base_url_input" />



<script src="<?php echo base_url('application/scripts/jquery.min.js') ?>" defer></script>
<script src="<?php echo base_url('application/scripts/bootstrap.min.js') ?>" defer></script>
<script src="<?php echo base_url('application/scripts/vue/vue.js') ?>" defer></script>
<script src="<?php echo base_url('application/scripts/vue/chat.js')?>" defer></script>
<script src="<?php echo base_url('application/scripts/popper.min.js') ?>" defer></script>
<script src="<?php echo base_url('application/scripts/node/client/socket.io.js') ?>" defer></script>

<!-- additional scripts for this page -->
<?php if(isset($additional_scripts))
{
	foreach ($additional_scripts as $script)
	{
		echo "<script src='$script' defer></script>";
	}
}?>
</body>
</html>
