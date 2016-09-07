<div class="edit_content_box">
	<div class="edit_head">
	<a class="cancel cancelMtype" href="javascript:;">- Cancel</a>
	</div>
	<div class="edit_content">
		<div class="input_block">
			<div class="input_row">
				<ul class="slc_module">
					<li class="col_6 active">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="agenda" >Agenda</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="surveys" >Surveys</a>
						</div>
					</li> 
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="maps" >Maps</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="social" >Social</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="notes" >Notes</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="faqs" >FAQs</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="speakers" >Speakers</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="custom" >Custom</a>
						</div>
					</li>
					<li class="col_6">
						<div class="slc_module_type">
							<a href="javascript:void(0)" class="mlChoice" datavalue="polls" >Polls</a>
						</div>
					</li>
				</ul>
			</div>
		</div><!-- /input_block -->

		<div class="edit_footer">
			<div class="input_block">
				<div class="pull-right">
					<button class="button createMbtn" type="submit">Create Module</button>
				</div>

				<!-- <div class="pull-left">
					<button class="button btn_delete" type="submit">Delete Module</button>
				</div> -->
			</div>
		</div>
	</div>
</div><!-- /edit_content_box -->
<script type="text/javascript">
	$('.cancelMtype').click(function(){
		$('.module_content').html('');
		$('.selectMtype').show();
	})
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
	})

	// Create module button
	$('.createMbtn').click(function(){
		if ($('.slc_module').find('.active a').html() == 'Custom') {
				$('.sec_row').html('');
				$('.sec_row').hide();
				$("#loader").attr("style", " ");
				$.post('conference/customMuduleType', {'data': 'attr'}, 
				function(html) {
					$('.sec_row').show();
					$("#loader").css("display","none");
		            $('.sec_row').prepend(html);
		            $("html, body").animate({ scrollTop: $('.edit_content_box').offset().top }, 500);
		         }); 
		} else {
			alert('Not Defined! Please select custom type.');
		}
	})
</script>