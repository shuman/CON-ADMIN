<div class="spk_edit_content">
	<div class="edit_content_box">
		<div class="edit_head">
			<a class="cancel cancelCreateSpeaker" href="javascript:;">- Cancel</a>
		</div>
			<div class="edit_content">
				<div class="add_pic_sec"  style="background-image: url('files/image/speaker/<?php echo $speakerBg['Conference']['speaker_bkimg'] ? $speakerBg['Conference']['speaker_bkimg'] : '';?>');">
					<div class="add_pic" style="background-image: url('files/image/speaker/<?php echo $speaker['Speaker']['speaker_image'] ? $speaker['Speaker']['speaker_image'] : '';?>');">
						<div class="btn_file">
							<label for="Add Image"><a href="javascript:;" id="addSpeakerImgButton">Change Image</a></label>
							<form action="convene/updateSpeakerImage" method="post" id="updateForm"
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
				<div class="input_block">
					<div class="input_row">
						<div class="col_6">
							<label for="slc_speaker">Speaker Name</label>
							<input type="text" name="name" id="twha" value="<?php echo $speaker['Speaker']['name'];?>" >
							<input type="hidden" name="speaker_id" id="twasa" value="<?php echo $speaker['Speaker']['speaker_id'];?>" >
							<input type="hidden" name="speaker_image" id="taasa" value="<?php echo $speaker['Speaker']['speaker_image'];?>" >
						</div>
						<div class="col_6">
							<label for="twh">Twitter Handle</label>
							<input type="text" name="twitter_handle" id="twh" value="<?php echo $speaker['Speaker']['twitter_handle'];?>">
						</div>
					</div>
				</div><!-- /input_block -->

				<div class="input_block">
					<label for="brief_bt">Brief Biography (Appears under name in manu)</label>
					<input type="text" class="sp_brif_bio" name="brief_biography" id="brief_bt" value="<?php echo $speaker['Speaker']['brief_biography'];?>">
					<span class="inp_counter sp_brif_bio_counter_counter"><?php echo 80 - strlen($speaker['Speaker']['brief_biography']);?></span>
				</div> 

				<div class="input_block">
					<label for="twh">Biography</label>
					<textarea class="tinymce" name="biography" ></textarea>
				</div>
				<div class="edit_footer">
					<button class="button createSpeaker" type="submit">Update Speaker</button>
				</div>
			</form>	
		</div>
	</div>
</div><!-- /spk_edit_content -->
</div>
<script type="text/javascript">
	// Character count
	// breif description limit
			$('.sp_brif_bio').bind('keyup', function(event) {
				var confValue = $(this).val();
				var remainingChar = 80-confValue.length;
				$('.sp_brif_bio').attr('maxlength', 80);
				$('.sp_brif_bio_counter_counter').html(remainingChar);
			})
	// edit speaker
	var description = "<?php echo $speaker['Speaker']['biography'];?>";
	$('.tinymce').val(description);
	// Cancel speaker
	$('.cancelCreateSpeaker').click(function(){
			$(this).parent().parent().remove();
			$('.spk_list_item').show();
			$('.addSpeaker').show();
		})
	// Submit Form Information
		$('.createSpeaker').click(function(){
			$("#createSpeakerForm").submit(function(e) {
				var speakerId = $('#twasa').val();
			    var url = "convene/saveSpeaker"; // the script where you handle the form input.
			    var name = $('#twha').val();
			    var image = $('#taasa').val();
			    var twitter = $('#twh').val();
			    var brief_biography = $('#brief_bt').val();
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#createSpeakerForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		$(".spk_edit_content").fadeOut(400, function() { $(this).remove(); });
			           		$(window).scrollTop($('#header').offset().top);
			           		$('#Speaker_'+speakerId+'').html('');
			           		$('#Speaker_'+speakerId+'').append('<li id="Speaker_'+speakerId+'" class="ui-sortable-handle"><div class="spk_list_item dot_bg"><div class="spk_item espeaker" datasid='+speakerId+'><div class="spk_pic"><img src="/files/image/speaker/'+image+'" alt="">	</div><div class="spk_desc"><h3>'+name+'</h3><p>'+twitter+' <br> '+brief_biography+'</p></div></div><a class="delate_mgs" dataspid='+speakerId+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><!-- /spk_list_item --></li>');
			           		$('.addSpeaker').show();
			           		// $('.spk_list_item').show();
							$('.spk_bg_image').show();
							speakerScript();
			           }
			         });

			    e.preventDefault(); // avoid to execute the actual submit of the form.
			});
		})


	$('#addSpeakerImgButton').click(function(){
		$('#file').click();
	})
	$('#file').change(function() {
	    $('#updateForm').submit();
	});
	// Image upload function
			// function from the jquery form plugin
			 $('#updateForm').ajaxForm({
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
			 			$(".add_pic").css('background-image', 'url("files/image/speaker/' + response.responseText + '")');
			 			// $(".add_pic_sec").html("<img src='files/image/speaker/"+response.responseText+"' width='100%'/>");
			 			$(".alert-message").html("<strong>Success!</strong> Image uploaded to the server");
			 			$('#taasa').val(response.responseText);
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