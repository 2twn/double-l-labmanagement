<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery-1.9.1'); // Include jQuery library
		echo $this->Html->script('jquery-ui-1.10.3.custom');
		echo $this->Html->css('cupertino/jquery-ui-1.10.3.custom');
		echo $this->Html->css('menu');
	?>
</head>
<body>
	<div id="container">
		<div id="header" sytle="clear:left; float:left; background: #6494CD; ">
		<?php
			if($this->Session->read('Auth.User'))	{
				echo $this->element($this->Session->read('Auth.User.group_id').'_menu');
			}
		?>
		</div>