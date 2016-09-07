<div class="sec_row">
	<div class="sec_title">
		<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
		<p>Add conference's keynote speakers.</p>
	</div>
	<div class="sec_desc" id="listSpeakers">
		<div class="speakers_content">
			<div class="spk_list">
			<div class="speakerLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
			<ul id="speakerListDrag">
			<div id="editArea">
								
			</div>
			<!-- <div class="speakerLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div> -->
				<?php if (!empty($speakers)): ?>
				<?php foreach($speakers as $eachSpeaker): ?>
					<li id="Speaker_<?php echo $eachSpeaker['Speaker']['speaker_id'];?>">
						<div class="spk_list_item dot_bg">
						<div class="spk_item espeaker" datasid="<?php echo $eachSpeaker['Speaker']['speaker_id'];?>">
							<div class="spk_pic">
								<?php echo $eachSpeaker['Speaker']['speaker_image'] ? $this->Html->image('/files/image/speaker/'.$eachSpeaker['Speaker']['speaker_image']) : $this->Html->image('dummy_person.gif');?>
							</div>
							<div class="spk_desc">
								<h3><?php echo $eachSpeaker['Speaker']['name'] ? $eachSpeaker['Speaker']['name'] : '';?></h3>
								<p><?php echo $eachSpeaker['Speaker']['biography'] ? $eachSpeaker['Speaker']['brief_biography'] : '';?> <br> <?php echo $eachSpeaker['Speaker']['twitter_handle'] ? $eachSpeaker['Speaker']['twitter_handle'] : '';?></p>
							</div>
						</div>
						<a class="delate_mgs" dataspid="<?php echo $eachSpeaker['Speaker']['speaker_id'];?>" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div><!-- /spk_list_item -->
					</li>
				<?php endforeach;?>
			<?php endif;?>
			</ul>
				<div class="button_sec">
					<button class="button addSpeaker">+  Add Speaker</button>
				</div>
				<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
				<div class="createSpeakerArea">
					
				</div>

				<div class="spk_bg_image">
					<div class="sec_title">
						<h2>Speakers Background Image</h2>
						<p>Upload a background image that will be displayed in the headers of each speaker's biography. <strong>Dimentions: 750 px by 370 px.</strong></p>
					</div>

						<!-- After delete background -->
						<div class="afterDelete" style="display: none;">
							<div class="button_sec">
							<form action="convene/speakerBgUpload" method="post" id="appLogoForm"
								enctype="multipart/form-data" >
								<input type="file" name="file" id="file" style="display: none;"><br>

								<input type="submit" name="submit" class="button upl_logo" value="Upload Image">
							</form>
							<br>
							<div class="progress progress-striped active">
							  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
							  aria-valuemax="100" style="width: 0%"> 
							    <span class="sr-only">0% Complete</span>
							  </div>
							</div>
							<div class="spk_bg">
								<div class="image"></div>
							</div>
							
							<div class="button_sec" id="afterUploadBlock" style="display: none;">
								<div class="pull-right">
									<button class="button btn_sm btn_delete" type="submit">Delete</button>
								</div>
								<div class="pull-left">
									<button class="button btn_sm upl_logo" type="submit">Change Image</button>
								</div>	
							</div>
						</div>
						</div>


						<?php if (empty($speakerBg['Conference']['speaker_bkimg'])): ?>
						<div class="button_sec">
							<form action="convene/speakerBgUpload" method="post" id="appLogoForm"
								enctype="multipart/form-data" >
								<input type="file" name="file" id="file" style="display: none;"><br>

								<input type="button" name="submit" class="button upl_logo" value="Upload Image">
							</form>
							<br>
							<div class="progress progress-striped active">
							  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
							  aria-valuemax="100" style="width: 0%"> 
							    <span class="sr-only">0% Complete</span>
							  </div>
							</div>
							<div class="spk_bg">
								<div class="image"></div>
							</div>
							
							<div class="button_sec" id="afterUploadBlock" style="display: none;">
								<div class="pull-right">
									<button class="button btn_sm btn_delete" type="submit">Delete</button>
								</div>
								<div class="pull-left">
									<button class="button btn_sm upl_logo" type="submit">Change Image</button>
								</div>	
							</div>
						</div>
					<?php endif;?>

					<div id="mainAjaxArea" style="display: none;">
						<div class="button_sec">
							<form action="convene/speakerBgUpload" method="post" id="appLogoForm"
								enctype="multipart/form-data" >
								<input type="file" name="file" id="file" style="display: none;"><br>

								<input type="submit" name="submit" class="button upl_logo" value="Upload Image">
							</form>
							<br>
							<div class="progress progress-striped active">
							  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
							  aria-valuemax="100" style="width: 0%"> 
							    <span class="sr-only">0% Complete</span>
							  </div>
							</div>
							<div class="spk_bg">
								<div class="image"></div>
							</div>
							
							<div class="button_sec" id="afterUploadBlock" style="display: none;">
								<div class="pull-right">
									<button class="button btn_sm btn_delete bgDel" type="submit">Delete</button>
								</div>
								<div class="pull-left">
									<button class="button btn_sm upl_logo bgCng" type="submit">Change Image</button>
								</div>	
							</div>
						</div>
					</div>
					

					<div class="input_block">
					<?php if (!empty($speakerBg['Conference']['speaker_bkimg'])): ?>
						<div id="mainImgArea">
							<div class="spk_bg">
							<?php echo $this->Html->image('/files/image/speaker/'.$speakerBg['Conference']['speaker_bkimg']);?>
						</div>
						<div class="button_sec">
							<div class="pull-right">
									<button class="button btn_sm btn_delete bgDel" databid="<?php echo $speakerBg['Conference']['conference_id'];?>" type="submit">Delete</button>
							</div>
							<div class="pull-left">
								<button class="button btn_sm upl_main_logo bgCng" type="submit">Change Image</button>
							</div>	
						</div>
						</div>
					<?php endif;?>
					</div>
				</div><!-- /spk_bg_image -->
			</div><!-- /speakers_content -->
		</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	function speakerScript() {
		// Text edit from navigation
		navNedit();
		// Edit Speaker
		$('.espeaker').unbind().click(function(){{
			// remove previous
			$('.spk_edit_content').remove();
			$('.spk_list_item').show();
			
			$(this).parent().hide();
			$('.addSpeaker').hide();
			$('.spk_bg_image').hide();
			$('.speakerLoader').show();
			var datasid = $(this).attr('datasid');
			$.post('convene/speakerEdit/'+$(this).attr('datasid'),
				function(html) {
					$('.speakerLoader').hide();
					$('#Speaker_'+datasid+'').append(html);
					removeCreateSpeaker();
	         }); 
		}})
		// Delete Speaker bg
		$('.btn_delete').click(function(){
			var contentJson = {'id': $(this).attr('databid')};
			$.ajax({
				    	type: "POST",
				    	url: 'convene/deleteSpeakerBg',
			            data: {'contentJson': contentJson}, // serializes the form's elements.
				        success: function(data)
				           {
				           		$('.afterDelete').show();
				           		$('.spk_bg').html('');
				           		$('.bgCng').hide();
				           		$('.bgDel').hide();
				           }
			       });
		})
		// Drag and drop
	    $( "#speakerListDrag" ).sortable({
		change: function(event, ui) {
			var currentPosition = ui.item.index();
			window.currentPosition = currentPosition + 1;
		},
		update: function(event, ui) {
			$('.speakerLoader').show();
			$('#speakerListDrag').attr("style", "opacity: 0.3");
			var url = "convene/updateSpeakerList"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#speakerListDrag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           		$('.speakerLoader').hide();
							$('#speakerListDrag').attr("style", " ");
			           }
			         });
		}
		});
    	// $( "#speakerListDrag" ).disableSelection();
    	$('#speakerListDrag').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
		      event.stopImmediatePropagation();
		})
    	// end drag

		$('.sec_row').show();
		$("#loader").css("display","none");
		// Speaker background image start
			$('.upl_main_logo').click(function(){
				$('#mainImgArea').hide();
				$('#mainAjaxArea').show();
				$('#file').click();
			})

			$('.upl_logo').click(function(){
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
				 			$('#mapHiddenImage').val(response.responseText);
				 			//update the image container,then update alert message and show it
				 			$(".image").html("<img src='files/image/speaker/"+response.responseText+"' width='100%'/>");
				 			$(".alert-message").html("<strong>Success!</strong> Image uploaded to the server");
				 			$(".alert").show();
				 			$("#afterUploadBlock").show();
				 			$("#appLogoForm").hide();
				 		}
				 		//setting a time out function to auto hide the alert after 3sec
				 		setTimeout(function() { $(".alert").hide(); }, 3000);
				 			
				 	}
				 });
				 $(".alert").hide();
				 //set the progress bar to be hidden on loading
				 $(".progress").hide();
		// Speaker background image end
		$('.addSpeaker').unbind().click(function(){
			$('.addSpeaker').hide();
			$('.spk_bg_image').hide();
			$('.agLoader').show();
			$.post('convene/createspeakerElement', {'tweet': 'feep feep feep'}, 
			function(html) { 
				$('.agLoader').hide();
	             $('.createSpeakerArea').prepend(html);
	             removeCreateSpeaker();
	             createSpeakerFun();
	         }); 
		})

		$('.delate_mgs').click(function(){
			var parentDiv = $(this).parent();
			var contentJson = {'id': $(this).attr('dataspid')};
			$.ajax({
				    	type: "POST",
				    	url: 'convene/deleteSpeaker',
			            data: {'contentJson': contentJson}, // serializes the form's elements.
			            beforeSend: function() {
							parentDiv.css('background-color', '#F2DEDE');
						},
				        success: function(data)
				           {
				           		parentDiv.slideUp(600,function() {
									parent.remove();
								});
				           }
			       });
		})
	}
	// Remove Speaker
	function removeCreateSpeaker() {
		$('.cancelCreateSpeaker').click(function(){
			$(this).parent().parent().remove();
			$('.addSpeaker').show();
			$('.spk_bg_image').show();
		})
	}
	// After create popup conditions goes here
	function createSpeakerFun() {
		// breif description limit
			$('.sp_brif_bio').bind('keyup', function(event) {
				var confValue = $(this).val();
				var remainingChar = 80-confValue.length;
				$('.sp_brif_bio').attr('maxlength', 80);
				$('.sp_brif_bio_counter_counter').html(remainingChar);
			})
		// Submit Form Information
		$('.createSpeaker').click(function(){
			$("#createSpeakerForm").submit(function(e) {

			    var url = "convene/saveSpeaker"; // the script where you handle the form input.
			    var name = $('#twha').val();
			    var image = $('#spim').val();
			    if (!name || !image) {
			    	if (!name) {
			    		$('.nameReq').show();
			    	$("#twha").css({ 'border-color': "red" });
			    	setTimeout(function() { 
			    		$('.nameReq').hide();
			    		$("#twha").css({ 'border-color': "" });
			    	 }, 3000)
			    	}
			    	if (!image) {
			    		$('.add_pic').css({ 'border-color': "red" });
			    		setTimeout(function() { 
			    		$(".add_pic").css({ 'border-color': "" });
			    	 }, 3000)
			    	}
			    	return false;	
			    }
			    var twitter = this.twitter_handle;
			    var brief_biography = this.brief_biography;
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#createSpeakerForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		$(".spk_edit_content").fadeOut(400, function() { $(this).remove(); });
			           		$(window).scrollTop($('#header').offset().top);
			           		$('#speakerListDrag').append('<li id="Speaker_'+data+'" class="ui-sortable-handle"><div class="spk_list_item dot_bg"><div class="spk_item espeaker" datasid='+data+'><div class="spk_pic"><img src="/files/image/speaker/'+image+'" alt=""></div><div class="spk_desc"><h3>'+name+'</h3><p>'+twitter.value+' <br> '+brief_biography.value+'</p></div></div><a class="delate_mgs" dataspid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><!-- /spk_list_item --></li>');
			           		$('.addSpeaker').show();
			           		$('.spk_bg_image').show();
			           		speakerScript();
			           }
			         });

			    e.preventDefault(); // avoid to execute the actual submit of the form.
			});
		})
	}
</script>