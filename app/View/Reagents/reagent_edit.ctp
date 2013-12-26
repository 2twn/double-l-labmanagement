<style>
.input_label {
	width: 120px;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">試藥資訊管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('Reagent', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 

?>
	<table>
		<tr>
			<td class="input_label">試藥代號</td>
			<td><?php 
				if($this->request->data['Reagent']['id'] == null)
					echo $this->Form->text('id', array('size'=>8, 'style'=>'width:150px'));
				else
					echo $this->Form->text('id', array('readonly'=>true, 'size'=>8, 'style'=>'width:150px'));
			?></td>
		</tr>
		<tr>
			<td class="input_label">試藥名稱</td><td><?php echo $this->Form->input('name');?></td>
		</tr>		
		<tr>
			<td class="input_label">化學名稱</td><td><?php echo $this->Form->select('chemical_id', $chemicals, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td class="input_label">等級</td><td><?php echo $this->Form->select('reagent_level_id', $reagent_levels, array('empty'=>false));?></td>
		</tr>	
		<tr>
			<td class="input_label">狀態</td><td><?php echo $this->Form->select('status', $status, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td class="input_label">說明：<br>(最多30個中文字)</td>
			<td><?php echo $this->Form->textarea('memo',array('cols'=>'30','rows'=>'3'));?></td>
		</tr>									
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>		