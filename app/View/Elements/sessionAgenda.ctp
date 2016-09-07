<?php echo $this->Html->css(array('select2'));?>
<div id="sessionBody" class="edit_content_box add_session">
	<form action="" id="sessionAgendaForm">
	<div class="edit_head">
		<a class="cancel sessionCancel" href="javascript:;">- Cancel</a>
		<div class="edit_title">
			<span class="">
				<?php echo $this->Form->input('has_breakout', ['type' => 'checkbox', 'label' => 'Session contains breakout groups', 'id' => 'test1', 'class' => 'breakCheck']);?>
			</span>
		</div>
	</div>

	<div class="edit_content">
		<div class="input_block with_time breakoutInput" style="display: none;">
			<div class="input_row">
				<div class="col_6">
					<label>Name of Breakout</label>
					<input type="text" name="session" placeholder="" class="breakoutName">
				</div>
				<div class="col_6">
					<label id="location">Location</label>
					<input type="text" name="location" placeholder="" class="breakOutLocation">
				</div>
			</div>

			<div class="w_p20 input_time">
				<label>Time</label>
				<div class="hh_mm">
					<input type="text" name="bhour" placeholder="" class="bhour"> <span>:</span>
					<input type="text" name="bminute" placeholder="" class="bminute">
				</div>
				<div class="am_pm">
					<input type="text" name="bam-pm" value="AM">
				</div>
			</div>
		</div><!-- /input_block -->

		<div class="list_container">

		</div><!-- /list_container -->
		<!-- Agenda ID -->
		<div class="hiddenagendavClass">
		</div>
		<div class="input_block with_time">
			<div class="input_row">
				<div class="col_6">
					<label>Name of Session</label>
					<input type="text" name="name" placeholder="" class="">
				</div>
				<div class="col_6">
					<label id="location">Location</label>
					<input type="text" name="location" placeholder="" class="">
				</div>
			</div>

			<div class="w_p20 input_time" style="width: 117px;">
				<label>Time</label>
				<input type="time" name="event_time" value="08:30:00" id="eTime" formnovalidate>
			</div>
		</div> 

		<div class="input_block">
			<label>Speaker(s) (Separate multiple speakers by commas)</label>
			<?php echo $this->Form->input('speaker_id', ['type' => 'select', 'multiple' => 'multiple', 'label' => false, 'options' => $speakers, 'id' => 'sp2']);?>
		</div>

		<div class="input_block">
			<label>Session Description</label>
			<textarea class="tinymce" name="remark"></textarea>
		</div>

		<!-- <div class="input_block pad_b20">
			<div class="pull-left">
				<button class="button btn_delete">Delete Breakout Group</button>
			</div>
			<div class="pull-right">
				<button class="button btn_save">Save Edits to Breakout Group</button>
			</div>
		</div> -->

		<div class="button_sec addBreakoutDiv" style="display: none;">
			<a href="javascript:;" class="addBreakOut">Add Breakout</a>
		</div>
	</div>
	<div class="edit_footer">
		<button class="button createSessionSubmit" type="submit">Create session</button>
	</div>
	</form>
</div><!-- /add_session -->
<?php echo $this->Html->script(array('select2.min'));?>
<script type="text/javascript">
	$("#sp2").select2();
	// Editor Initialize
	// tinymce.init({
	//         selector: '.tinymce',  // change this value according to your HTML
	//         menubar: false,
	//         theme: 'modern',
	//         toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
	//         setup : function(ed) {
	// 	        	ed.on('change', function () {
	// 		            ed.save();
	// 		        });
 //            }
	//     });
	// Add Breakout
	window.inc = 1;
		$('.addBreakOut').click(function(){
			var bName = $(this).parent().parent().find('.breakoutName').val();
			var location = $(this).parent().parent().find('.breakOutLocation').val();
			var hour = $(this).parent().parent().find('.bhour').val();
			var min = $(this).parent().parent().find('.bminute').val();
			$(this).parent().parent().find('.list_container').append('<div class="list_row dot_bg"><span class="wdt_30">'+bName+'</span><input type="hidden" name="breakout['+inc+'][name]" value='+bName+'><span class="wdt_45"><i class="fa fa-map-marker" aria-hidden="true"></i> '+location+'</span><span class="wdt_20">'+hour+':'+min+' p.m.</span><input type="hidden" name="breakout['+inc+'][time]" value='+hour+':'+min+'><a class="delate_mgs deleteBreakout" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>');
			window.inc = inc + 1;
		})
	// Delete Breakout
		$('.list_container').on('click', '.deleteBreakout', function() {
			$(this).parent().remove()
		})
	// Create session form submit
		$('.createSessionSubmit').click(function(){
			var submitLocation = $(this);
			$("#sessionAgendaForm").submit(function(e) {
				var agendaId = $('.hiddenAgendaId').val();
			    var url = "convene/saveSession"; // the script where you handle the form input.
			    var name = this.name;
			    var location = this.location;
			    var e_time = $('#eTime').val();
			    $.ajax({
			    	type: "POST",
			    	url: url,
			           data: $("#sessionAgendaForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           	$(".edit_content_box").fadeOut(600, function() { $(this).remove(); });
			           	$(window).scrollTop($('#header').offset().top);
			           	$('#agn_'+agendaId+'').append('<li id="session_'+data+'"><div class="list_row"><span class="wdt_30 esession" datasid='+data+'>'+name.value+'</span><span class="wdt_40 esession" datasid='+data+'><i class="fa fa-map-marker" aria-hidden="true"></i> '+location.value+'</span><span class="wdt_30 esession" datasid='+data+'>'+e_time+'	</span><a class="delate_mgs deleteSession" datasid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></li>');
			           	$('.button_sec').show();
			           	agendaScript();
			               // alert(data); // show response from the php script.
			           }
			       });

			    e.preventDefault(); // avoid to execute the actual submit of the form.
			});
		})
</script>