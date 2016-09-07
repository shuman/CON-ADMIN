<div class="sec_row">
<div class="alert alert-success" style="display: none;" role="alert"> <strong>Well done!</strong> Data Saved Successfully. </div>
	<div class="sec_title">
		<h2>Push Notification</h2>
		<p>Enter message that will be sent too all users of the app. URLs will act as hyperlinks.</p>
	</div>
	<div class="sec_desc">
		<div class="input_block">
			<textarea class="tinymce_div"></textarea>
		</div><!-- /text_box -->

		<div class="button_sec btn_right">
			<button class="button btn_highlight" id="sendPush">Send Push Notification</button>
		</div>
	</div>
</div><!-- /sec_row -->

<div class="sec_row">
	<div class="sec_title">
		<h2>History</h2>
		<p>Manage past notifications.</p>
	</div>
	<?php if ($notifications): ?>
		<div class="sec_desc" id="hisSection">
			<?php foreach($notifications as $eachNotification): ?>
				<div class="text_box">
					<p><?php echo $eachNotification['Notification']['contents'];?> </p>

					<!-- <a class="delate_mgs" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
				</div><!-- /text_box -->
			<?php endforeach;?>
		</div>
	<?php endif;?>
</div><!-- /sec_row -->
<script type="text/javascript">
	function afteranotification() {
		// Save Send Push
		$('#sendPush').click(function(){
			var content = $('.tinymce_div').val();
			$.ajax({
			           type: "POST",
			           url: 'notification/savePush',
			           data: {'contents': $('.tinymce_div').val()}, // serializes the form's elements.
			           success: function(data)
			           {
			           		$('#hisSection').append('<div class="text_box"><p>'+content+'</p></div>');
			           		$(".alert").show().delay(2000).fadeOut();
			           }
		         });
		})
		$('.sec_row').show();
		$("#loader").css("display","none");
		//tinymce.init({ selector:'.tinymce' });
    tinymce.init({
        selector: '.tinymce',  // change this value according to your HTML
        menubar: false,
        theme: 'modern',
        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
    });

    // tinymce.init({
    //     selector: '.tinymce_div',  // change this value according to your HTML
    //     menubar: false,
    //     theme: 'modern',
    //     toolbar: 'bold italic underline ',
    //     setup: function (editor) {
		  //       editor.on('change', function () {
		  //           editor.save();
		  //       });
		  //   }
    // });
	}
</script>