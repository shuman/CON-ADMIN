<div class="survey_content">
	<div class="sec_row">
		<div class="border_left_arrow">
			<a class="viewAllSurvey" href="javascript:;">Cancel</a>
		</div>
	</div><!-- /sec_row -->
<form action="javascript:;" id="saveNewSurveyForm">
	<div class="sec_row">
		<div class="sec_title">
			<h2>Survey Name</h2>
			<p>Assign a name to the survey to distinuish it from others.</p>
		</div>
		<div class="sec_desc">
			<div class="input_block">
				<input type="hidden" name="survey_id" id="srv_servey_id" value="<?php echo $survey['Survey']['survey_id'];?>">
				<input type="text" name="name" id="srv_servey_name" value="<?php echo $survey['Survey']['name'];?>">
				<span class="inp_counter inp_servey_counter"><?php echo 40 - strlen($survey['Survey']['name']);?></span>
			</div>
		</div>
	</div><!-- /sec_row -->

	<div class="sec_row">
		<div class="sec_title">
			<h2>Survey Description</h2>
			<p>Assign a description that will be displayed below the name.</p>
		</div>

		<div class="sec_desc">
			<div class="input_block">
				<textarea class="tinymce_desc" name="remark" id="srv_servey_des" ></textarea>
				<!-- <div class="tinymce_desc" id="srv_servey_des"></div> -->
				<span class="inp_counter inp_description_counter"><?php echo 80 - strlen($survey['Survey']['remark']);?></span>
			</div>
		</div>
	</div><!-- /sec_row -->

	<div class="sec_row">
		<div class="sec_title">
			<h2>Survey Questions</h2>
			<p>Add multiple choice or short fill questions to the survey</p>
		</div>

		<div class="sec_desc">
			<div class="savedQuestions">
			<?php if (!empty($survey)): ?>
				<ul id="surveyQuesDrag">
					<div class="surveyQLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
					<?php $i=1; foreach($survey['Question'] as $eachQueation): ?>
						<li id="Question_<?php echo $eachQueation['question_id'];?>">
							<div class="list_row dot_bg">
								<span class="wdt_90 esurQues" dataqid=<?php echo $eachQueation['question_id'];?>>
									<div class="srv_qus">
										<span class="sl slsq"><?php echo $i; $i=$i+1;?></span>
										<p><?php echo $eachQueation['question']; ?></p>
									</div>
								</span>
								<a href="javascript:;" dataqid="<?php echo $eachQueation['question_id'];?>" class="delate_s_s_q"><i aria-hidden="true" class="fa fa-trash-o"></i></a><input type="hidden" name="questions[]" value="36">
							</div>
						</li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
				
			
			</div>
			</form>
			<div class="list_container">

				<div class="surveyQuestionArea">
					
				</div>
				<div class="agLoader sqLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>

				<div class="button_sec pad_b20">
					<a class="text_upc addEditSurveyQuestion" datasid="<?php echo $survey['Survey']['survey_id'];?>" href="javascript:;">+  Add Question</a>
				</div>
			</div>
		</div>
	</div><!-- /sec_row -->
	<div class="button_sec pad_b20">
		<a class="text_upc saveNewSurvey" href="javascript:;"><i class="fa fa-save"></i>  Update Survey</a>
	</div>
