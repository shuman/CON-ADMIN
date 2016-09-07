<?php echo $this->Html->css(array('fontawesome-iconpicker'));?>
	<!-- stylesheet End-->
	<?php echo $this->Html->script(array('fontawesome-iconpicker.min'));?>
<div class="sec_title">
	<h2>Custom Module <a href="javascript:void(0)"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>
	<p>Label the module and fill out necessary information.</p>
</div>
<div class="box_accordian">
	<?php if (!empty($customModule)): ?>
		<?php foreach($customModule as $eachModule): ?>
			<div class="modLoader" id="loader_<?php echo $eachModule['CustomModule']['custom_module_id'];?>" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
			<div id="main_<?php echo $eachModule['CustomModule']['custom_module_id'];?>">
				<div class="module-list" id="cus_<?php echo $eachModule['CustomModule']['custom_module_id'];?>">
				<div class="box_acd_title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent=".box_accordian" href="#<?php echo $eachModule['CustomModule']['custom_module_id'];?>">
						<span class="agenda_date"><?php echo $eachModule['CustomModule']['name'] ? $eachModule['CustomModule']['name'] : '';?></span>
						<span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span>
						<a class="delate_mgs editCustomMod" datacmid="<?php echo $eachModule['CustomModule']['custom_module_id'];?>" href="javascript:;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					</a>
				</div><!-- /box_acd_title -->
				<div id="<?php echo $eachModule['CustomModule']['custom_module_id'];?>" class="panel-collapse collapse">
					<div class="box_acd_content">
						<?php foreach($customModule as $eachCmodule): ?>
							<?php if ($eachCmodule['CustomModule']['parent_id'] == $eachModule['CustomModule']['custom_module_id']): ?>
								<div class="list_row">
									<span class="wdt_30">Session 1</span>
									<span class="wdt_40"><i class="fa fa-map-marker" aria-hidden="true"></i> Dhaka</span>
									<span class="wdt_30">11:12:00	</span>
									<a class="delate_mgs" datasid="12" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div>
							<?php endif;?>
						<?php endforeach;?>

						<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
						<div class="button_sec">
							<a href="javascript:;" dataid="1" class="addSession">+  Add Sub-module</a>
						</div>

					</div><!-- /box_acd_content -->
				</div>
			</div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
	<div id="createdCustom">
		
	</div>
	<div class="button_sec pad_tb20 addModBtn" style="display: none;">
		<a href="javascript:;" id="addModButton">+  Add Module</a>
	</div>
<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
	<!-- Add module form -->
	<div id="createCusModBox">
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
						<input type="text" id="module_url_link" name="link_url">
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
	</div>
</div>
<script type="text/javascript">
// Edit custom module
$('.editCustomMod').unbind().click(function(){
	$('#createCusModBox').html('');
	var cusModId = $(this).attr('datacmid');
	$('.createCusModBtn').hide();
	$('#cus_'+cusModId+'').hide();
	$('#loader_'+cusModId+'').show();
	$.post('conference/customModuleEdit/'+cusModId,
		function(html) {
			$('#loader_'+cusModId+'').hide();
			$('#main_'+cusModId+'').append(html);
			aedit();
     });
})

// After edit fun
function aedit() {
	// Cancel Custom module
		$('.cancelCusMod').unbind().click(function(){
			$('.addModBtn').show();
			$('.createCusModBtn').show();
			$('#createCusModBox').remove();
			$('.module-list').show();
		})
	// Update Module
		$('.createCusModBtn').unbind().click(function(){
			var url = "conference/updateCusModule";
			var name = $('#module_name').val();
			$.ajax({
				type: "POST",
				url: url,
			           data: $('#createCusModForm').serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           	$('#createCusModBox').remove();
			           	$('#cus_'+data+'').remove();
			           	$('#main_'+data+'').append('<div id="cus_'+data+'" class="module-list"><div class="box_acd_title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".box_accordian" href="javascript:;'+data+'"><span class="agenda_date">'+name+'</span><span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span><a class="delate_mgs editCustomMod" datacmid='+data+' href="javascript:;"><i class="fa fa-pencil" aria-hidden="true"></i></a></a></div><!-- /box_acd_title --><div id='+data+' class="panel-collapse collapse" style="height: 0px;"><div class="box_acd_content"><div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div><div class="button_sec"><a href="javascript:;" dataid='+data+' class="addSession">+  Add Sub-module</a></div></div><!-- /box_acd_content --></div></div>');
			           	afterEdit();
			           }
			       });
		})
} 

function afterEdit() {
	// Edit custom module
$('.editCustomMod').unbind().click(function(){
	var cusModId = $(this).attr('datacmid');
	$('#cus_'+cusModId+'').hide();
	$('#loader_'+cusModId+'').show();
	$.post('conference/customModuleEdit/'+cusModId,
		function(html) {
			$('#loader_'+cusModId+'').hide();
			$('#main_'+cusModId+'').append(html);
			aedit();
     });
})
}

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
		$('.createCusModBtn').unbind().click(function(){
			var url = "conference/saveNewModule";
			var name = $('#module_name').val();
			$.ajax({
				type: "POST",
				url: url,
			           data: $('#createCusModForm').serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           	$('#createdCustom').append('<div class="module-list"><div class="box_acd_title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".box_accordian" href="javascript:;'+data.modId+'"><span class="agenda_date">'+name+'</span><span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span></a></div><!-- /box_acd_title --><div id='+data.modId+' class="panel-collapse collapse" style="height: 0px;"><div class="box_acd_content"><div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div><div class="button_sec"><a href="javascript:;" dataid='+data.modId+' class="addSession">+  Add Sub-module</a></div></div><!-- /box_acd_content --></div></div>');

			           	$('.more_mod_drag').append('<li id="Navigation_'+data.nav+'" class="ui-sortable-handle"><div class="opt_list"><a href="javascript:;" datacmid='+data.modId+' datanid='+data.nav+' class="cusNav" ><span class="sl_no">6</span> <span id="name_'+data.nav+'">'+name+'</span></a>								<div class="opt_icon"><a href="javascript:;"><i class="fa fa-power-off powerOff" datankey="6" datanid='+data.nav+' datanname="Sponsors" aria-hidden="true"></i></a><a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_'+data.nav+'" datanid='+data.nav+' datanname="Sponsors" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a><a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_'+data.nav+'" datanid='+data.nav+' aria-hidden="true"></i></a></div></div></li>');
			           	cusnavupdate();
			           }
			       });
		})

		// Cancel Custom module
		$('.cancelCusMod').unbind().click(function(){
			$('#createCusModBox').html('');
			$('.addModBtn').show();
		})

		// Add create form
		$('#addModButton').unbind().click(function(){
			$('.addModBtn').hide();
			$(".agLoader").show();
			$.post('conference/customForm', {'data': 'attr'}, 
				function(html) {
					$(".agLoader").hide();
					$('#createCusModBox').append(html);
					$("html, body").animate({ scrollTop: $('.edit_content_box').offset().top }, 100);
				}); 
		})
	</script>