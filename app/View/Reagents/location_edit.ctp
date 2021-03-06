<style>
.input_label {
	width: 120px;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">試藥儲存位置管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('ReagentLocation', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
	echo $this->Form->hidden('id');
?>
	<table>
		<tr>
			<td class="input_label">試藥儲存位置</td><td><?php echo $this->Form->input('name',array('maxlength'=>20,'size'=>21));?></td>
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