<div id="cakephp-global-navigation">
<ul id="menu">


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
</ul>
</div>