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
		echo $this->Html->script('jquery.blockUI.js');
		echo $this->Html->css('cupertino/jquery-ui-1.10.3.custom');
		echo $this->Html->css('menu');	
		echo $this->Html->css('application');
		echo $this->Html->css('report.table');
	?>
</head>
<body>
	<div id="container" style="background: #FFFFFF; width: 1366px; 	height: 768px;">
		<div id="header" sytle="clear:left; float:left; background: #6494CD; ">
				<?php
			if($this->Session->read('Auth.User'))	{
				echo $this->Html->link(
					$this->Html->image('TLC_Chinese_H_Color.jpg', array('alt' => 'TLC Lab Management', 'border' => '0','width'=>'200'))
					, '/', array('escape' => false));
				echo '<br>';
				//echo $this->element($this->Session->read('Auth.User.group_id').'_menu');
				echo $this->element('menu');
				//echo '<div style="text-align">';
				echo '<div style="position: absolute; top : 10px; right : 10px;">';
				echo '<ul id="menu"><li style="background: #FFFFFF">';
				echo $this->html->tag('span',$this->Session->read('Auth.User.name'), 
					array('style'=>'
						font-size: 16px;
						font-weight: 700;
						color: #000000; 
						height: 23px;
						padding: 8px 5px 0;
						text-align: center;
						margin-right: 8px;
						display: block;'));
				echo '</li><li>';
				echo $this->html->link('登出', array('controller' => 'users', 'action' => 'logout')); 
				echo '</li></ul></div>';
			}
		?>		

		</div>