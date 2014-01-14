<div id="cakephp-global-navigation">
<ul id="menu">

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
	<li><?php echo $this->html->link('試藥管理', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('製造商資訊管理', array('controller' => 'reagents', 'action' => 'company_list')); ?></li>
			<li><?php echo $this->html->link('化學名稱管理', array('controller' => 'reagents', 'action' => 'chemical_list')); ?></li>
			<li><?php echo $this->html->link('等級管理', array('controller' => 'reagents', 'action' => 'level_list')); ?></li>
			<li><?php echo $this->html->link('試藥資訊管理', array('controller' => 'reagents', 'action' => 'reagent_list')); ?></li>
			<li><?php echo $this->html->link('試藥儲存位置管理', array('controller' => 'reagents', 'action' => 'location_list')); ?></li>
			<li><?php echo $this->html->link('試藥登錄', array('controller' => 'reagents', 'action' => 'record_list')); ?></li>
		</ul>
	</li>	
	<li><?php echo $this->html->link('登出', array('controller' => 'users', 'action' => 'logout')); ?>
</ul>
</div>