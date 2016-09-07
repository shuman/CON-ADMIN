<div class="sec_row">
	<div class="sec_desc">
		<div class="poll_edit_content">
			<div class="edit_content_box">
				<div class="edit_head">
					<a class="cancel cancelPoll" href="javascript:;">- Cancel</a>
				</div>
				<form action="javascript:;" id="createPollForm">
				<div class="edit_content">
					<div class="input_block">
						<label>Poll Name</label>
						<input type="hidden" name="poll_id" id="poll_id" value="<?php echo $poll['Poll']['poll_id'];?>">
						<input type="hidden" name="type" id="type" >
						<input type="text" name="name" id="poll_name" value="<?php echo $poll['Poll']['name'];?>">
					</div><!-- /input_block -->

					<div class="input_block">
						<label>Poll Description (Assign a description that will be displayed below the name)</label>

						<textarea class="tinymce_desc" name="contents" id="pollDescription"></textarea>
						<span class="inp_counter"><?php echo 80 - strlen($poll['Poll']['name']);?></span>
					</div><!-- /input_block -->

					<div class="input_block">
						<label>Select Poll Type</label>
						<div class="input_row">
							<ul class="slc_qus">
								<li class="col_3">
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

					<div class="input_block">
						<label for="twh">Question</label>
						<textarea class="tinymce" name="question" id="pollQuestion" ></textarea>
					</div>
						<div class="sec_answer">
							<label>Answers</label>
							<div class="answerOnly">
								<?php if (!empty($poll['PresetPollAnswer'])): ?>
									<?php $x = 'A'; foreach($poll['PresetPollAnswer'] as $eachAnswer): ?>
										<div class="input_block">
											<input type="text" name="answer[]" class="answer_a" value="<?php echo $eachAnswer['answer'];?>">
											<span class="ans_sl"><?php echo $x; $x++;?></span>
											<span class="ans_rl"><i class="fa fa-times removeInput"></i></span>
										</div>
									<?php endforeach;?>
								<?php else: ?>
									<div class="input_block">
										<input type="text" name="answer[]" id="answer_a">
										<span class="ans_sl">A</span>
										<span class="ans_rl"><i class="fa fa-times removeInput"></i></span>
									</div>
									<div class="input_block">
										<input type="text" name="answer[]" id="answer_b">
										<span class="ans_sl">B</span>
										<span class="ans_rl"><i class="fa fa-times removeInput"></i></span>
									</div>
									<div class="input_block">
										<input type="text" name="answer[]" id="answer_c">
										<span class="ans_sl">C</span>
										<span class="ans_rl"><i class="fa fa-times removeInput"></i></span>
									</div>
									<div class="input_block">
										<input type="text" name="answer[]" id="answer_d">
										<span class="ans_sl">D</span>
										<span class="ans_rl"><i class="fa fa-times removeInput"></i></span>
									</div>
								<?php endif;?>
							</div>

							<div class="input_block">
								<a class="add_plus" href="javascript:;"> + </a>
							</div>
						</div><!-- /sec_answer -->
					</form>

					<div class="edit_footer">
						<div class="input_block">
							<div class="pull-right">
								<button class="button updatePollBtn" type="submit">Update poll</button>
							</div>
						</div>
					</div><!-- /edit_footer -->

				</div>
			</div>
		</div>
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
// Remove input
	$('.removeInput').click(function(){
		$(this).parent().parent().remove();
	})
	function removeInput() {
		$('.removeInput').click(function(){
			$(this).parent().parent().remove();
		})
	}
// Set type
		var type = "<?php echo $poll['Poll']['type'];?>";
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
// Update Poll
$('.updatePollBtn').click(function(){
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
			var name = $('#poll_name').val();
			var pollId = $('#poll_id').val();
			var question = $('#pollQuestion').val();
			var url = "conference/updatePoll"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#createPollForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		tinymce.EditorManager.editors = [];
							$('#editArea').html('');
							$('.addPollBtn').show();
							$('#Poll_'+pollId+'').html('');
							$('#Poll_'+pollId+'').append('<div class="list_row dot_bg"><span class="wdt_60 ePoll" datapid='+pollId+'><h3>'+name+'</h3><p>'+question+'</p></span><a href="javascript:;" datapid='+pollId+' class="signal_icon"><i class="fa fa-signal" aria-hidden="true"></i></a><a href="javascript:;" datapid='+pollId+' class="delate_mgs"><i aria-hidden="true" class="fa fa-trash-o"></i></a></div>');
			           		$(window).scrollTop($('#header').offset().top);
			           		// $('.list_row').show();
			           		pollsScript();
			           }
			         });
		})

var description = "<?php echo $poll['Poll']['contents'];?>";
var question = "<?php echo $poll['Poll']['question'];?>";
$('#pollDescription').val(description);
$('#pollQuestion').val(question);

	// Faq editor
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
						$('.tinymce_desc').attr('maxlength', 80);
						$('.inp_counter').html(remainingChar);
                  });
            }
	    });
	// Answer editor
	tinymce.init({
	        selector: '.tinymce',  // change this value according to your HTML
	        menubar: false,
	        theme: 'modern',
	        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
	        setup : function(ed) {
		        	ed.on('change', function () {
			            ed.save();
			        });
            }
	    });
// Multiple choice
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
		$('.answerOnly').append('<div class="input_block"><input type="text" name="answer[]" id="answer_'+nextCharacter+'"><span class="ans_sl">'+nextCharacter+'</span><span class="ans_rl"><i class="fa fa-times removeInput"></i></span></div>');
	})
	function nextChar(c) {
		return String.fromCharCode(c.charCodeAt(0) + 1);
	}
</script>