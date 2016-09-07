<div class="sec_row">
	<div class="sec_title">
		<h2>New Module <a href="javascript:void(0)"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>
		<p>Select the module type.</p>
	</div>
	<div class="sec_desc">
		<div class="input_block">
			<div class="button_sec">
				<button class="button selectMtype">Select Module Type</button>
			</div>
		</div>
		<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
		<div class="module_content">
			
		</div><!-- /module_content -->
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	function moduleScript() {
		// scroll top
		$("html, body").animate({ scrollTop: "1px" });

		// Hide loader
		$('.sec_row').show();
		$("#loader").css("display","none");

		// Select module type
		$('.selectMtype').click(function(){
			$('.selectMtype').hide();
			$('.agLoader').show();
			$.post('conference/selectMuduleType', {'data': 'attr'}, 
			function(html) {
				$('.agLoader').hide();
	             $('.module_content').prepend(html);
	         }); 
		})
	}
</script>