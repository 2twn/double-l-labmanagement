<style>
.input_label {
	width: 120px;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">化學名稱管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('Chemical', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 

?>
	<table>
		<tr>
			<td class="input_label">代號</td>
			<td><?php 
				if($this->request->data['Chemical']['id'] == null)
					echo $this->Form->text('id', array('size'=>8, 'style'=>'width:150px'));
				else
					echo $this->Form->text('id', array('readonly'=>true, 'size'=>8, 'style'=>'width:150px'));
			?></td>
		</tr>
		<tr>
			<td class="input_label">名稱</td><td><?php echo $this->Form->input('name');?></td>
		</tr>		
		<tr>
			<td class="input_label">CAS#</td><td><?php echo $this->Form->input('cas');?></td>
		</tr>
		<tr>
			<td class="input_label">別名一</td><td><?php echo $this->Form->input('alias_name1');?></td>
		</tr>	
		<tr>
			<td class="input_label">別名二</td><td><?php echo $this->Form->input('alias_name2');?></td>
		</tr>	

		<tr>
			<td class="input_label">狀態</td><td><?php echo $this->Form->select('status', $status, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td class="input_label">說明：(最多30個中文字)</td>
			<td><?php echo $this->Form->textarea('memo',array('cols'=>'30','rows'=>'3'));?></td>
		</tr>									
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>		