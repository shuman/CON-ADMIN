<div class="edit_content_box">
	<div class="edit_head">
		<!-- <a class="cancel cancelCusMod" href="javascript:;">- Cancel</a> -->
	</div>
	<form action="javascript:;" id="createCusModForm">
		<div class="edit_content">
			<div class="input_block">
				<div class="add_pic_sec">
					<div class="add_pic">
						<div class="btn_file">
							<label for="Add Image"><span>Select Icon</span></label>
							<input type="file" value="Add Image" id="Add Image" name="Add Image" class="inputfile">
						</div>
					</div>
				</div>
			</div>

			<div class="input_block">
				<label for="module_name">Name of Module</label>
				<input type="text" id="module_name" name="name">
			</div>

			<div class="input_block">
				<label>Action</label>
				<div class="input_row">
					<ul class="slc_module">
						<li class="col_3 active">
							<div class="slc_module_type">
								<a href="javascript:void(0)" id="sl_submenu" class="mlChoice" >Submenu</a>
							</div>
						</li>
						<li class="col_3">
							<div class="slc_module_type">
								<a href="javascript:void(0)" id="sl_link" class="mlChoice" >Link</a>
							</div>
						</li> 
						<li class="col_3">
							<div class="slc_module_type">
								<a href="javascript:void(0)" id="sl_video" class="mlChoice" >Video</a>
							</div>
						</li>
					</ul>
				</div>
			</div><!-- /input_block -->

			<div class="input_block subMenu">
				<label for="module_menu_item">Number of Submenu Items</label>
				<input type="text" id="module_menu_item" name="module_menu_item">
			</div>

			<div class="input_block urlLink" style="display: none;">
				<label for="module_url_link">URL Link</label>
				<input type="text" id="module_url_link" name="url_link">
			</div>

			<div class="input_block videoUp" style="display: none;">
				<label for="upl_mdl_video">Video</label>
				<div class="input_block">
					<div class="btn_file full_wdt">
						<label class="button full_wdt" for="upl_mdl_video"><span>Upload Video</span></label>
						<input class="inputfile full_wdt" type="file" name="video_url" id="upl_mdl_video" value="Module Video">
					</div>
				</div>
			</div>
		</form>
		<div class="edit_footer">
			<div class="input_block">
				<div class="pull-right">
					<button class="button createCusModBtn" type="submit">Create Module</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- /edit_content_box -->
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
	// Cancel Custom module
		$('.cancelCusMod').click(function(){
			$('#createCusModBox').html('');
			$('.addModBtn').show();
		})
</script>