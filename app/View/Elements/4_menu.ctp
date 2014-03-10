<div id="cakephp-global-navigation">
<ul id="menu">


	<li><?php echo $this->html->link('教育訓練管理', '#'); ?>
		<ul class="second-level">
			<li><?php echo $this->html->link('文件列表', array('controller' => 'training', 'action' => 'document_list')); ?></li>
			<li><?php echo $this->html->link('教育訓練列表', array('controller' => 'training', 'action' => 'training_list')); ?></li>
		</ul>
	</li>

</ul>
</div>