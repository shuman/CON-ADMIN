<div class="srv_edit_content">
	<div class="edit_content_box">
		<div class="edit_head">
		<a class="cancel cancelQuestionEdit" href="javascript:;">- Cancel</a>
		</div>
		<div class="edit_content">
			<div class="input_block">
				<label>Select Question Type</label>
				<div class="input_row">
					<ul class="slc_qus">
						<li class="col_3 ">
							<div class="slc_qus_type">
								<a href="javascript:void(0)" class="mlChoice" id="multiChoice">Multiple Choice</a>
							</div>
						</li>
						<li class="col_3">
							<div class="slc_qus_type">
								<a href="javascript:void(0)" class="mlChoice" id="yesNoChoice">Yes or No</a>
							</div>
						</li>
						<li class="col_3">
							<div class="slc_qus_type">
								<a href="javascript:void(0)" class="mlChoice" id="trueChoice">True or False</a>
							</div>
						</li>
						<li class="col_3">
							<div class="slc_qus_type">
								<a href="javascript:void(0)" class="mlChoice" id="shortChoice">Shortfill</a>
							</div>
						</li>
					</ul>
				</div>
			</div><!-- /input_block -->
		<form action="javacript:;" id="addQuestionForm">
			<!-- question hidden data -->
			<input type="hidden" name="type" id="type" >
			<input type="hidden" name="question_id" value="<?php echo $question['Question']['question_id'];?>">
			<input type="hidden" name="survey_id" value="<?php echo $question['Question']['survey_id'];?>">
			<div class="input_block">
				<label for="twh">Question</label>
				<textarea class="tinymce" id="ta" name="question"></textarea>
			</div>

			<div class="sec_answer">
				<label>Answers</label>
				<?php if ($question['PresetAnswer']): ?>
					<div class="answerOnly">
						<?php $x='A'; foreach($question['PresetAnswer'] as $eachAnswer): ?>
							<div class="input_block">
								<input type="text" name="answer[]" id="answer_<?php echo strtolower($x);?>" value="<?php echo $eachAnswer['answer'];?>">
								<span class="ans_sl"><?php echo $x; $x++;?></span>
							</div>
						<?php endforeach;?>
					</div>
				<?php endif;?>

				<div class="input_block">
					<a class="add_plus" href="javascript:;"> + </a>
				</div>
			</div><!-- /sec_answer -->
			</form>

			<div class="edit_footer">
				<div class="input_block">
					<div class="pull-right">
						<button class="button createQuestionButton" type="submit">Update Question</button>
					</div>
					<!-- <div class="pull-left">
						<button class="button" type="submit">Save Change</button>
					</div> -->
				</div>
			</div>
			<!-- <div class="edit_footer">
				<button class="button" type="submit">Create Question</button>
			</div> -->
		</div>
	</div>
</div>
<script type="text/javascript">
		// Set type
		var type = "<?php echo $question['Question']['type'];?>";
		if (type == 1) {
			$('.sec_answer').show();
			$('#multiChoice').parent().parent().addClass('active');
		} else if (type == 2) {
			$('.sec_answer').hide();
			$('#yesNoChoice').parent().parent().addClass('active');
		} else if (type == 3) {
			$('.sec_answer').hide();
			$('#trueChoice').parent().parent().addClass('active');
		} else if (type == 4) {
			$('.sec_answer').hide();
			$('#shortChoice').parent().parent().addClass('active');
		} else {
			$('.sec_answer').show();
			$('#multiChoice').parent().parent().addClass('active');
		}
		// Set question
		var question = "<?php echo $question['Question']['question'];?>";
		$('#ta').val(question);

		// Cancel edit question start
			$('.cancelQuestionEdit').click(function(){
				$(this).parent().parent().remove();
				$('.list_row').show();
				$('.addSurveyQuestion').show();
			})
		// Cancel edit question end
	// Delete Survey question
	function deleteSurQues() {
		$('.delate_s_q').click(function(){
			var parentDiv = $(this).parent();
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
										parentDiv.remove();
										$('.slsq').each(function(i, obj) {
		            						$(obj).html(i+1);
										});
						});
			           }
			       });
		})
	}
	tinymce.init({
	        selector: '.tinymce',  // change this value according to your HTML
	        menubar: false,
	        theme: 'modern',
	        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
	        setup: function (editor) {
		        editor.on('change', function () {
		            editor.save();
		        });
		    }
	    });
	$('.mlChoice').click(function(){
		var mlParent = $(this).parent().parent();
		if (mlParent.hasClass('active')) {
			var isHasClass = 'active';
		} else {
			if ($(this).attr('id') == 'multiChoice') {
				$('.sec_answer').show();
			} else {
				$('.sec_answer').hide();
			}
			var isHasClass = '';
		}
		mlParent.parent().find('.active').removeClass('active');
		if (isHasClass == 'active') {
			mlParent.removeClass('active');
		} else {
			mlParent.addClass('active');
		}
		// console.log($(this).parent());
	})
	// Add new multiple choice answer
	$('.add_plus').click(function(){
		var nextCharacter = nextChar($('.answerOnly div:last').find('span').text());
		$('.answerOnly').append('<div class="input_block"><input type="text" name="answer[]" id="answer_'+nextCharacter+'"><span class="ans_sl">'+nextCharacter+'</span></div>');
	})
	function nextChar(c) {
		return String.fromCharCode(c.charCodeAt(0) + 1);
	}
	// Re-listing function
	function reList() {
		$('.slsq').each(function(i, obj) {
		    $(obj).html(i+1);
		});	
	}
	function editSurQues() {
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
	}
	// Creast question submit for save
	$('.createQuestionButton').click(function(){
				var selected = $('.slc_qus').find('.active').find('.mlChoice').attr('id');
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
				$('#type').val(type);

				var question = $('#ta').val();
			    var url = "conference/updateQuestion"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#addQuestionForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		$(".srv_edit_content").fadeOut(400, function() { $(this).remove(); });
			           		$('#Question_'+data+'').append('<div class="list_row dot_bg"><span class="wdt_90 esurQues" dataqid='+data+'><div class="srv_qus"><span class="sl slsq">1</span><p>'+question+'</p></div></span><a href="javascript:;" dataqid='+data+' class="delate_s_s_q"><i aria-hidden="true" class="fa fa-trash-o"></i></a></div>').fadeIn('slow');
			           		$('.addSurveyQuestion').show();
			           		reList();
			           		editSurQues();
			           		afterqCreate();
			           }
			         });
		})
</script>