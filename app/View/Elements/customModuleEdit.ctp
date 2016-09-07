<?php echo $this->Html->css(array('fontawesome-iconpicker'));?>
<!-- stylesheet End-->
<?php echo $this->Html->script(array('fontawesome-iconpicker.min'));?>
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
							<input class="form-control icp icp-auto" id="selectForm" value="<?php echo $customModule['CustomModule']['icon'];?>" name="icon" value="fa-anchor" type="text" />
						</div>
					</div>

					<div class="input_block">
						<label for="module_name">Name of Module</label>
						<input type="text" id="module_name" value="<?php echo $customModule['CustomModule']['name'];?>" name="name">
						<input type="hidden" id="module_id" value="<?php echo $customModule['CustomModule']['custom_module_id'];?>" name="custom_module_id">
					</div>

					<div class="input_block">
						<label>Action</label>
						<div class="input_row">
							<ul class="slc_module">
								<li class="col_3 <?php echo $customModule['CustomModule']['type'] == 1 ? 'active' :'';?>">
									<div class="slc_module_type">
										<a href="javascript:void(0)" id="sl_submenu" class="mlChoice" >Submenu</a>
									</div>
								</li>
								<li class="col_3 <?php echo $customModule['CustomModule']['type'] == 2 ? 'active' :'';?>">
									<div class="slc_module_type">
										<a href="javascript:void(0)" id="sl_link" class="mlChoice" >Link</a>
									</div>
								</li> 
								<li class="col_3 <?php echo $customModule['CustomModule']['type'] == 3 ? 'active' :'';?>">
									<div class="slc_module_type">
										<a href="javascript:void(0)" id="sl_video" class="mlChoice" >Video</a>
									</div>
								</li>
								<li class="col_3 <?php echo $customModule['CustomModule']['type'] == 4 ? 'active' :'';?>">
									<div class="slc_module_type">
										<a href="javascript:void(0)" id="sl_content" class="mlChoice" >Content</a>
									</div>
								</li> 
							</ul>
						</div>
					</div><!-- /input_block -->

					<div class="input_block subMenu">
						<label for="module_menu_item">Number of Submenu Items</label>
						<input type="text" id="module_menu_item" value="<?php echo $customModule['CustomModule']['sub_module']?>" name="module_menu_item">
					</div>

					<div class="input_block urlLink" style="display: none;">
						<label for="module_url_link">URL Link</label>
						<input type="text" id="module_url_link" value="<?php echo $customModule['CustomModule']['link_url']?>" name="link_url">
					</div>

					<div class="input_block videoUp" style="display: none;">
						<label for="upl_mdl_video">Paste Video Url</label>
						<input type="text" id="module_url_link" value="<?php echo $customModule['CustomModule']['video_url']?>" name="video_url">
					</div>

					<div class="input_block contentType" style="display: none;">
						<label for="module_url_content">Content</label>
						<textarea id="module_url_content" value="<?php echo $customModule['CustomModule']['content_desc']?>" name="content_desc"></textarea>
					</div>
				</form>
				<div class="edit_footer">
					<div class="input_block">
						<div class="pull-right">
							<button class="button createCusModBtn" type="submit">Update Module</button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /edit_content_box -->
	</div>
<script type="text/javascript">
	$('.icp-auto').iconpicker();
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
</script>