<div class="spk_edit_content">
	<div class="edit_content_box">
		<div class="edit_head">
			<a class="cancel cancelCreateSpeaker" href="javascript:;">- Cancel</a>
		</div>
			<div class="edit_content">
				<div class="add_pic_sec" style="background-image: url('files/image/speaker/<?php echo $speakerBg['Conference']['speaker_bkimg'] ? $speakerBg['Conference']['speaker_bkimg'] : '';?>');">
					<div class="add_pic">
						<div class="btn_file">
							<label for="Add Image"><a href="javascript:;" id="addSpeakerImgButton">Add Image</a></label>
							<form action="convene/speakerImageUpload" method="post" id="myForm"
								enctype="multipart/form-data">
								<input type="file" name="file" id="file" style="display: none;"><br>
							</form>
							<div class="progress progress-striped active">
							  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
							  aria-valuemax="100" style="width: 0%">
							    <span class="sr-only">0% Complete</span>
							  </div>
							</div>
							<div class="image"></div>
						</div>
					</div>
				</div>
		<form id="createSpeakerForm">
		<!-- Image input -->
		<input type="hidden" name="speaker_image" id="spim">
				<div class="input_block">
					<div class="input_row">
						<div class="col_6">
							<label for="slc_speaker">Speaker Name</label>
							<input type="text" name="name" id="twha">
							<p style="color: red; display: none;" class="nameReq">*Required</p>
						</div>
						<div class="col_6">
							<label for="twh">Twitter Handle</label>
							<input type="text" name="twitter_handle" id="twh">
						</div>
					</div>
				</div><!-- /input_block -->

				<div class="input_block">
					<label for="brief_bt">Brief Biography (Appears under name in manu)</label>
					<input type="text" class="sp_brif_bio" name="brief_biography" id="brief_bt">
					<span class="inp_counter sp_brif_bio_counter_counter">80</span>
				</div> 

				<div class="input_block">
					<label for="twh">Biography</label>
					<textarea class="tinymce" name="biography"></textarea>
				</div>
				<!-- <div class="edit_footer">
					<div class="input_block">
						<div class="pull-right">
							<button class="button btn_delete" type="submit">Delete</button>
						</div>
						<div class="pull-left">
							<button class="button" type="submit">Save Change</button>
						</div>
					</div>
				</div> -->
				<div class="edit_footer">
					<button class="button createSpeaker" type="submit">Create Speaker</button>
				</div>
			</form>	
		</div>
	</div>
</div><!-- /spk_edit_content -->
</div>
<script type="text/javascript">
	$('#addSpeakerImgButton').click(function(){
		$('#file').click();
	})
	$('#file').change(function() {
	    $('#myForm').submit();
	});
	// Image upload function
			// function from the jquery form plugin
			 $('#myForm').ajaxForm({
			 	beforeSubmit:function(formData, jqForm, options){
			 		//check the source if its image before uploading
			 		$(".progress").show()
			 		var n = formData[0].value.name;
			 		var ext = n.substr(n.lastIndexOf('.') + 1);
			 		var et = ext.toUpperCase();
			 		var array = ['PNG','JPG','JPEG','GIF'];
			 		var there = $.inArray(et, array);
			 		if(there == -1)
			 		{
			 			//update the alert message and show it
			 			$(".alert-message").html("<b>Error!</b> Please upload a valid image file");
			 			$(".alert").show();

			 			//setting a time out function to auto hide the alert after 3sec
			 			setTimeout(function() { $(".alert").hide(); }, 3000);
			 			//hide the progress bar
			 			$(".progress").hide()
			 			return false;
			 		}	
			 		else{
			 			return true;
			 		}	
			 	},
			 	uploadProgress:function(event,position,total,percentComplete){
			 		$(".progress-bar").width(percentComplete+'%'); //dynamicaly change the progress bar width
			 		$(".sr-only").html(percentComplete+'%'); // show the percentage number
			 	},
			 	success:function(){
			 		$(".progress").hide(); //hide progress bar on success of upload
			 	},
			 	complete:function(response){
			 		//display error if response is 0
			 		if(response.responseText=='0'){
			 			//change the alert message and show it
			 			$(".alert-message").html("<b>Error</b> in uploading");
			 			$(".alert").show();
			 		} 
			 		else{
			 			//update the image container,then update alert message and show it
			 			// $(".add_pic").html("<img src='files/image/speaker/"+response.responseText+"' width='100%'/>");
			 			$(".add_pic").css('background-image', 'url("files/image/speaker/' + response.responseText + '")');
			 			$(".alert-message").html("<strong>Success!</strong> Image uploaded to the server");
			 			$('#spim').val(response.responseText);
			 			$(".alert").show();
			 		}
			 		//setting a time out function to auto hide the alert after 3sec
			 		setTimeout(function() { $(".alert").hide(); }, 3000);
			 			
			 	}
			 });
			 $(".alert").hide();
			 //set the progress bar to be hidden on loading
			 $(".progress").hide();
</script>