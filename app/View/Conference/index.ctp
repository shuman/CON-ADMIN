<div class="sec_row">
<div class="alert alert-success" role="alert"> <strong>Well done!</strong> Data Saved Successfully. </div>
	<div class="sec_title">
		<h2>Name of Conference</h2>
		<p>Enter the name of your conference. This will be displayed at the top of the app</p>
	</div>
	<form action="javascript:;" id="coferenceForm">
		<div class="sec_desc">
			<div class="input_block">
				<input type="hidden" name="back_color" id="cnf_back_color" >
				<input type="text" name="name" id="cnf_name" value="<?php echo $conference['Conference']['name'] ? $conference['Conference']['name'] : '';?>">
				<span class="inp_counter"><?php echo $conference['Conference']['name'] ? 40-strlen($conference['Conference']['name']) : 40;?></span>
			</div>
			<div id="imageInput">
				
			</div>
		</div>
	</form>
</div><!-- /sec_row -->

<div class="sec_row">
	<div class="sec_title">
		<h2>App Logo</h2>
		<p>Upload a image of your conference logo. Select background color loading screen.</p>
	</div>
	<div class="sec_desc">
		<div class="sec_w320">
			<div class="input_block">
			<?php if ($conference['Conference']['logo_image']): ?>
				<div class="btn_file">
					<form action="convene/appLogoUpload" method="post" id="appLogoForm"
						enctype="multipart/form-data" >
						<input type="file" name="file" id="file" style="display: none;"><br>

						<input type="submit" name="submit" class="btn btn-success" id="upl_logo" value="Upload Logo">
					</form>
					<br>
					<div class="progress progress-striped active">
					  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
					  aria-valuemax="100" style="width: 0%"> 
					    <span class="sr-only">0% Complete</span>
					  </div>
					</div>
					<div class="image"><?php echo $this->Html->image('/files/image/app/'.$conference['Conference']['logo_image']);?></div>
				</div>
			<?php else:?>
				<div class="btn_file">
					<form action="convene/appLogoUpload" method="post" id="appLogoForm"
						enctype="multipart/form-data" >
						<input type="file" name="file" id="file" style="display: none;"><br>

						<input type="submit" name="submit" class="btn btn-success" id="upl_logo" value="Upload Logo">
					</form>
					<br>
					<div class="progress progress-striped active">
					  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
					  aria-valuemax="100" style="width: 0%"> 
					    <span class="sr-only">0% Complete</span>
					  </div>
					</div>
					<div class="image"></div>
				</div>
			<?php endif;?>
			</div>
		</div>
	</div>

	<div class="sec_row">
	<div class="sec_title">
		<h2>Background Color Selection</h2>
	</div>
	<p id="colorpickerHolder"></p>
</div><!-- /sec_row -->
		<div class="button_sec btn_right">
			<button class="button btn_highlight" id="saveConfBtn" type="submit">Save Changes</button>
		</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	$('#colorpickerHolder').ColorPicker({
		color: '<?php echo $conference['Conference']['back_color'];?>',
		flat: true,
		onChange: function (hsb, hex, rgb) {
			$('#cnf_back_color').val(hex);
			// alert(hex);
		// $('#colorSelector div').css('backgroundColor', '#' + hex);
		}
	});
	$('.sec_row').show();
	$("#loader").css("display","none");
		
	$('#cnf_name').bind('keyup', function(event) {
		var confValue = $('#cnf_name').val();
		var remainingChar = 40-confValue.length;
		$('#cnf_name').attr('maxlength', 40);
		$('.inp_counter').html(remainingChar);
	})

	$('#upl_logo').click(function(){
		$('#file').click();
	})
	$('#file').change(function() {
	    $('#appLogoForm').submit();
	});

	// Image upload function
		// function from the jquery form plugin
		 $('#appLogoForm').ajaxForm({
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
		 			$('#imageInput').append('<input type="hidden" name="logo_image" value='+response.responseText+' id="cnf_name">');
		 			$('#mapHiddenImage').val(response.responseText);
		 			//update the image container,then update alert message and show it
		 			$(".image").html("<img src='files/image/app/"+response.responseText+"' width='100%'/>");
		 			$(".alert-message").html("<strong>Success!</strong> Image uploaded to the server");
		 			// $(".alert").show();
		 		}
		 		//setting a time out function to auto hide the alert after 3sec
		 		setTimeout(function() { $(".alert").hide(); }, 3000);
		 			
		 	}
		 });
		 $(".alert").hide();
		 //set the progress bar to be hidden on loading
		 $(".progress").hide();

		 // save conference information start
		 	$('#saveConfBtn').click(function(){
			 		var name = $('#cnf_name').val();
				    var url = "convene/saveConference"; // the script where you handle the form input.
				    $.ajax({
				    	type: "POST",
				    	url: url,
			           data: $("#coferenceForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		$(window).scrollTop($('#header').offset().top);
			           		$(".alert").show().delay(2000).fadeOut();
			           		$('#cnf_name').val(name);
			           }
				       });

				    // preventDefault(); // avoid to execute the actual submit of the form.
			})
		 // save conference information end
</script>