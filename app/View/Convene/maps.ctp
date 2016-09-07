<div class="sec_row">
	<div class="sec_title">
		<h2><span id="text_<?php echo $navigation['Navigation']['id'];?>"><?php echo $navigation['Navigation']['name'];?></span> <a href="javascript:;"><i class="fa fa-pencil navEdit" datanid="<?php echo $navigation['Navigation']['id'];?>" datanname="<?php echo $navigation['Navigation']['name'];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a></h2>
		<p>Add maps of your conference to help users travel from one event to another</p>
	</div>
	<div class="sec_desc">
		<div class="maps_content">
			<div class="map_lists">
				<div id="editArea">
					
				</div>
				<div class="surveyLoader" style="display: none; text-align: center;"><img src="/img/nav-loader.gif" height="100" width="200"></div>
				<ul id="mapListDrag">
					<?php if (!empty($maps)): ?>
					<?php foreach($maps as $eachMap): ?>
						<li id="Map_<?php echo $eachMap['Map']['map_id'];?>">
							<div class="list_row dot_bg">
							<span class="map_title emap" datamid="<?php echo $eachMap['Map']['map_id'];?>"><?php echo $eachMap['Map']['name'] ? $eachMap['Map']['name']: 'N/A';?></span>
							<a class="delate_mgs" datamapid="<?php echo $eachMap['Map']['map_id'];?>" href="javascript:;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						</div>
						</li>
					<?php endforeach;?>
				<?php endif;?>
				</ul>
			</div>
			<div class="agLoader" style="display: none;"><img src="/img/loader.gif" height="30" width="30"></div>
			<div class="createMapArea" id="createMapArea">
				
			</div>

			<div class="button_sec" id="addBtnArea">
				<a href="javascript:;" class="addMap" id="addNewMap">+  Add Map</a>
			</div>

		</div><!-- /maps_content -->
	</div>
</div><!-- /sec_row -->
<script type="text/javascript">
	function mapScript() {
		// Text edit from navigation
		navNedit();
		// Edit Map\
		$('.emap').unbind().click(function(){
			$('.edit_content_box').remove();
			$('.list_row').show();
			$('.addMap').hide();
			$(this).parent().hide();
			var mapId = $(this).attr('datamid');
			$.post('convene/mapedit/'+$(this).attr('datamid'),
				function(html) {
					$('.mapLoader').hide();
					$('#Map_'+mapId+'').append(html);
					removeCreateMap();
	         });
		})
		// Drag and drop
	    $( "#mapListDrag" ).sortable({
		change: function(event, ui) {
			var currentPosition = ui.item.index();
			window.currentPosition = currentPosition + 1;
		},
		update: function(event, ui) {
			$('.mapLoader').show();
			$('#mapListDrag').attr("style", "opacity: 0.3");
			var url = "convene/updateMapList"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#mapListDrag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           		$('.mapLoader').hide();
							$('#mapListDrag').attr("style", " ");
			           }
			         });
		}
		});
    	// $( "#mapListDrag" ).disableSelection();
    	// $( "#mapListDrag" ).sortable().disableSelection();
    	$('#mapListDrag').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
		      event.stopImmediatePropagation();
		})
    	// end drag

		$('.sec_row').show();
		$("#loader").css("display","none");
		// Delete Map
		 $('.delate_mgs').click(function(){
		 	var parentDiv = $(this).parent();
			var contentJson = {'id': $(this).attr('datamapid')};
			$.ajax({
				    	type: "POST",
				    	url: 'convene/deleteMap',
			            data: {'contentJson': contentJson}, // serializes the form's elements.
			            beforeSend: function() {
							parentDiv.css('background-color', '#fb6c6c');
						},
				        success: function(data)
				           {
				           		parentDiv.slideUp(600,function() {
									parent.remove();
								});
				           }
			       });
		 })
		$('#addNewMap').click(function(){
			$('#addNewMap').hide();
			$('.agLoader').show();
			$.post('convene/createMapElement', {'tweet': 'feep feep feep'}, 
			function(html) { 
				$('.agLoader').hide();
	             $('.createMapArea').append(html);
	             removeCreateMap();
	             createMapFun();
	         }); 
		})
	}
	// Remove Create Map
	function removeCreateMap() {
		$('.cancelCreateMap').click(function(){
			$('.edit_content_box').remove();
			$('#editArea').html('');
			$('#addNewMap').show();
			$('.list_row').show();
		})
	}
	// Create Map Function
	function createMapFun() {
		
	}
</script>