</div><!-- /survey_content -->
<script type="text/javascript">
// Drag and drop
		$( "#surveyQuesDrag" ).sortable({
			change: function(event, ui) {
				var currentPosition = ui.item.index();
				window.currentPosition = currentPosition + 1;
			},
			update: function(event, ui) {
				$('.surveyQLoader').show();
				$('#surveyQuesDrag').attr("style", "opacity: 0.3");
			var url = "conference/updateSurveyQuestionList"; // the script where you handle the form input.
			$.ajax({
				type: "POST",
				url: url,
			           data: $("#surveyQuesDrag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           	$('.surveyQLoader').hide();
			           	$('#surveyQuesDrag').attr("style", " ");
			           }
			       });
		}
	});
		// $( "#surveyQuesDrag" ).disableSelection();
		$('#surveyQuesDrag').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
		      event.stopImmediatePropagation();
		})
    	// end drag

    	// Add survey questions
		$('.addEditSurveyQuestion').click(function(){
			$('.sqLoader').show();
			var surveyId = $(this).attr('datasid');
			$.post('conference/createEditServeyQuestionElement/'+surveyId+'', {'tweet': 'feep feep feep'}, 
				function(html) { 
					$('.sqLoader').hide();
					$('.addSurveyQuestion').hide();
					$('.surveyQuestionArea').prepend(html);
					removeCreateSurveyQuestion();
	             // createSurveyFun();	
	         }); 
		})

    	// Edit Survey Question Start
    		$('.esurQues').click(function(){
    			$(this).parent().hide();
				$('.surveyQLoader').show();
				var dataqid = $(this).attr('dataqid');
				$.post('conference/surveyQuestionEdit/'+$(this).attr('dataqid'),
					function(html) {
						$('.surveyQLoader').hide();
						$('.addSurveyQuestion').hide();
						$('#Question_'+dataqid+'').prepend(html);
					}); 
    		})
    	// Edit Survey Question End

// Delete survey questions
$('.delate_s_s_q').click(function(){
	var parentDiv = $(this).parent();
	var qid = $(this).attr('dataqid');
			var surQid = {'id': $(this).attr('dataqid')};
			$.ajax({
			    	type: "POST",
			    	url: 'conference/deleteSurveyQuestion',
		            data: {'contentJson': surQid}, // serializes the form's elements.
		            beforeSend: function() {
								parentDiv.css('background-color', '#F2DEDE');
							},
			        success: function(data)
			           {
			               parentDiv.slideUp(600,function() {
			               		$('#Question_'+qid+'').remove();
										parentDiv.remove();
										$('.slsq').each(function(i, obj) {
		            						$(obj).html(i+1);
										});
						});
			           }
			       });
})
$('.viewAllSurvey').click(function(){
	$('#editArea').html('');
	$('.list_row').show();
})
tinymce.EditorManager.editors = [];
var description = "<?php echo $survey['Survey']['remark']; ?>";
$('#srv_servey_des').val(description);
// survey description editor init
		tinymce.init({
	        selector: '.tinymce_desc',  // change this value according to your HTML
	        menubar: false,
	        theme: 'modern',
	        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
	        setup : function(ed) {
		        	ed.on('change', function () {
			            ed.save();
			        });
                  ed.on('keyup', function(e) {
                     	var confValue = $(ed.getBody()).text().length;
						var remainingChar = 80-confValue;
						$('#srv_servey_des').attr('maxlength', 80);
						$('.inp_description_counter').html(remainingChar);
                  });
            }
	    });
	$('.saveNewSurvey').click(function(){
		var survId = $('#srv_servey_id').val();
		var name = $('#srv_servey_name').val();
		var description = $('#srv_servey_des').val();
		var quesCount = $("#surveyQuesDrag li").children().length;
		var url = "conference/updateSurvey"; // the script where you handle the form input.
		    $.ajax({
		           type: "POST",
		           url: url,
		           data: $("#saveNewSurveyForm").serialize(), // serializes the form's elements.
		           success: function(data)
		           {
		           		tinymce.EditorManager.editors = [];
						$('.addNewSurveyArea').html('');
						// $('.list_container').show();
						$('.addNewSurvey').show();
						$('#editArea').html('');
						$('#Survey_'+survId+'').show();
						$('#Survey_'+survId+'').html('');
						$('#Survey_'+survId+'').append('<div class="list_row dot_bg"><span class="wdt_60 eSurvey" datasid='+survId+'><h3>'+name+'</h3><p>'+description+'</p></span><span class="wdt_20">'+quesCount+' questions</span><a href="javascript:;" datasid='+survId+' class="signal_icon"><i class="fa fa-signal" aria-hidden="true"></i></a><a href="javascript:;" datasid='+survId+' class="delate_mgs"><i aria-hidden="true" class="fa fa-trash-o"></i></a></div>');
		           		$(window).scrollTop($('#header').offset().top);
		           		surveyScript();
		           }
		         });
	})
</script>