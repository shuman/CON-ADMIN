<div class="sec_row" id="editArea">
	<div class="edit_content_box">
	<!-- <div class="edit_head">
		<a class="cancel cancelModule" datamid="<?php echo $module['Module']['id'];?>" href="javascript:;">- Cancel</a>
	</div> -->
		<form action="javascript:;" id="moduleForm">
		<div class="sec_desc">
			<div class="input_block">
				<label>Name</label>
				<input type="text" name="name" id="modName" value="<?php echo $module['Module']['name'];?>">
				<input type="hidden" name="custom_module_id" id="custom_module_id" value="<?php echo $module['Module']['custom_module_id'];?>">
				<input type="hidden" name="id" id="modId" value="<?php echo $module['Module']['id'];?>">
			</div><!-- /text_box -->
			<div class="input_block">
				<label>Content</label>
				<textarea class="tinymce_div" id="contentId" name="content" ><?php echo $module['Module']['content'];?></textarea>
			</div><!-- /text_box -->

			<div class="button_sec btn_right">
				<button class="button btn_highlight" id="updateChanges">Save Changes</button>
			</div>
		</div>
	</form>
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	$('.cancelModule').unbind().click(function(){
		var modId = $(this).attr('datamid');
		var name = $('#modName').val();
		$('#Module_'+modId+'').html('');
		$('#Module_'+modId+'').append('<li id="Module_'+modId+'"><div class="list_row"><span class="map_title emap" modIdmid='+modId+'>'+name+'</span><a class="delate_mgs" modIdmapid='+modId+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></li>');
		cusModScript();
	})
	$('#updateChanges').click(function(){
		var id = $('#modId').val();
		var name = $('#modName').val();
		var custom_module_id = $('#custom_module_id').val();
		var content = $('#contentId').val();
		var contents = {'id': id, 'name': name, 'custom_module_id': custom_module_id, 'content': content};
			var name = $('#modName').val();
			var url = "conference/updateNewCusModule"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: contents, // serializes the form's elements.
			           success: function(data)
			           {	
			           		$('#Module_'+data+'').html('');
							$('#Module_'+data+'').append('<li id="Module_'+data+'"><div class="list_row"><span class="map_title emap" datamid='+data+'>'+name+'</span><a class="delate_mgs" datamapid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></li>');
							cusModScript();
			           }
			         });
		})
</script>