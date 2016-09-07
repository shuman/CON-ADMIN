<div class="sec_row">
<div class="alert alert-success" style="display: none;" role="alert"> <strong>Well done!</strong> Data Saved Successfully. </div>
	<div class="sec_title">
		<h2><?php echo Inflector::humanize($this->request->params['action']);?></h2>
	</div>
	<form action="javascript:;" id="moduleForm">
	<?php if (isset($savedData)): ?>
		<input type="hidden" name="id" value="<?php echo isset($savedData['ModuleType']['id']) ? $savedData['ModuleType']['id'] : '';?>">
	<?php endif;?>
	<input type="hidden" name="name" value="<?php echo $this->request->params['action'];?>">
		<div class="sec_desc">
			<div class="input_block">
				<textarea class="tinymce_div" name="content"></textarea>
			</div><!-- /text_box -->

			<div class="button_sec btn_right">
				<button class="button btn_highlight" id="saveChanges">Save Changes</button>
			</div>
		</div>
	</form>
</div><!-- /sec_row -->
<script type="text/javascript">
	function entertainmentScript() {
		tinymce.EditorManager.editors = [];
		$('.sec_row').show();
		$("#loader").css("display","none");
	}
	function donateScript() {
		tinymce.EditorManager.editors = [];
		$('.sec_row').show();
		$("#loader").css("display","none");
	}
	function storeScript() {
		tinymce.EditorManager.editors = [];
		$('.sec_row').show();
		$("#loader").css("display","none");
	}
	function foodScript() {
		tinymce.EditorManager.editors = [];
		$('.sec_row').show();
		$("#loader").css("display","none");
	}
	function sponsorsScript() {
		tinymce.EditorManager.editors = [];
		$('.sec_row').show();
		$("#loader").css("display","none");
	}
</script>
<script type="text/javascript">
var description = "<?php echo isset($savedData['ModuleType']['content']) ? $savedData['ModuleType']['content'] : ''; ?>";
$('.tinymce_div').val(description);
// Tinymce
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
// Save data
$('#saveChanges').click(function(){
	var url = "conference/saveModData"; // the script where you handle the form input.
		    $.ajax({
		           type: "POST",
		           url: url,
		           data: $("#moduleForm").serialize(), // serializes the form's elements.
		           success: function(data)
		           {
		           		
		           }
		         });
})
</script>