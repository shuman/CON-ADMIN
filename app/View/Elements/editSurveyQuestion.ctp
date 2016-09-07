<div class="srv_edit_content">
	<div class="edit_content_box">
		<div class="edit_head">
		<a class="cancel cancelsurveyQuestion" href="javascript:;">- Cancel</a>
		</div>
		<div class="edit_content">
			<div class="input_block">
				<label>Select Question Type</label>
				<div class="input_row">
					<ul class="slc_qus">
						<li class="col_3 active">
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
			<div class="input_block">
				<label for="twh">Question</label>
				<textarea class="tinymce" id="ta" name="question"></textarea>
			</div>

			<div class="sec_answer">
				<label>Answers</label>
				<div class="answerOnly">
					<div class="input_block">
						<input type="text" name="answer[]" id="answer_a">
						<span class="ans_sl">A</span>
					</div>
					<div class="input_block">
						<input type="text" name="answer[]" id="answer_b">
						<span class="ans_sl">B</span>
					</div>
					<div class="input_block">
						<input type="text" name="answer[]" id="answer_c">
						<span class="ans_sl">C</span>
					</div>
					<div class="input_block">
						<input type="text" name="answer[]" id="answer_d">
						<span class="ans_sl">D</span>
					</div>
				</div>

				<div class="input_block">
					<a class="add_plus" href="javascript:;"> + </a>
				</div>
			</div><!-- /sec_answer -->
			</form>

			<div class="edit_footer">
				<div class="input_block">
					<div class="pull-right">
						<button class="button createQuestionButton" type="submit">Create Question</button>
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
	// Creast question submit for save
	$('.createQuestionButton').click(function(){
				var question = $('#ta').val();
			    var url = "conference/saveQuestion"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#addQuestionForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		$(".srv_edit_content").fadeOut(400, function() { $(this).remove(); });
			           		$('.savedQuestions').append('<div class="list_row dot_bg"><span class="wdt_90"><div class="srv_qus"><span class="sl slsq">1</span><p>'+question+'</p></div></span><a href="javascript:;" dataqid='+data+' class="delate_s_q"><i aria-hidden="true" class="fa fa-trash-o"></i></a><input type="hidden" name=questions[]  value='+data+'></input></div>').fadeIn('slow');
			           		$('.addSurveyQuestion').show();
			           		reList();
			           		deleteSurQues();
			           }
			         });
		})
</script>