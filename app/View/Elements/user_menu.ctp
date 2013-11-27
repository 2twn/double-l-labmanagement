<script>  
	$(function() {    $( "#menu" ).menu();  });  
</script>  
<style>  
	.ui-menu { width: 150px; }  
</style>
<div id="cakephp-global-navigation">
<ul id="menu">
	<li><?php echo $this->html->link('組織', '#'); ?>
		<ul>
			<li><?php echo $this->html->link('部門列表', array('controller' => 'users', 'action' => 'dep_list')); ?></li>
			<li><?php echo $this->html->link('人員列表', array('controller' => 'users', 'action' => 'user_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('專案', '#'); ?>
		<ul>
			<li><?php echo $this->html->link('專案列表', array('controller' => 'projects', 'action' => 'prj_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('會議室', '#'); ?>
		<ul>
			<li><?php echo $this->html->link('會議室列表', array('controller' => 'meetingrooms', 'action' => 'mr_list')); ?></li>
		</ul>
	</li>
</ul>
</div>