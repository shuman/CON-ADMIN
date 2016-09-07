<style type="text/css">
	#test {
		display: none;
	}
</style>
<div class="edit_content_box">
	<div class="edit_head">
	<a class="cancel cancelCreateMap" href="javascript:;">- Cancel</a>
	</div>

	<div class="edit_content">
		<div class="input_block">
		<form action="javascript:;" id="mapSaveForm">
			<label>Name of Map</label>
			<input type="text" name="name" id="newMapName">
			<input type="hidden" id="mapHiddenImage" name="map_image">
		</form>
		</div><!-- /input_block -->

		<div class="button_sec">
			<form action="convene/mapImageUpload" method="post" id="myForm"
				enctype="multipart/form-data">
				<input type="file" name="file" id="file" style="display: none;"><br>
				<input type="submit" name="submit" class="button btn btn-success" id="mapImageSub" value="Upload Image">
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

		<!-- <div class="map_img">
			<?php echo $this->Html->image('map_bg1.jpg');?>
		</div> -->
		<!-- <div class="input_block pad_b20">
			<div class="pull-left">
				<button class="button btn_delete">Delete Map</button>
			</div>
			<div class="pull-right">
				<button class="button">Change Picture</button>
			</div>
		</div> -->
	</div>

	<div class="edit_footer">
		<button class="button createMapButton" id="createMapButton" type="button">Create Map</button>
	</div>
</div><!-- /edit_content_box -->
<script type="text/javascript">
	$('#mapImageSub').click(function(){
			$("#mapImageSub").hide();
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
			 			$("#mapImageSub").show();
			 			return false;
			 		}	
			 		else{
			 			$("#mapImageSub").show();
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
			 			$("#mapImageSub").show();
			 		} 
			 		else{
			 			$('#mapHiddenImage').val(response.responseText);
			 			//update the image container,then update alert message and show it
			 			$(".image").html("<img src='files/image/map/"+response.responseText+"' width='100%'/>");
			 			$(".alert-message").html("<strong>Success!</strong> Image uploaded to the server");
			 			$(".alert").show();
			 			$("#mapImageSub").show();
			 		}
			 		//setting a time out function to auto hide the alert after 3sec
			 		setTimeout(function() { $(".alert").hide(); }, 3000);
			 			
			 	}
			 });
			 document.body.onfocus = function(){ 
			 	$("#mapImageSub").show();
			  }
			 $(".alert").hide();
			 //set the progress bar to be hidden on loading
			 $(".progress").hide();


			 // Submit form save map name and image
			 $('#createMapButton').click(function(){
			 		var name = $('#newMapName').val();
				    var url = "convene/saveNewMap"; // the script where you handle the form input.
				    $.ajax({
				    	type: "POST",
				    	url: url,
				           data: $("#mapSaveForm").serialize(), // serializes the form's elements.
				           success: function(data)
				           {
				           	$('#createMapArea').html('');
				           	$(window).scrollTop($('#header').offset().top);
				           	$('#mapListDrag').append('<li id="Map_'+data+'" class="ui-sortable-handle"><div class="list_row dot_bg"><span class="map_title emap" datamid='+data+'>'+name+'</span><a class="delate_mgs" datamapid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></li>').fadeIn('slow');
				           	$('#addBtnArea').append('<a href="javascript:;" class="addMap" id="addNewMap">+  Add Map</a>');
				           	mapScript();
				           }
				       });

				    // preventDefault(); // avoid to execute the actual submit of the form.
			})
</script>