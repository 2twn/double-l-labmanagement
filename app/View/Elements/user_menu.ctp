<div id="cakephp-global-navigation">
<ul id="menu">
	<li><?php echo $this->html->link('組織', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('部門列表', array('controller' => 'users', 'action' => 'dep_list')); ?></li>
			<li><?php echo $this->html->link('人員列表', array('controller' => 'users', 'action' => 'user_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('專案', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('專案列表', array('controller' => 'projects', 'action' => 'prj_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('會議室', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('會議室列表', array('controller' => 'meetingrooms', 'action' => 'mr_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('儀器管理', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('儀器列表', array('controller' => 'equipments', 'action' => 'equip_list')); ?></li>
			<li><?php echo $this->html->link('儀器預約', array('controller' => 'equipments', 'action' => 'equip_booking')); ?></li>
			<li><?php echo $this->html->link('儀器預約列表', array('controller' => 'equipments', 'action' => 'equip_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('登出', array('controller' => 'users', 'action' => 'logout')); ?>
</ul>
</div>