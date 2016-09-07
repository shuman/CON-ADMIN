<?php 
	$navs = $this->requestAction(array('controller' => 'navigations', 'action' => 'navList'));
	$menus = $this->requestAction(array('controller' => 'navigations', 'action' => 'mainMenuList'));
?>
<div class="conv_left_sidebar">
	<div class="sidebar_block">
		<ul class="side_nav">
			<li class="active">
				<?php echo $this->Js->link('General', ['controller' => 'conference', 'action' => 'index'], ['before' => 'beforeFunction()', 'update' => '.bodyContent']);?>
			</li>
			<li>
				<?php echo $this->Js->link('Push Notifications', ['controller' => 'notification', 'action' => 'push_notification'], ['before' => 'beforeFunction()', 'update' => '.bodyContent', 'complete' => 'afteranotification();']);?>
			</li>
		</ul>
	</div><!-- /sidebar_block -->

	<div class="sidebar_block">
		<h2>Tab Bar Modules</h2>
		<?php if ($menus): ?>
			<ul class="tab_mdl_nav">
				<?php foreach($menus as $key => $eachMenu): $key = $key + 1; ?>
					<li id="Navigation_<?php echo $eachMenu["Navigation"]["id"];?>" class="<?php echo $eachMenu["Navigation"]["status"] == 'inactive' ? 'conv_disable' : '';?>">
						<?php if ($eachMenu["Navigation"]["status"] == 'inactive'): ?>
							<div class="opt_list nodotbg" style="display: none;">
								<?php echo $this->Js->link('<span class="sl_no">'.$key.'</span> <span id="name_'.$eachMenu['Navigation']['id'].'">'.$eachMenu["Navigation"]["name"].'</span>', ['controller' => 'convene', 'action' => $eachMenu['Navigation']['slug']], ['before' => 'beforeFunction()', 'update' => '.bodyContent', 'complete' => Inflector::singularize($eachMenu["Navigation"]["slug"]).'Script();', 'escape' => false]);?>

								<div class="opt_icon">
									<a href="javascript:;"><i class="fa fa-power-off powerOff" datankey="<?php echo $key;?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" datanname="<?php echo $eachMenu["Navigation"]["name"];?>" id="pwOff_<?php echo $eachMenu["Navigation"]["id"];?>" aria-hidden="true"></i></a>
									<a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_<?php echo $eachMenu["Navigation"]["id"];?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" datanname="<?php echo $eachMenu["Navigation"]["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
									<a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_<?php echo $eachMenu["Navigation"]["id"];?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" aria-hidden="true"></i></a>
								</div>
							</div>
							<!-- Showed div when inactive -->
							<div class="opt_list nodotbg" id="dis_<?php echo $eachMenu["Navigation"]["id"];?>">
								<a href="javascript:void(0)" dataNhref="/convene/<?php echo $eachMenu["Navigation"]["slug"]?>" dataNid="<?php echo $eachMenu["Navigation"]["id"];?>"><span class="sl_no"><?php echo $key;?></span> <span id="name_<?php echo $eachMenu["Navigation"]["id"];?>"><?php echo $eachMenu["Navigation"]["name"];?></span></a>

								<div class="opt_icon">
									<a href="javascript:;"><i class="fa fa-power-off powerOn" datankey="<?php echo $key;?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" datanname="<?php echo $eachMenu["Navigation"]["name"];?>" id="pwOff_<?php echo $eachMenu["Navigation"]["id"];?>" aria-hidden="true"></i></a>
									<a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_<?php echo $eachMenu["Navigation"]["id"];?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" datanname="<?php echo $eachMenu["Navigation"]["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
									<a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_<?php echo $eachMenu["Navigation"]["id"];?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" aria-hidden="true"></i></a>
								</div>
							</div>

						<?php else: ?>
							<div class="opt_list nodotbg">
								<?php echo $this->Js->link('<span class="sl_no">'.$key.'</span> <span id="name_'.$eachMenu['Navigation']['id'].'">'.$eachMenu["Navigation"]["name"].'</span>', ['controller' => 'convene', 'action' => $eachMenu['Navigation']['slug']], ['before' => 'beforeFunction()', 'update' => '.bodyContent', 'complete' => Inflector::singularize($eachMenu["Navigation"]["slug"]).'Script();', 'escape' => false]);?>

								<div class="opt_icon">
									<a href="javascript:;"><i class="fa fa-power-off powerOff" datankey="<?php echo $key;?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" datanname="<?php echo $eachMenu["Navigation"]["name"];?>" id="pwOff_<?php echo $eachMenu["Navigation"]["id"];?>" aria-hidden="true"></i></a>
									<a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_<?php echo $eachMenu["Navigation"]["id"];?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" datanname="<?php echo $eachMenu["Navigation"]["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
									<a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_<?php echo $eachMenu["Navigation"]["id"];?>" datanid="<?php echo $eachMenu["Navigation"]["id"];?>" aria-hidden="true"></i></a>
								</div>
							</div>
						<?php endif;?>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif; ?>
	</div><!-- /sidebar_block -->

	<div class="sidebar_block">
		<h2>More Modules</h2>
		<div class="navLoader" style="display: none;"><img src="/img/nav-loader.gif" ></div>
		<?php if (!empty($navs)): ?>
			<ul class="tab_mdl_nav more_mod_drag">
				<?php foreach($navs as $id => $eachNav): $id = $id + 1; ?>
					<li id="Navigation_<?php echo $eachNav['Navigation']['id'];?>" class="<?php echo $eachNav['Navigation']['status'] == 'inactive' ? 'conv_disable' : '';?>">
						<?php if ($eachNav['Navigation']['status'] == 'inactive'): ?>
							<div class="opt_list" style="display: none;">
								<?php echo $this->Js->link('<span class="sl_no">'.$id.'</span> <span id="name_'.$eachNav['Navigation']['id'].'">'.$eachNav['Navigation']['name'].'</span>', ['controller' => 'conference', 'action' => $eachNav['Navigation']['slug']], ['before' => 'beforeFunction()', 'update' => '.bodyContent', 'complete' => $eachNav['Navigation']['slug'].'Script();', 'escape' => false, 'class' => $id]);?>
								<div class="opt_icon">
									<a href="javascript:;"><i class="fa fa-power-off powerOff" datankey="<?php echo $id;?>"  datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav['Navigation']['name'];?>" aria-hidden="true"></i></a>
									<a href="javascript:;"><i class="fa fa-pencil navEdit"  id="ebtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav['Navigation']["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
									<a href="javascript:;"><i class="fa fa-trash-o navDelete"  id="rbtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" aria-hidden="true"></i></a>
								</div>
							</div>

							<!-- Showed Div when inactive -->
							<div class="opt_list" id="dis_<?php echo $eachNav["Navigation"]["id"];?>">
								<a href="javascript:void(0)" dataNhref="/convene/<?php echo $eachNav["Navigation"]["slug"]?>" dataNid="<?php echo $eachNav["Navigation"]["id"];?>"><span class="sl_no"><?php echo $id;?></span> <span id="name_<?php echo $eachNav["Navigation"]["id"];?>"><?php echo $eachNav["Navigation"]["name"];?></span></a>

								<div class="opt_icon">
									<a href="javascript:;"><i class="fa fa-power-off powerOn" datankey="<?php echo $id;?>"  datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav['Navigation']['name'];?>" aria-hidden="true"></i></a>
									<a href="javascript:;"><i class="fa fa-pencil navEdit"  id="ebtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav['Navigation']["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
									<a href="javascript:;"><i class="fa fa-trash-o navDelete"  id="rbtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" aria-hidden="true"></i></a>
								</div>
							</div>
						<?php else: ?>
							<?php if ($eachNav['Navigation']['type'] == 'cus'): ?>
								<div class="opt_list">
								<a href="javascript:;" datacmid="<?php echo $eachNav['Navigation']['custom_module_id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" class="cusNav" ><span class="sl_no"><?php echo $id;?></span> <span id="name_<?php echo $eachNav['Navigation']['id'];?>"><?php echo $eachNav["Navigation"]["name"];?></span></a>								
									<div class="opt_icon">
										<a href="javascript:;"><i class="fa fa-power-off powerOff" datankey="<?php echo $id;?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav["Navigation"]["name"];?>" aria-hidden="true"></i></a>
										<a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav["Navigation"]["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
										<a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" aria-hidden="true"></i></a>
									</div>
								</div>
							<?php else:?>
								<div class="opt_list">
									<?php echo $this->Js->link('<span class="sl_no">'.$id.'</span> <span id="name_'.$eachNav['Navigation']['id'].'">'.$eachNav['Navigation']['name'].'</span>', ['controller' => 'conference', 'action' => $eachNav['Navigation']['slug']], ['before' => 'beforeFunction()', 'update' => '.bodyContent', 'complete' => $eachNav['Navigation']['slug'].'Script();', 'escape' => false, 'class' => $id]);?>
									<div class="opt_icon">
										<a href="javascript:;"><i class="fa fa-power-off powerOff" datankey="<?php echo $id;?>"  datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav['Navigation']['name'];?>" aria-hidden="true"></i></a>
										<a href="javascript:;"><i class="fa fa-pencil navEdit"  id="ebtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" datanname="<?php echo $eachNav['Navigation']["name"];?>" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
										<a href="javascript:;"><i class="fa fa-trash-o navDelete"  id="rbtn_<?php echo $eachNav['Navigation']['id'];?>" datanid="<?php echo $eachNav['Navigation']['id'];?>" aria-hidden="true"></i></a>
									</div>
								</div>
							<?php endif;?>
						<?php endif;?>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>
		<div class="button_sec">
			<?php echo $this->Js->link('+ Add Module', ['controller' => 'conference', 'action' => 'createCustomMudule'], ['before' => 'beforeFunction()', 'update' => '.bodyContent', 'complete' => 'moduleScript();', 'escape' => false]);?>
		</div>
	</div><!-- /sidebar_block -->
</div><!-- /conv_left_sidebar -->

<!-- Modal Area Start -->
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Update Navigation</h4>
	      </div>
	      <div class="modal-body">
	        <form id="navSaveForm" action="javascript:;">
	        	<input type="hidden" class="form-control" name="id" id="nav-mo-id">
	          <div class="form-group">
	            <label for="recipient-name" class="control-label">Name:</label>
	            <input type="text" class="form-control" name="name" id="nav-mo-name">
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="saveUpdateNav">Update</button>
	      </div>
	    </div>
	  </div>
	</div>
<!-- Modal Area End -->

<script type="text/javascript">
	$( ".more_mod_drag" ).sortable({
		change: function(event, ui) {
			var currentPosition = ui.item.index();
			window.currentPosition = currentPosition + 1;
		},
		update: function(event, ui) {
			$('.navLoader').show();
			$('.more_mod_drag').attr("style", "opacity: 0.3");
			var url = "navigations/updateNavigation"; // the script where you handle the form input.
			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $(".more_mod_drag").sortable("serialize"), // serializes the form's elements.
			           success: function(data)
			           {
			           		$('.navLoader').hide();
							$('.more_mod_drag').attr("style", " ");
			           }
			         });
		}
	});
    $( ".more_mod_drag" ).disableSelection();
	function beforeFunction() {
		$('.sec_row').hide();
		$("#loader").attr("style", " ");
	}

	// Navigation power off
	$('.powerOff').click(function(){
		var navKey = $(this).attr('datankey');
		var navId = $(this).attr('datanid');
		var navname = $(this).attr('datanname');
		var ahref = $('#Navigation_'+navId+'').find('a:first').attr('href');
		var aid = $('#Navigation_'+navId+'').find('a:first').attr('id');
		$.post('navigations/updateNav/'+navId,
				function(html) {
					$('#Navigation_'+navId+'').find('div:first').hide();
					$('#Navigation_'+navId+'').addClass('conv_disable');
					$('#Navigation_'+navId+'').append('<div class="opt_list nodotbg" id="dis_'+navId+'"><a href="javascript:void(0)" dataNhref='+ahref+' dataNid='+aid+'><span class="sl_no">'+navKey+'</span> <span id="name_'+navId+'">'+navname+'</span></a><div class="opt_icon"><a href="javascript:;"><i class="fa fa-power-off powerOn" datankey='+navKey+' datanid='+navId+' datanname='+navname+' aria-hidden="true"></i></a><a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_'+navId+'" datanid='+navId+' datanname='+navname+' aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a><a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_'+navId+'" datanid='+navId+' aria-hidden="true"></i></a></div></div>');
					powerOn();
				});
	})

	// Navigation power off
	$('.powerOn').click(function(){
		var navId = $(this).attr('datanid');
		$.post('navigations/updateNavOn/'+navId,
				function(html) {
					$('#Navigation_'+navId+'').removeClass('conv_disable');
					$('#Navigation_'+navId+'').find('div:first').show();
					$('#dis_'+navId+'').remove();
				});
		})

	function powerOn() {
		$('.powerOn').click(function(){
		var navId = $(this).attr('datanid');
		$.post('navigations/updateNavOn/'+navId,
				function(html) {
					$('#Navigation_'+navId+'').removeClass('conv_disable');
					$('#Navigation_'+navId+'').find('div:first').show();
					$('#dis_'+navId+'').remove('');
				});
		})
	}

	// Re-edit / Delete
	function reEdit() {
		var base = window.location.host;
		// Navigation power off
		$('.powerOff').click(function(){
			var navKey = $(this).attr('datankey');
			var navId = $(this).attr('datanid');
			var navname = $(this).attr('datanname');
			var ahref = $('#Navigation_'+navId+'').find('a:first').attr('href');
			var aid = $('#Navigation_'+navId+'').find('a:first').attr('id');
			$.post(base+'/navigations/updateNav/'+navId,
					function(html) {
						$('#Navigation_'+navId+'').addClass('conv_disable');
						$('#Navigation_'+navId+'').html('');
						$('#Navigation_'+navId+'').append('<div class="opt_list nodotbg"><a href="javascript:void(0)" dataNhref='+ahref+' dataNid='+aid+'><span class="sl_no">'+navKey+'</span> <span id="name_'+navId+'">'+navname+'</span></a><div class="opt_icon"><a href="javascript:;"><i class="fa fa-power-off powerOn" datankey='+navKey+' datanid='+navId+' datanname='+navname+' aria-hidden="true"></i></a><a href="javascript:;"><i class="fa fa-pencil navEdit" id="ebtn_'+navId+'" datanid='+navId+' datanname='+navname+' aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a><a href="javascript:;"><i class="fa fa-trash-o navDelete" id="rbtn_'+navId+'" datanid='+navId+' aria-hidden="true"></i></a></div></div>');
						powerOn();
					});
		})

		// Navigation Delete
		$('.navDelete').click(function(){
			var navId = $(this).attr('datanid');
			$.post('navigations/deleteNav/'+navId,
					function(html) {
						$('#Navigation_'+navId+'').hide();
						$('#Navigation_'+navId+'').hide();
					});
		})
	}

	navNedit();

	function navNedit() {
		// Navigation Edit Modal
		$('.navEdit').click(function(){
			var navId = $(this).attr('datanid');
			var navName = $(this).attr('datanname');
			$('#nav-mo-id').val(navId);
			$('#nav-mo-name').val(navName);
		})

		// Nav edit submit
		$('#saveUpdateNav').click(function(){
			var id = $('#nav-mo-id').val();
			var name = $('#nav-mo-name').val();
			var url = "navigations/saveUpdateNav"; // the script where you handle the form input.
				    $.ajax({
				           type: "POST",
				           url: url,
				           data: $("#navSaveForm").serialize(), // serializes the form's elements.
				           success: function(data)
				           {
				           		$('#name_'+id+'').html(name);
				           		$('#ebtn_'+id+'').attr('datanname', name);
				           		$('#text_'+id+'').html(name);
				           		$('#pwOff_'+id+'').attr('datanname', name);
				           		$('.modal').modal('hide');
				           }
				         });
		})
	}


	// Navigation Delete
	$('.navDelete').click(function(){
		var navId = $(this).attr('datanid');
		$.post('navigations/deleteNav/'+navId,
				function(html) {
					$('#Navigation_'+navId+'').hide();
					$('#Navigation_'+navId+'').hide();
				});
	})

	// custom navigation
	$('.cusNav').click(function(){
			var navId = $(this).attr('datanid');
			var customModId = $(this).attr('datacmid');
			$('.bodyContent').html('');
			var url = "conference/customModPage"; // the script where you handle the form input.
				    $.ajax({
				           type: "POST",
				           url: url,
				           data: {'id': customModId}, // serializes the form's elements.
				           success: function(data)
				           {
				           		$('.bodyContent').html(data);
				           }
				         });
		})
	function cusnavupdate() {
		$('.sidebar_block li a').click(function(e) {
		        $('.sidebar_block li').removeClass('active');

		        var $parent = $(this).parent();
		        if (!$parent.hasClass('active') || !$parent.parent().hasClass('active')) {
		            $parent.addClass('active');
		            $parent.parent().addClass('active');
		        }
		        // e.preventDefault();
		    });
		
		$('.cusNav').click(function(){
			var navId = $(this).attr('datanid');
			var customModId = $(this).attr('datacmid');
			$('.bodyContent').html('');
			var url = "conference/customModPage"; // the script where you handle the form input.
				    $.ajax({
				           type: "POST",
				           url: url,
				           data: {'id': customModId}, // serializes the form's elements.
				           success: function(data)
				           {
				           		$('.bodyContent').html(data);
				           }
				         });
		})
	}

</script>