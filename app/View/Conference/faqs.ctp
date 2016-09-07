<div class="sec_row">
	<div class="sec_title">
		<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
		<p>Create an FAQ page to communicate basic information to users.</p>
	</div>
	<div class="sec_desc">
		<div class="faq_content">
			<?php if (!empty($faqs)): ?>
				<div class="faqLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
				<div class="list_container">
				<div id="editArea">
					
				</div>
					<ul id="faqListDrag">
						<?php $count = 1; foreach($faqs as $eachFaq): ?>
							<li id="Faq_<?php echo $eachFaq['Faq']['faq_id'];?>">
								<div class="list_row dot_bg">
									<span class="wdt_90 efaq" datafid="<?php echo $eachFaq['Faq']['faq_id'];?>">
										<div class="srv_qus">
											<span class="sl slsls"><?php echo $count; $count = $count + 1;?></span>
											<p><?php echo $eachFaq['Faq']['faq'] ? strlen($eachFaq['Faq']['faq']) > 50 ? substr($eachFaq['Faq']['faq'], 0, 50) : $eachFaq['Faq']['faq'] : '';?></p>
										</div>
									</span>
									<a class="delate_mgs" datafid="<?php echo $eachFaq['Faq']['faq_id'];?>" href="javascript:void(0)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div><!-- /list_row -->
							</li>
						<?php endforeach;?>
					</ul>
			</div>
		<?php endif;?>
		<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="60" width="60"></div>
		<div id="createFaqArea">
			
		</div>
		<div class="button_sec pad_b20">
			<a class="text_upc addFabBtn" href="javascript:;">+  Add FAQ</a>
		</div>
	</div><!-- /faq_content -->
</div>
</div>
<script type="text/javascript">
	function faqsScript() {
		// Text edit from navigation
		navNedit();
		// Edit Faq
		$('.efaq').unbind().click(function(){
			// Remove previous one
			$('.edit_content_box').remove();
			$('.list_row').show();

			$(this).parent().hide();
			var datafid = $(this).attr('datafid');
			$.post('conference/faqedit/'+$(this).attr('datafid'),
				function(html) {
					$('.faqLoader').hide();
					$('.addFabBtn').hide();
					$('#Faq_'+datafid+'').append(html);
	         });
		})
		// Drag and drop
	    $( "#faqListDrag" ).sortable({
		change: function(event, ui) {
			var currentPosition = ui.item.index();
			window.currentPosition = currentPosition + 1;
		},
		update: function(event, ui) {
			$('.faqLoader').show();
			$('#faqListDrag').attr("style", "opacity: 0.3");
			var url = "conference/updateFaqList"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#faqListDrag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           		$('.faqLoader').hide();
							$('#faqListDrag').attr("style", " ");
							// Resequence Number
		            		$('.slsls').each(function(i, obj) {
	    						$(obj).html(i+1);
							});
			           }
			         });
		}
		});
    	$( "#faqListDrag" ).disableSelection();
    	// end drag
		// Delete Faq
		$('.delate_mgs').click(function(){
			var parentDiv = $(this).parent();
			var faqId = {'id': $(this).attr('datafid')};
			$.ajax({
				type: "POST",
				url: 'conference/deleteFaq',
		            data: {'contentJson': faqId}, // serializes the form's elements.
		            beforeSend: function() {
		            	parentDiv.css('background-color', '#F2DEDE');
		            },
		            success: function(data)
		            {
		            	parentDiv.slideUp(600,function() {
		            		parentDiv.remove();
		            		$('.slsls').each(function(i, obj) {
	    						$(obj).html(i+1);
							});
		            	});
		            }
		        });
		})
		// Hide Spinn
		$('.sec_row').show();
		$("#loader").css("display","none");

		// Add faq data
		$('.addFabBtn').click(function(){
			$('.addFabBtn').hide();
			$('.agLoader').show();
			$.post('conference/createFaqElement', {'tweet': 'feep feep feep'}, 
				function(html) { 
					$('.agLoader').hide();
					$('#createFaqArea').prepend(html);
					removeFaq();
					afterAppendFun();
				}); 
		})
		// Remove or cancel faq
		function removeFaq() {
			
		}
		// After Append function
		function afterAppendFun() {
			
		}
	}
</script>