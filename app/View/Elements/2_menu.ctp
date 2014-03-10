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

</ul>
</div>