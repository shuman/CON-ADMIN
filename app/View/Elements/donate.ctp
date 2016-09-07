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
	<div class="sec_desc">
		<div class="text_box">
			<p>Cras quis nulla commodo, aliquam lectus sed, blandit augue. Cras ullamcorper bibendum bibendum. Duis tincidunt urna non pretium porta. </p>

			<a class="delate_mgs" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
		</div><!-- /text_box -->

		<div class="text_box">
			<p>Donec facilisis tortor ut augue lacinia, at viverra est semper. Sed sapien metus, scelerisque nec pharetra id, tempor a tortor. Pellentesque non dignissim neque. Ut porta viverra est, ut dignissim elit elementum ut. Nunc vel rhoncus nibh, ut tincidunt turpis. Integer ac enim pellentesque, adipiscing metus id, pharetra odio. Donec bibendum nunc sit amet tortor scelerisque luctus et sit amet mauris. </p>

			<a class="delate_mgs" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
		</div><!-- /text_box -->

		<div class="text_box">
			<p>Donec facilisis tortor ut augue lacinia, at viverra est semper. Sed sapien metus, scelerisque nec pharetra id, tempor a tortor. Pellentesque non dignissim neque. Ut porta viverra est, ut dignissim elit elementum ut.</p>

			<a class="delate_mgs" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
		</div><!-- /text_box -->
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	function afteranotification() {
		// Save Send Push
		$('#sendPush').click(function(){
			$.ajax({
			           type: "POST",
			           url: 'notification/savePush',
			           data: {'contents': $('.tinymce_div').val()}, // serializes the form's elements.
			           success: function(data)
			           {
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

    tinymce.init({
        selector: '.tinymce_div',  // change this value according to your HTML
        menubar: false,
        theme: 'modern',
        toolbar: 'bold italic underline ',
        setup: function (editor) {
		        editor.on('change', function () {
		            editor.save();
		        });
		    }
    });
	}
</script>