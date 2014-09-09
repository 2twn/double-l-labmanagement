 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">儀器維護</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回儀器列表', array('controller'=>'equipments', 'action' =>'equip_list'), array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('Equip', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>儀器編號：
				<?php 
					echo $this->Form->hidden('id');
					echo $this->Form->text('equip_code', array('maxlength'=>8,'size'=>8));
				?>
				(最多8碼英文字母或數字)
			</td>
		</tr>			
		<tr>
			<td>儀器名稱：<?php echo $this->Form->input('equip_name', array('maxlength'=>40,'size'=>40));?>(最多40碼英文字母或數字)</td>
		</tr>
		<tr>
			<td>下次校正日期：<?php echo $this->Form->text('maintain_time', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td>位置說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->text('location', array('maxlength'=>30,'size'=>30));?></td>
		</tr>
		<tr>
			<td>使用狀態：<?php echo $this->Form->select('status', $equip_status, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->text('equip_desc', array('maxlength'=>30,'size'=>30));?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>