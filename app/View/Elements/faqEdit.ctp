<div class="edit_content_box">
	<div class="edit_head">
	<a class="cancel cancelFaq" href="javascript:void(0)">- Cancel</a>
	</div>
	<div class="edit_content">
	<form action="javascript:;" id="addFaqForm">
		<div class="input_block">
			<label>FAQ (Enter a frequently asked question in relation to your conference)</label>
			<input type="hidden" name="faq_id" value="<?php echo $faq['Faq']['faq_id'];?>">
			<textarea class="tinymce_div" id="faqInputId" name="faq"></textarea>
		</div>

		<div class="input_block">
			<label>Answer </label>
			<textarea class="tinymce" id="ansInputId" name="answer"></textarea>
		</div>

		<div class="edit_footer">
			<div class="input_block">
				<div class="pull-right">
					<button class="button createFaqSubBtn" type="submit">Update faq</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<script type="text/javascript">
var faq = "<?php echo $faq['Faq']['faq'];?>";
var answer = "<?php echo $faq['Faq']['answer'];?>";
$('.tinymce_div').val(faq);
$('.tinymce').val(answer);
	// Faq editor
	tinymce.init({
	        selector: '.tinymce_div',  // change this value according to your HTML
	        menubar: false,
	        theme: 'modern',
	        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
	        setup : function(ed) {
		        	ed.on('change', function () {
			            ed.save();
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
	// delete
	$('.cancelFaq').click(function(){
				tinymce.EditorManager.editors = [];
				$(this).parent().parent().remove();
				$('#editArea').html('');
				$('.addFabBtn').show();
				$('.list_row').show();
			})
	
	$('.createFaqSubBtn').click(function(){
				var faq = $('#faqInputId').val();
				$.ajax({
					type: "POST",
					url: 'conference/saveFaq',
		            data: $('#addFaqForm').serialize(), // serializes the form's elements.
		            beforeSend: function() {
		            	
		            },
		            success: function(data)
		            {
		            	$('#Faq_'+data+'').html('');
		            	$('#Faq_'+data+'').append('<li id="Faq_'+data+'" class="ui-sortable-handle"><div class="list_row dot_bg"><span class="wdt_90 efaq" datafid='+data+'><div class="srv_qus"><span class="sl slsls">2</span><p></p><p>'+faq+'</p><p></p></div></span><a class="delate_mgs" datafid='+data+' href="javascript:void(0)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><!-- /list_row --></li>');
		            	tinymce.EditorManager.editors = [];
		            	$('.addFabBtn').show();
		            	$('.sl').each(function(i, obj) {
    						$(obj).html(i+1);
						});
		            	faqsScript();
		            	
		            }
		        });
			})
</script>