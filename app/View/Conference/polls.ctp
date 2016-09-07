<div id="pollListArea">
	<div class="sec_row">
	<div class="sec_title">
		<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
		<p>Create Polls for users to take.</p>
	</div>
	<div class="sec_desc">
		<div class="polls_content">
			<div class="polls_list">
				<?php if (!empty($polls)): ?>
					<div class="list_container">
					<div id="editArea">
						
					</div>
					<div class="pollLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
						<ul id="pollListDrag">
							<?php foreach($polls as $eachPoll): ?>
								<li id="Poll_<?php echo $eachPoll['Poll']['poll_id'];?>">
									<div class="list_row dot_bg">
										<span class="wdt_60 ePoll" datapid="<?php echo $eachPoll['Poll']['poll_id'];?>">
											<h3><?php echo $eachPoll['Poll']['name'] ? $eachPoll['Poll']['name'] : '';?></h3>
											<p><?php echo $eachPoll['Poll']['contents'] ? $eachPoll['Poll']['contents'] : '';?></p>
										</span>

										<a href="javascript:;" datapid="<?php echo $eachPoll['Poll']['poll_id'];?>" class="signal_icon"><i class="fa fa-signal" aria-hidden="true"></i></a>
										<a href="javascript:;" datapid="<?php echo $eachPoll['Poll']['poll_id'];?>" class="delate_mgs"><i aria-hidden="true" class="fa fa-trash-o"></i></a>
									</div><!-- /list_row -->
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				<?php endif;?>
				
				<div id="createPollArea">
					
				</div>
				<div class="button_sec pad_b20">
					<a class="text_upc addPollBtn" href="javascript:;">+  Add Polls</a>
				</div>
			</div><!-- /survey_list -->

		</div><!-- /speakers_content -->
	</div>
	</div>
</div>
<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
<div id="pollReportArea">
	
</div>
<script type="text/javascript">
	function pollsScript() {
		// Text edit from navigation
		navNedit();
		// edit poll
		$('.ePoll').unbind().click(function(){{
			// remove previous one
			$('#editArea').html('');
			$('.list_row').show();

			$(this).parent().hide();
			$('.pollLoader').show();
			$.post('conference/polledit/'+$(this).attr('datapid'),
				function(html) {
					$('.pollLoader').hide();
					$('#editArea').append(html);
					removeCreatePoll();
					afterAppendFun();
	         }); 
		}})
		// Drag and drop
	    $( "#pollListDrag" ).sortable({
		change: function(event, ui) {
			var currentPosition = ui.item.index();
			window.currentPosition = currentPosition + 1;
		},
		update: function(event, ui) {
			$('.pollLoader').show();
			$('#pollListDrag').attr("style", "opacity: 0.3");
			var url = "conference/updatePollList"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#pollListDrag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           		$('.pollLoader').hide();
							$('#pollListDrag').attr("style", " ");
			           }
			         });
		}
		});
    	// $( "#pollListDrag" ).disableSelection();
    	$('#pollListDrag').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
		      event.stopImmediatePropagation();
		})
    	// end drag
		// Polls Report
		$('.signal_icon').click(function(){
			$('#pollListArea').hide();
			$('.agLoader').show();
			$.post('conference/pollReport/'+$(this).attr('datapid'),
				function(html) {
					$('.agLoader').hide(); 
					$('#pollReportArea').prepend(html);
					removeCreatePoll();
	         }); 
		})
		// Drag and drop
		$( ".list_container" ).sortable({
			update: function(event, ui) {
				console.log(ui.item.index());
				console.log(ui.item.html());
			}
		});
		$('.list_container').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
		      event.stopImmediatePropagation();
		})
	    // $( ".list_container" ).disableSelection();
		// Hide Spinn
		$('.sec_row').show();
		$("#loader").css("display","none");
		// Add new poll
		$('.addPollBtn').click(function(){
			$('.addPollBtn').hide();
			$('.agLoader').show();
			$.post('conference/createPollElement', {'tweet': 'feep feep feep'}, 
			function(html) { 
				$('.agLoader').hide();
	             $('#createPollArea').prepend(html);
	             removeCreatePoll();
	             afterAppendFun();
	         });
		})
	}
	function removeCreatePoll() {
		$('.cancelPoll').click(function(){
			$('#pollListArea').show();
			$('#pollReportArea').html('');
			tinymce.EditorManager.editors = [];
			$('#createPollArea').html('');
			$('#editArea').html('');
			$('.list_row').show();
			$('.addPollBtn').show();
		})
	}
	function afterAppendFun() {
		$('.savePollBtn').click(function(){
			var selected = $('.slc_qus').find('.active').find('.mlChoice').attr('id');
			alert(selected);
			var type = 1;
			if (selected == 'multiChoice') {
				type = 1
			} else if (selected == 'yesNoChoice') {
				type = 2;
			} else if (selected == 'trueChoice') {
				type = 3;
			} else if (selected == 'shortChoice') {
				type = 4;
			}
			alert(type); return false;
			$('#type').val(type);
			var name = $('#poll_name').val();
			var question = $('#pollQuestion').val();
			var url = "conference/savePoll"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#createPollForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		tinymce.EditorManager.editors = [];
							$('#createPollArea').html('');
							$('.list_container').show();
							$('.addPollBtn').show();
			           		$(window).scrollTop($('#header').offset().top);
			           		$('.list_container').prepend('<div class="list_row dot_bg"><span class="wdt_60 ePoll" datapid='+data+'><h3>'+name+'</h3><p></p><p>'+question+'</p><p></p></span><a href="javascript:;" datapid='+data+' class="signal_icon"><i class="fa fa-signal" aria-hidden="true"></i></a><a href="javascript:;" datapid='+data+' class="delate_mgs"><i aria-hidden="true" class="fa fa-trash-o"></i></a></div>').fadeIn('slow');
			           		pollsScript();
			           }
			         });
		})
	}
	$('.delate_mgs').click(function(){
			var parentDiv = $(this).parent();
			var faqId = {'id': $(this).attr('datapid')};
			$.ajax({
			    	type: "POST",
			    	url: 'conference/deletePoll',
		            data: {'contentJson': faqId}, // serializes the form's elements.
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
</script>