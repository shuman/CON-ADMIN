<?php echo $this->Html->css(array('select2'));?>
<div id="sessionBody" class="edit_content_box add_session">
	<form action="" id="sessionAgendaForm">
	<div class="edit_head">
		<a class="cancel sessionCancel" href="javascript:;">- Cancel</a>
		<div class="edit_title">
			<span class="">
				<?php echo $this->Form->input('has_breakout', ['type' => 'checkbox', 'value' => $session['Session']['has_breakout'], 'label' => 'Session contains breakout groups', 'id' => 'test1', 'class' => 'breakCheck']);?>
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
					<input type="text" name="bhour" pattern="[0-9]" placeholder="" class="bhour"> <span>:</span>
					<input type="text" name="bminute" pattern="[0-9]" placeholder="" class="bminute">
				</div>
				<div class="am_pm">
					<input type="text" name="bam-pm" value="AM">
				</div>
			</div>
		</div><!-- /input_block -->

		<div class="list_container">
		<?php if ($session['Breakout']): ?>
			<?php $inc = 0; foreach($session['Breakout'] as $bkey => $eachBreakout): $inc = $inc + 1;?>
				<div class="list_row dot_bg"><span class="wdt_30"><?php echo $eachBreakout['name'];?></span><input type="hidden" name="breakout[<?php echo $bkey;?>][breakout_id]" value="<?php echo $eachBreakout['breakout_id'];?>"><input type="hidden" name="breakout[<?php echo $bkey;?>][name]" value="<?php echo $eachBreakout['name'];?>"><span class="wdt_45"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $eachBreakout['location'];?></span><span class="wdt_20"><?php echo $eachBreakout['event_time'];?></span><input type="hidden" name="breakout[<?php echo $bkey;?>][time]" value="<?php echo $eachBreakout['event_time'];?>"><a class="delate_mgs deleteBreakout" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
			<?php endforeach;?>
			<input type="hidden" name="none" id="lastId" value="<?php echo $inc;?>">
		<?php endif;?>
		</div><!-- /list_container -->
		<!-- Agenda ID -->
		<div class="hiddenagendavClass">
			<input type="hidden" name="agenda_id" placeholder="" value="hiddenAgendaValue" class="hiddenAgendaId">
		</div>
		<div class="input_block with_time">
			<div class="input_row">
				<div class="col_6">
					<label>Name of Session</label>
					<input type="hidden" name="session_id" value="<?php echo $session['Session']['session_id'];?>">
					<input type="hidden" name="agenda_id" value="<?php echo $session['Session']['agenda_id'];?>">
					<input type="text" name="name" placeholder="" class="" value="<?php echo $session['Session']['name'];?>">
				</div>
				<div class="col_6">
					<label id="location">Location</label>
					<input type="text" name="location" placeholder="" class="" value="<?php echo $session['Session']['location'];?>">
				</div>
			</div>

			<div class="w_p20 input_time">
				<label>Time</label>
				<div class="hh_mm">
					<input type="text" name="hour" placeholder="" class="" value="<?php $time = explode(':', $session['Session']['event_time']); echo $time[0];?>"> <span>:</span>
					<input type="text" name="minute" placeholder="" class="" value="<?php echo $time[1];?>">
				</div>
				<div class="am_pm">
					<input type="text" class="slc_time" name="m" value="<?php echo $session['Session']['m'];?>">
				</div>
			</div>
		</div> 

		<div class="input_block">
			<label>Speaker(s) (Separate multiple speakers by commas)</label>
			<?php echo $this->Form->input('speaker_id', ['type' => 'select', 'multiple' => 'multiple', 'label' => false, 'options' => $speakers, 'value' => array_values($sessionSpeaker), 'id' => 'sp2']);?>
		</div>

		<div class="input_block">
			<label>Session Description</label>
			<textarea class="tinymce" name="remark" ></textarea>
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
		<button class="button createSessionSubmit" type="submit">Update session</button>
	</div>
	</form>
</div><!-- /add_session -->
<?php echo $this->Html->script(array('select2.min'));?>
<script type="text/javascript">
var description = "<?php echo $session['Session']['remark'];?>";
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
	$('.tinymce').val(description);
	$("#sp2").select2();
	// $("#sp2").select2("val", "76");
	// Add Breakout
	window.inc = $('#lastId').val();
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

			    var url = "convene/updateSession"; // the script where you handle the form input.
			    var name = this.name;
			    var location = this.location;
			    var hour = this.hour;
			    var minute = this.minute;
			    var m = this.m;
			    $.ajax({
			    	type: "POST",
			    	url: url,
			           data: $("#sessionAgendaForm").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           	$(".edit_content_box").fadeOut(600, function() { $(this).remove(); });
			           	$(window).scrollTop($('#header').offset().top);
			           	$('#session_'+data+'').append('<div class="list_row"><span class="wdt_30 esession" datasid='+data+'>'+name.value+'</span><span class="wdt_40 esession" datasid='+data+'><i class="fa fa-map-marker" aria-hidden="true"></i> '+location.value+'</span><span class="wdt_30 esession" datasid='+data+'>'+hour.value+':'+minute.value+'	</span><a class="delate_mgs" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>');
			           	$('.button_sec').show();
			           	$('.addSession').show();
			           	agendaScript();
			               // alert(data); // show response from the php script.
			           }
			       });

			    e.preventDefault(); // avoid to execute the actual submit of the form.
			});
		})
</script>