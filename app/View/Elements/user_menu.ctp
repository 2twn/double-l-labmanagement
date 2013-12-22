<div id="cakephp-global-navigation">
<ul id="menu">
	<li><?php echo $this->html->link('組織管理', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('部門資訊', array('controller' => 'users', 'action' => 'dep_list')); ?></li>
			<li><?php echo $this->html->link('員工資訊', array('controller' => 'users', 'action' => 'user_list')); ?></li>
			<li><?php echo $this->html->link('專案資訊', array('controller' => 'projects', 'action' => 'prj_list')); ?></li>
			<li><?php echo $this->html->link('會議室資訊', array('controller' => 'meetingrooms', 'action' => 'mr_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('儀器管理', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('儀器列表', array('controller' => 'equipments', 'action' => 'equip_list')); ?></li>
			<li><?php echo $this->html->link('儀器預約', array('controller' => 'equipments', 'action' => 'equip_booking_action')); ?></li>
			<li><?php echo $this->html->link('儀器預約列表', array('controller' => 'equipments', 'action' => 'equip_book_list')); ?></li>
			<li><?php echo $this->html->link('儀器預約紀錄查詢', array('controller' => 'equipments', 'action' => 'equip_booking_table')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('安定性樣品', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('樣品列表', array('controller' => 'safetytrials', 'action' => 'index')); ?></li>
		</ul>
	</li>	
	<li><?php echo $this->html->link('教育訓練管理', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('文件列表', array('controller' => 'training', 'action' => 'document_list')); ?></li>
			<li><?php echo $this->html->link('教育訓練列表', array('controller' => 'training', 'action' => 'training_list')); ?></li>
		</ul>
	</li>
	<li><?php echo $this->html->link('登出', array('controller' => 'users', 'action' => 'logout')); ?>
</ul>
</div>