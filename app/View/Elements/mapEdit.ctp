<div class="edit_content_box">
	<div class="edit_head">
	<a class="cancel cancelCreateMap" href="javascript:;">- Cancel</a>
	</div>

	<div class="edit_content">
		<div class="input_block">
		<form action="javascript:;" id="mapSaveForm">
			<label>Name of Map</label>
			<input type="hidden" name="map_id" id="eMapId" value="<?php echo $map['Map']['map_id'];?>">
			<input type="text" name="name" id="newMapName" value="<?php echo $map['Map']['name'];?>">
			<input type="hidden" id="mapHiddenImage" name="map_image">
		</form>
		</div><!-- /input_block -->

		<div class="button_sec">
			<form action="convene/mapImageUpload" method="post" id="myForm" enctype="multipart/form-data">
				<input type="file" name="file" id="file" style="display: none;"><br>
				<input type="submit" name="submit" class="button btn btn-success" id="mapImageSub" value="Upload Image">
			</form>
			<br>
			<div class="progress progress-striped active" style="display: none;">
			  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			    <span class="sr-only">0% Complete</span>
			  </div>
			</div>
			<div class="image">
				<?php if ($map['Map']['map_image']): ?>
					<img src='files/image/map/<?php echo $map['Map']['map_image'];?>' width='100%' height='500px;'/>
				<?php endif;?>
			</div>
		</div>
	</div>

	<div class="edit_footer">
		<button class="button createMapButton" type="button">Update Map</button>
	</div>
</div>
<script type="text/javascript">
	$('#mapImageSub').click(function(){
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
			 		$(".progress").show();
			 		$("#mapImageSub").remove();
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
			 			$(".progress").hide();
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
			 			$('#mapHiddenImage').val(response.responseText);
			 			//update the image container,then update alert message and show it
			 			$(".image").html("<img src='files/image/map/"+response.responseText+"' width='100%'/>");
			 			$(".alert-message").html("<strong>Success!</strong> Image uploaded to the server");
			 			$(".alert").show();
			 			$('#myForm').prepend('<input type="submit" name="submit" class="button btn btn-success" id="mapImageSub" value="Upload Image">');
			 		}
			 		//setting a time out function to auto hide the alert after 3sec
			 		setTimeout(function() { $(".alert").hide(); }, 3000);
			 			
			 	}
			 });
			 document.body.onfocus = function(){ 
			 	$('#myForm').prepend('<input type="submit" name="submit" class="button btn btn-success" id="mapImageSub" value="Upload Image">');
			  }
			 $(".alert").hide();
			 //set the progress bar to be hidden on loading
			 $(".progress").hide();


			 // Submit form save map name and image
			 $('.createMapButton').click(function(){
			 		var name = $('#newMapName').val();
			 		var mapId = $('#eMapId').val();
				    var url = "convene/saveNewMap"; // the script where you handle the form input.
				    $.ajax({
				    	type: "POST",
				    	url: url,
				           data: $("#mapSaveForm").serialize(), // serializes the form's elements.
				           success: function(data)
				           {
				           	$('#Map_'+mapId+'').html('');
				           	$(window).scrollTop($('#header').offset().top);
				           	$('#Map_'+mapId+'').append('<div class="list_row dot_bg"><span class="map_title emap" datamid='+mapId+'>'+name+'</span><a class="delate_mgs" datamapid='+mapId+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>').fadeIn('slow');
				           	$('.addMap').show();
				           	mapScript();
				           }
				       });

				    // preventDefault(); // avoid to execute the actual submit of the form.
			})
</script>