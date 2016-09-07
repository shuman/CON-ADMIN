<div class="sec_row">
	<div class="sec_title">
		<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
		<p><?php echo $navigation['Navigation']['name'];?> goes here</p>
	</div>
	<div class="sec_desc">
		<div class="maps_content">
			<div class="map_lists">
				<div id="editArea">
					
				</div>
				<div class="surveyLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
				<ul id="mapListDrag">
					<?php if (!empty($modules)): ?>
					<?php foreach($modules as $eachModule): ?>
						<li id="Module_<?php echo $eachModule['Module']['id'];?>">
							<div class="list_row">
							<span class="map_title emap" datamid="<?php echo $eachModule['Module']['id'];?>"><?php echo $eachModule['Module']['name'] ? $eachModule['Module']['name']: 'N/A';?></span>
							<a class="delate_mgs" datamapid="<?php echo $eachModule['Module']['id'];?>" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						</div>
						</li>
					<?php endforeach;?>
				<?php endif;?>
				</ul>
			</div>
			<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="30" width="30"></div>
			<div class="createMapArea" id="createMapArea">
				
			</div>

			<!-- add form -->
			<div class="sec_row" id="addArea">
				<div class="alert alert-success" style="display: none;" role="alert"> <strong>Well done!</strong> Data Saved Successfully. </div>
					<div class="edit_content_box">
						<form action="javascript:;" id="moduleForm">
						<div class="sec_desc">
							<div class="input_block">
								<label>Name</label>
								<input type="text" name="name" id="modName">
								<input type="hidden" name="custom_module_id" value="<?php echo $navigation['Navigation']['custom_module_id'];?>">
							</div><!-- /text_box -->
							<div class="input_block">
								<label>Content</label>
								<textarea class="tinymce_div" id="contentId" name="content"></textarea>
							</div><!-- /text_box -->

							<div class="button_sec btn_right">
								<button class="button btn_highlight" id="saveChanges">Save Changes</button>
							</div>
						</div>
					</form>
					</div>
				</div><!-- /sec_row -->

		</div><!-- /maps_content -->
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
cusModScript();
function cusModScript() {
		// Save new data
		$('#saveChanges').click(function(){
			var name = $('#modName').val();
			var url = "conference/saveNewCusModule"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#moduleForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		$('#modName').val('');
			           		$('#contentId').val('');
							$('#mapListDrag').append('<li id="Module_'+data+'"><div class="list_row"><span class="map_title emap" datamid='+data+'>'+name+'</span><a class="delate_mgs" datamapid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></li>');
							cusModScript();
			           }
			         });
		})
		// Text edit from navigation
		navNedit();
		// Edit Map\
		$('.emap').unbind().click(function(){
			$('.mapLoader').show();
			$('#addArea').hide();
			var moduleId = $(this).attr('datamid');
			$('#Module_'+moduleId+'').html('');
			$.post('conference/cusModuleEdit/'+$(this).attr('datamid'),
				function(html) {
					$('#Module_'+moduleId+'').append(html);
	         });
		})

		$('.sec_row').show();
		$("#loader").css("display","none");
		// Delete Map
		 $('.delate_mgs').click(function(){
		 	var parentDiv = $(this).parent();
			var contentJson = {'id': $(this).attr('datamapid')};
			$.ajax({
				    	type: "POST",
				    	url: 'conference/deleteCusModule',
			            data: {'contentJson': contentJson}, // serializes the form's elements.
			            beforeSend: function() {
							parentDiv.css('background-color', '#fb6c6c');
						},
				        success: function(data)
				           {
				           		parentDiv.slideUp(600,function() {
									parentDiv.remove();
								});
				           }
			       });
		 })

		 }

		 function afterAppend() {
		 	// Delete Map
		 $('.delate_mgs').click(function(){
		 	$('.delate_mgs').click(function(){
		 	var parentDiv = $(this).parent();
			var contentJson = {'id': $(this).attr('datamapid')};
			$.ajax({
				    	type: "POST",
				    	url: 'conference/deleteCusModule',
			            data: {'contentJson': contentJson}, // serializes the form's elements.
			            beforeSend: function() {
							parentDiv.css('background-color', '#fb6c6c');
						},
				        success: function(data)
				           {
				           		parentDiv.slideUp(600,function() {
									parentDiv.remove();
								});
				           }
			       });
		 })
		 })
		 }
</script>