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
		//echo $this->Html->css('menu');
		echo $this->Html->css('application');
	?>
</head>
<body>
	<div id="container">
		<div id="header" sytle="clear:left; float:left; background: #6494CD; ">
		<table style="border: 0px;padding=0px;margin:0px">
		<tr><td>
		<img src="/lab/img/TLC_Color.jpg" alt="TLC Lab Management" border="0">
		</td><td>
		<?php
			if($this->Session->read('Auth.User'))	{
				echo $this->element($this->Session->read('Auth.User.group_id').'_menu');
			}
		?>
		</td></tr>
		</table>
		</div>