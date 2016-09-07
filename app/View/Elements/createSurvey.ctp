<div class="survey_content">
	<div class="sec_row">
		<div class="border_left_arrow">
			<a class="viewAllSurvey" href="javascript:;">View All Surveys</a>
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
				<input type="text" name="name" id="srv_servey_name">
				<span class="inp_counter inp_servey_counter">40</span>
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
				<textarea class="tinymce_desc" name="remark" id="srv_servey_des"></textarea>
				<!-- <div class="tinymce_desc" id="srv_servey_des"></div> -->
				<span class="inp_counter inp_description_counter">80</span>
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
				
			</div>
			</form>
			<div class="list_container">

				<div class="surveyQuestionArea">
					<ul id="surveyQuesDrag">
						
					</ul>
				</div>
				<div class="agLoader sqLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>

				<div class="button_sec pad_b20">
					<a class="text_upc addSurveyQuestion" href="javascript:;">+  Add Question</a>
				</div>
			</div>
		</div>
	</div><!-- /sec_row -->
	<div class="button_sec pad_b20">
		<a class="text_upc saveNewSurvey" href="javascript:;"><i class="fa fa-save"></i>  save Survey</a>
	</div>
</div><!-- /survey_content -->
<script type="text/javascript">
function afterqCreate() {
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
    		$('.esurQues').unbind().click(function(){
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
}



tinymce.EditorManager.editors = [];
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
		var name = $('#srv_servey_name').val();
		var description = $('#srv_servey_des').val();
		var quesCount = $('#surveyQuesDrag').children().length;
		var url = "conference/saveSurvey"; // the script where you handle the form input.
		    $.ajax({
		           type: "POST",
		           url: url,
		           data: $("#saveNewSurveyForm").serialize(), // serializes the form's elements.
		           success: function(data)
		           {
		           		tinymce.EditorManager.editors = [];
						$('.addNewSurveyArea').html('');
						$('.list_container').show();
						$('.addNewSurvey').show();
		           		$(window).scrollTop($('#header').offset().top);
		           		$('#surveyListDrag').append('<li id="Survey_'+data+'" class="surveyList"><div class="list_row dot_bg"><span class="wdt_60 eSurvey" datasid='+data+'><h3>'+name+'</h3><p></p><p>'+description+'</p><p></p></span><span class="wdt_20">'+quesCount+' questions</span><a href="javascript:;" datasid='+data+' class="signal_icon"><i class="fa fa-signal" aria-hidden="true"></i></a><a href="javascript:;" datasid='+data+' class="delate_mgs"><i aria-hidden="true" class="fa fa-trash-o"></i></a></div></li>').fadeIn('slow');
		           		$('.addSurveyQuestion').show();
		           		surveyScript();
		               // alert(data); // show response from the php script.
		           }
		         });
	})
</script>