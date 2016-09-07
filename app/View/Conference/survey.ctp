<div id="surveyListArea">
	<div class="sec_row">
		<div class="sec_title">
			<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
			<p>Create surveys for users to take.</p>
		</div>
		<div class="sec_desc">
			<div class="survey_content">
				<div class="survey_list">
					<div class="list_container">
						<div id="editArea">
							
						</div>
						<div class="surveyLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
						<ul id="surveyListDrag">
							<?php if (!empty($surveys)): ?>
								<?php foreach ($surveys as $eachSurvey): ?>
									<li id="Survey_<?php echo $eachSurvey['Survey']['survey_id'];?>" class="surveyList">
										<div class="list_row dot_bg">
											<span class="wdt_60 eSurvey" datasid="<?php echo $eachSurvey['Survey']['survey_id'];?>">
												<h3><?php echo $eachSurvey['Survey']['name'] ? $eachSurvey['Survey']['name']: 'N/A';?></h3>
												<p><?php echo $eachSurvey['Survey']['remark'] ? $eachSurvey['Survey']['remark']: '';?></p>
											</span>
											<span class="wdt_20"><?php echo sizeof($eachSurvey['Question']);?> questions</span>
											<a href="javascript:;" datasid="<?php echo $eachSurvey['Survey']['survey_id'];?>" class="signal_icon"><i class="fa fa-signal" aria-hidden="true"></i></a>
											<a href="javascript:;" datasid="<?php echo $eachSurvey['Survey']['survey_id'];?>" class="delate_mgs"><i aria-hidden="true" class="fa fa-trash-o"></i></a>
										</div>
									</li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>

					<div class="addNewSurveyArea">
						
					</div>
					<!-- <div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div> -->
					<div class="button_sec pad_b20">
						<a class="text_upc addNewSurvey" href="javascript:;">+  Add Survey</a>
					</div>
				</div><!-- /survey_list -->
				
			</div><!-- /speakers_content -->
		</div>
	</div><!-- /sec_row -->
</div>
<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
<div id="reportArea">
	
</div>
<script type="text/javascript">
	function surveyScript() {
		// Text edit from navigation
		navNedit();
		// edit survey
		$('.eSurvey').unbind().click(function(){{
			var surveyId = $(this).attr('datasid');
			// Remove previous one
			$('#editArea').html('');
			$('.list_row').show();
			$('#Survey_'+surveyId+'').hide();

			$(this).parent().hide();
			$('.surveyLoader').show();
			$.post('conference/surveyedit/'+$(this).attr('datasid'),
				function(html) {
					$('.surveyLoader').hide();
					$('.addNewSurvey').hide();
					$('#editArea').append(html);
					createSurveyFun();
				}); 
		}})
		// Drag and drop
		$( "#surveyListDrag" ).sortable({
			change: function(event, ui) {
				var currentPosition = ui.item.index();
				window.currentPosition = currentPosition + 1;
			},
			update: function(event, ui) {
				$('.surveyLoader').show();
				$('#surveyListDrag').attr("style", "opacity: 0.3");
			var url = "conference/updateSurveyList"; // the script where you handle the form input.
			$.ajax({
				type: "POST",
				url: url,
			           data: $("#surveyListDrag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           	$('.surveyLoader').hide();
			           	$('#surveyListDrag').attr("style", " ");
			           }
			       });
		}
	});
		$('#surveyListDrag').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
		      event.stopImmediatePropagation();
		})
		// $( "#surveyListDrag" ).disableSelection();
    	// end drag
		// Survey Report
		$('.signal_icon').click(function(){
			$('#surveyListArea').hide();
			$('.agLoader').show();
			$.post('conference/surveyReport/'+$(this).attr('datasid'),
				function(html) {
					$('.agLoader').hide(); 
					$('#reportArea').prepend(html);
					afterPreReport();
				}); 
		})
		// Delete Survey
		$('.delate_mgs').click(function(){
			var parentDiv = $(this).parent();
			var surveyId = {'id': $(this).attr('datasid')};
			$.ajax({
				type: "POST",
				url: 'conference/deleteSurvey',
		            data: {'contentJson': surveyId}, // serializes the form's elements.
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

		$('.sec_row').show();
		$("#loader").css("display","none");
		
		$("html, body").animate({ scrollTop: "1px" });
		// $(window).scrollTop($('#header').offset().top);
		$('.addNewSurvey').click(function(){
			$('.agLoader').show();
			$.post('conference/createServeyElement', {'tweet': 'feep feep feep'}, 
				function(html) {
					$('.agLoader').hide();
					$('.list_container').hide();
					$('.addNewSurvey').hide();
					$('.addNewSurveyArea').show();
					$('.addNewSurveyArea').prepend(html);
	             // removeCreateSpeaker();
	             createSurveyFun();	
	         }); 
		})
	}

	function afterPreReport() {
		$('#viewAll').click(function(){
			$('#reportArea').html('');
			$('#surveyListArea').show();
		})
	}

	function createSurveyFun() {
		// name character limit
		$('#srv_servey_name').bind('keyup', function(event) {
			var confValue = $('#srv_servey_name').val();
			var remainingChar = 40-confValue.length;
			$('#srv_servey_name').attr('maxlength', 40);
			$('.inp_servey_counter').html(remainingChar);
		})
	    // description character limit
	    $('#srv_servey_des').bind('keyup', function(event) {
	    	var confValue = $('#srv_servey_des').val();
	    	var remainingChar = 80-confValue.length;
	    	$('#srv_servey_des').attr('maxlength', 80);
	    	$('.inp_description_counter').html(remainingChar);
	    })
		// View all survey link to list page
		$('.viewAllSurvey').click(function(){
			tinymce.EditorManager.editors = [];
			$('.addNewSurveyArea').html('');
			$('.surveyList').show();
			$('.list_container').show();
			$('.addNewSurvey').show();
		})	
		// Add survey questions
		$('.addSurveyQuestion').unbind().click(function(){
			$('.sqLoader').show();
			$.post('conference/createServeyQuestionElement', {'tweet': 'feep feep feep'}, 
				function(html) { 
					$('.sqLoader').hide();
					$('.addSurveyQuestion').hide();
					$('.surveyQuestionArea').prepend(html);
					removeCreateSurveyQuestion();
	             // createSurveyFun();	
	         }); 
		})
	}
	function removeCreateSurveyQuestion() {
		$('.cancelsurveyQuestion').click(function(){
			tinymce.EditorManager.editors = [];
			$('.surveyQuestionArea').html('');
			$('.addSurveyQuestion').show();
		})
	}
</script>