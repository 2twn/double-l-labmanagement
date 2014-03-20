 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<style>
.input_label {
	width: 120px;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">試藥登錄</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('ReagentRecord', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 

?>
	<table>
		<tr>
			<td class="input_label">試藥編號</td>
			<td><?php echo $this->Form->text('id', array('readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td class="input_label">試藥名稱</td><td><?php echo $this->Form->input('name');?></td>
		</tr>		
		<tr>
			<td class="input_label">儲存位置</td><td><?php echo $this->Form->select('reagent_location_id', $locations, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td class="input_label">製造商</td><td><?php echo $this->Form->select('company_id', $companys, array('empty'=>false));?></td>
		</tr>	
		<tr>
			<td class="input_label">包裝</td><td><?php echo $this->Form->input('package');?></td>
		</tr>	
		<tr>
			<td class="input_label">原廠批號</td><td><?php echo $this->Form->input('lot');?></td>
		</tr>
		<tr>
			<td class="input_label">登錄日期</td>
			<td><?php echo $this->Form->text('record_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>		
		<tr>
			<td class="input_label">有效日期</td>
			<td><?php echo $this->Form->text('valid_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>	
		<tr>
			<td class="input_label">開封日期</td>
			<td><?php echo $this->Form->text('open_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>					
		<tr>
			<td class="input_label">使用期限</td><td><?php echo $this->Form->text('usage', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
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