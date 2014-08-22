<style>
.input_label {
	width: 120px;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">角色管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('Role', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
	echo $this->Form->hidden('id');
?>
	<table>
		<tr>
			<td class="input_label">名稱</td><td><?php echo $this->Form->input('name',array('maxlength'=>20,'size'=>21));?></td>
		</tr>						
		<tr>
			<td class="input_label">選單</td>
			<td>
				<!-- Menu Maintain Zone-->
				<table>
					<tr>
						<td></td>
						<td>目錄</td>
						<td>選項</td>
					<tr>
				<?php foreach( $menus as $menu): ?>
					<tr>
						<td><?php echo $this->Form->input('RoleMenus.'.$menu['Menu']['id'], 
						array('type'=>'checkbox','hiddenField'=>false, 'value'=>$menu['Menu']['id'], 'class'=>'checkmode')
						);?></td>
						<td><?php echo $menu['Menu']['catalog'];?></td>
						<td><?php echo $menu['Menu']['name'];?></td>
					</tr>
				<?php endforeach; ?>
				</table>
			</td>
		</tr>				
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存',array('div'=>false));?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>		