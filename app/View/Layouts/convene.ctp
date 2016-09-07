<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PWI Convene</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Fevicon -->
	<link rel="icon" href="favicon.png" type="png" />

	<!-- stylesheet Start-->
	<?php echo $this->Html->css(array('bootstrap', 'jquery-ui', 'animate', 'font-awesome', 'style', 'responsive', 'colorpicker', 'select2'));?>
	<!-- stylesheet End-->
	<?php echo $this->Html->script(array('jquery-1.11.1', 'jquery-ui.min', 'bootstrap', 'wow.min', 'tinymce/tinymce.min', 'colorpicker', 'custom'));?>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
	<script src="http://malsup.github.com/jquery.form.js"></script> 

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.js"></script>
	<![endif]-->
</head>

<body class="convene">
	<header id="header">
		<div class="container">
			<div class="logo_conv">
				<a class="conv_icon" href="index.html"></a>
				<div class="conv_text"><span>Convene</span> | the conference app</div>
			</div>
			<div class="signup">
				<a class="conv_logout" href="#">Logout</a>
			</div>
		</div>
	</header><!-- /header -->

	<section class="main_content sec_block">
		<div class="container">
			<div class="dash_content">
				<!-- Left Navigation start-->
				<?php echo $this->element('left-nav');?>
				<!-- Left Navigation end-->

				<div class="conv_container" id="mainContentArea">
				<div id="loader" class="loader" style="display: none;">
					<?php echo $this->Html->image('loader.gif', ['height' => '60px', 'width' => '60px']);?>
				</div>
					<!-- Content body area start -->
					<?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                    <div class="bodyContent">
                    	<?php echo $this->fetch('content'); ?>
                    </div>
					<!-- Content body area end -->
				</div><!-- /conv_container -->
			</div>
		</div>
	</section><!-- /main_content -->

	<footer class="footer">
		<div class="container">
			<div class="save_doc" style="display: none;">
				<div class="save_change">Save changes</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="conv_text"><span>Convene</span> | the conference app</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Javascript area start here -->
	
	<script type="text/javascript">
		$(document).ready(function () {
		    $('.sidebar_block li a').click(function(e) {
		        $('.sidebar_block li').removeClass('active');

		        var $parent = $(this).parent();
		        if (!$parent.hasClass('active') || !$parent.parent().hasClass('active')) {
		            $parent.addClass('active');
		            $parent.parent().addClass('active');
		        }
		        // e.preventDefault();
		    });
		});
	</script>
	<!-- Javascript area end here -->
	<?php echo $this->Js->writeBuffer();?>
</body>
</html>