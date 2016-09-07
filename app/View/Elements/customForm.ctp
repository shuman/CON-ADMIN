
<div class="edit_content_box">
			<div class="edit_head">
				<a class="cancel cancelCusMod" href="javascript:;">- Cancel</a>
			</div>
			<form action="javascript:;" id="createCusModForm">
				<div class="edit_content">
					<div class="input_block">
						<div class="add_pic_sec">
							<label for="module_name">Select Icon</label>
							<input class="form-control icp icp-auto" id="selectForm" name="icon" value="fa-anchor" type="text" />
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
								<li class="col_3">
									<div class="slc_module_type">
										<a href="javascript:void(0)" id="sl_content" class="mlChoice" >Content</a>
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
						<label for="upl_mdl_video">Paste Video Url</label>
						<input type="text" id="module_url_link" name="video_url">
					</div>

					<div class="input_block contentType" style="display: none;">
						<label for="module_url_content">Content</label>
						<textarea id="module_url_content" name="content_desc"></textarea>
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
$('.sec_row').show();
$("#loader").css("display","none");

$('.icp-auto').iconpicker()	
// content editor
	tinymce.init({
	        selector: '#module_url_content',  // change this value according to your HTML
	        menubar: false,
	        theme: 'modern',
	        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
	        setup : function(ed) {
		        	ed.on('change', function () {
			            ed.save();
			        });
            }
	    });
		// Multiple choice
		$('.mlChoice').click(function(){
			var mlParent = $(this).parent().parent();
			if (mlParent.hasClass('active')) {
				var isHasClass = 'active';
			} else {
				if ($(this).attr('id') == 'sl_submenu') {
					$('.contentType').hide();
					$('.subMenu').show();
					$('.urlLink').hide();
					$('.videoUp').hide();
				} else if ($(this).attr('id') == 'sl_link') {
					$('.contentType').hide();
					$('.subMenu').hide();
					$('.urlLink').show();
					$('.videoUp').hide();
				} else if ($(this).attr('id') == 'sl_video') {
					$('.contentType').hide();
					$('.subMenu').hide();
					$('.urlLink').hide();
					$('.videoUp').show();
				} else if ($(this).attr('id') == 'sl_content') {
					$('.subMenu').hide();
					$('.urlLink').hide();
					$('.videoUp').hide();
					$('.contentType').show();
				}
				var isHasClass = '';
			}
			mlParent.parent().find('.active').removeClass('active');
			if (isHasClass == 'active') {
				mlParent.removeClass('active');
			} else {
				mlParent.addClass('active');
			}
		})

		// Save Module
		$('.createCusModBtn').click(function(){
			var url = "conference/saveNewModule";
			var name = $('#module_name').val();
			$.ajax({
				type: "POST",
				url: url,
			           data: $('#createCusModForm').serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           	$('#createdCustom').append('<div class="module-list"><div class="box_acd_title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".box_accordian" href="javascript:;'+data+'"><span class="agenda_date">'+name+'</span><span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span></a></div><!-- /box_acd_title --><div id='+data+' class="panel-collapse collapse" style="height: 0px;"><div class="box_acd_content"><div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div><div class="button_sec"><a href="javascript:;" dataid='+data+' class="addSession">+  Add Sub-module</a></div></div><!-- /box_acd_content --></div></div>');
			           }
			       });
		})

		// Cancel Custom module
		$('.cancelCusMod').click(function(){
			$('#createCusModBox').html('');
			$('.addModBtn').show();
		})

		// Add create form
		$('#addModButton').unbind().click(function(){
			$('.addModBtn').hide();
			$(".agLoader").show();
			$.post('conference/createCustomMudule', {'data': 'attr'}, 
				function(html) {
					$(".agLoader").hide();
					$('#createCusModBox').append(html);
					$("html, body").animate({ scrollTop: $('.edit_content_box').offset().top }, 100);
				}); 
		})
	</script>