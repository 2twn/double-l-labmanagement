<div class="pageheader_div"><h1 id="pageheader">維護人員資料</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('User', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
	echo $this->Form->hidden('id');
?>
	<table>
		<tr>
			<td>員工編號</td>
			<td>
				<?php 
					echo $this->Form->input('employee_id', array('type'=>'text'));
				?>
			</td>
		</tr>	
		<tr>
			<td>人員名稱</td><td><?php echo $this->Form->input('name');?></td>
		</tr>
		<tr>
			<td>部門</td><td><?php echo $this->Form->select('department_id', $departments, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td>人員帳號</td><td><?php echo $this->Form->input('username');?></td>
		</tr>
		<tr>
			<td>電子郵件</td><td><?php echo $this->Form->input('email');?></td>
		</tr>
		<tr>
			<td>群組</td><td><?php echo $this->Form->select('group_id', $groups, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>