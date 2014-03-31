<div id="cakephp-global-navigation">
<ul id="menu">
<?php 
	$menus = $this->Session->check('menus')?$this->Session->read('menus'):array();
	foreach($menus as $catalog => $items):
?>
	<li><?php echo $this->html->link($catalog, '#'); ?>
		<ul class="second-level">
			<?php foreach($items as $item): ?>
			<li><?php echo $this->html->link($item['name'], array('controller' => $item['control'], 'action' => $item['action'])); ?></li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>
</ul>
</div>