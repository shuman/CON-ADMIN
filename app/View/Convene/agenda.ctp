<div class="sec_row">
	<div class="sec_title">
		<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
		<p>Create events to your conference</p>
	</div>
	<div class="sec_desc">
		<div class="agenda_day">
			<div class="box_accordian">
				<?php if ($agendas): ?>
					<?php foreach($agendas as $eachAgenda): ?>
						<div class="box_acd_title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent=".box_accordian" href="#<?php echo $eachAgenda['Agenda']['agenda_id'];?>">
								<span class="agenda_date"><?php echo $this->Time->nice($eachAgenda['Agenda']['event_day']);?></span>
								<span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span>
								<a class="delate_mgs deleteDay" dataaid="<?php echo $eachAgenda['Agenda']['agenda_id'];?>" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</a>
						</div><!-- /box_acd_title -->
						<div id="<?php echo $eachAgenda['Agenda']['agenda_id'];?>" class="panel-collapse collapse">
							<div class="box_acd_content">
							<!-- <div id="editArea">
								
							</div>
							<div class="sessionLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div> -->
								<ul id="agn_<?php echo $eachAgenda['Agenda']['agenda_id'];?>">
									<?php if (!empty($eachAgenda['Session'])): ?>
									<?php foreach($eachAgenda['Session'] as $eashSession): ?>
										<?php if ($eashSession['deleted'] != 1): ?>
											<li id="session_<?php echo $eashSession['session_id'];?>">
												<div class="list_row">
												<span class="wdt_30 esession" datasid="<?php echo $eashSession['session_id'];?>"><?php echo $eashSession['name'] ? $eashSession['name']: 'N/A'; ?></span>
												<span class="wdt_40 esession" datasid="<?php echo $eashSession['session_id'];?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $eashSession['location'] ? $eashSession['location']: 'N/A'; ?></span>
												<span class="wdt_30 esession" datasid="<?php echo $eashSession['session_id'];?>"><?php echo $eashSession['event_time'] ? $eashSession['event_time']: 'N/A'; ?>	</span>
												<a class="delate_mgs deleteSession" datasid="<?php echo $eashSession['session_id'];?>" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</div>
											</li>
										<?php endif;?>
									<?php endforeach;?>
								<?php endif;?>
								</ul>

								<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
								<div class="button_sec">
									<a href="javascript:;" dataId="<?php echo $eachAgenda['Agenda']['agenda_id'];?>" class="addSession">+  Add session</a>
								</div>
								<div class="sessionArea">

								</div>

							</div><!-- /box_acd_content -->
						</div>
					<?php endforeach;?>
				<?php endif;?>

				<!-- <div class="button_sec pad_tb20">
					<a href="javascript:;" id="aaa">+  Add Day</a>
				</div> -->

			</div><!-- /box_accordian -->
			<div id="addDayArea">
				
			</div>
			</div>
			<!-- <div class="input_block">
				<div class='input-group date' id='datetimepicker3'>
					<input id="agenda_date" type='text' name="calendar" placeholder="Select a date" value="" style="display: none;" />
				</div>
			</div> -->
			<div class="button_sec pad_tb20 adbtnarea">
				<a href="javascript:;" class="addNday" id="addDayButton">+  Add Day</a>
			</div>
		</div><!-- /agenda_day -->
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	function agendaScript(){
		// Text edit from navigation
		navNedit();
		// Edit Session
		$('.esession').click(function(){{
			$(this).parent().hide();
			$('.addSession').hide();
			var sessionId = $(this).attr('datasid');
			$('.sessionLoader').show();
			$.post('convene/sessionEdit/'+$(this).attr('datasid'),
				function(html) {
					$('.sessionLoader').hide();
					$('#session_'+sessionId+'').append(html);
					removeSession();
					changeInside();
	         }); 
		}})
		// Delete Day
		$('.deleteDay').click(function(){
			var parentDiv = $(this).parent();
			var contentJson = {'id': $(this).attr('dataaid')};
			$.ajax({
			    	type: "POST",
			    	url: 'convene/deleteAgenda',
		            data: {'contentJson': contentJson}, // serializes the form's elements.
		            beforeSend: function() {
								parentDiv.css('background-color', '#F2DEDE');
							},
			        success: function(data)
			           {
			               parentDiv.slideUp(600,function() {
										parentDiv.remove();
									});
			           }
			       });
		})
		$('.sec_row').show();
		$("#loader").css("display","none");
		
		// $('#addDayButton').click(function(){
		// 	$('#addDayButton').hide();
		// 	$('#agenda_date').show();
		// 	$('#agenda_date').datepicker().on('changeDate', function(ev){
		// 						var newDate = ev.date;
		// 						console.log(ev);
		// 						// return false;
		// 					    $.ajax({
		// 					    	type: "POST",
		// 					    	url: 'convene/addDay',
		// 					           data: {'date': ev.date}, // serializes the form's elements.
		// 					           success: function(data)
		// 					           {
		// 					           	$('#agenda_date').datepicker('hide');
		// 					           	$(".edit_content_box").fadeOut(600, function() { $(this).remove(); });
		// 					           	$(window).scrollTop($('#header').offset().top);
		// 					           	$('.box_accordian').prepend('<div class="box_acd_title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".box_accordian" href="#'+data+'"><span class="agenda_date">'+newDate+'</span><span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span></a><a class="delate_mgs deleteDay" dataaid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><div id='+data+' class="panel-collapse collapse" style="height: 0px;"><div class="box_acd_content"><ul id="agn_'+data+'"></ul><div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div><div class="button_sec"><a href="javascript:;" dataid='+data+' class="addSession">+  Add session</a></div><div class="sessionArea"></div></div><!-- /box_acd_content --></div>').fadeIn('slow');
		// 					           	$('#addDayButton').show();
		// 								$('#agenda_date').hide();
		// 								agendaScript();
		// 					               // alert(data); // show response from the php script.
		// 					           }
		// 					       });
		// 					  });
		// 				$('#agenda_date').click();
		// })
		
		$('.addNday').click(function(){
			$('.addNday').remove();
			$('#addDayArea').append('<input id="n_agenda_date" type="text" name="calendar" placeholder="Select a date" value="" style=""><div class="button_sec pad_tb20"><a href="javascript:;" id="saveDayButton"><i class="fa fa-save"></i>  Save Day</a>');
			$( "#n_agenda_date" ).datepicker({
				dateFormat: "yy-mm-dd"
			});
			agendaScript();
		})

		// Save New Day
		$('#saveDayButton').click(function(){
			var day = $('#n_agenda_date').val();
			$.ajax({
			    	type: "POST",
			    	url: 'convene/addDay',
			           data: {'date': day},
			           success: function(data)
			           {
			           		$('.box_accordian').prepend('<div class="box_acd_title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".box_accordian" href="#'+data+'"><span class="agenda_date">'+day+'</span><span class="right_arrow"><i class="indicator fa fa-angle-down" aria-hidden="true"></i></span></a><a class="delate_mgs deleteDay" dataaid='+data+' href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><div id='+data+' class="panel-collapse collapse" style="height: 0px;"><div class="box_acd_content"><ul id="agn_'+data+'"></ul><div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div><div class="button_sec"><a href="javascript:;" dataid='+data+' class="addSession">+  Add session</a></div><div class="sessionArea"></div></div><!-- /box_acd_content --></div>').fadeIn('slow');
			           		$('.adbtnarea').append('<a href="javascript:;" class="addNday" id="addDayButton">+  Add Day</a>');
							$('#addDayArea').html('');
							$("#n_agenda_date").datepicker("destroy");
							agendaScript();
			           }
			       });
		})

	// Append Agenda Session
	$('.addSession').click(function(){
		$(this).parent().hide();
		$('.agLoader').show();
		// spiner between response
		$('.sessionArea').append('Loading....');
		var agendaId = $(this).attr('dataid');
		var sLocation = $(this).parent().next('.sessionArea');
		$.post('convene/sessionElement', {'tweet': 'feep feep feep'}, 
			function(html) {
				$('.agLoader').hide();
				$('.sessionArea').html('');
				var $result = $(html);
				$result.find( '.hiddenagendavClass' ).html('');
				$result.find( '.hiddenagendavClass' ).html('<input type="hidden" name="agenda_id" placeholder="" value='+agendaId+' class="hiddenAgendaId">');
				$result.appendTo(sLocation);

             // sLocation.prepend(html); 
             removeSession();
             changeInside();
         }); 
	})
	function removeSession() {
		$('.sessionCancel').bind( "click", function(){
			$(this).parent().parent().parent().remove();
			$('.button_sec').show();
			$('.list_row').show();
			$('.addSession').show();
		});
	}
	function changeInside() {
		$('.agendaTime').datepicker({format: 'HH:mm',
			pickDate: false,
			pickSeconds: false,});
		// Checked has breakout
		$('.breakCheck').change(function(){
			if ($(".breakCheck").is(':checked')) {
				$(this).parent().parent().parent().parent().next('div').find('.breakoutInput').show();
				$(this).parent().parent().parent().parent().next('div').find('.addBreakoutDiv').show();
			} else {
				$(this).parent().parent().parent().parent().next('div').find('.breakoutInput').hide();
				$(this).parent().parent().parent().parent().next('div').find('.addBreakoutDiv').hide();
			}
		})
		
		// Tinymce editor
		// tinymce.init({
		//   selector: '.tinymce_desc',  // change this value according to your HTML
		//   menubar: false,
		//   theme: 'modern',
		//   toolbar: 'bold italic underline | bullist numlist outdent indent | link image | '
		// });
		
	}

	$('.deleteSession').click(function(){
		var parentDiv = $(this).parent();
		var contentJson = {'id': $(this).attr('datasid')};
		$.ajax({
		    	type: "POST",
		    	url: 'convene/deleteSession',
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
</script>