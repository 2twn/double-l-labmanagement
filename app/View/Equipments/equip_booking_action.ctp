 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">儀器預約</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('Equip_Booking', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>儀器編號：
				<?php 
					if($this->request->data['Equip_Booking']['equipment_id'] == null)
						echo $this->Form->select('equip_id', $equips, array('empty'=>false));
					else
						echo $this->Form->text('equip_id', array('readonly'=>true, 'size'=>8, 'style'=>'width:150px'));
				?>
			</td>
		</tr>			
		<tr>
			<td>預約日期：<?php echo $this->Form->text('start_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td>預約時段：
				<?php echo $this->Form->select('start_time', $start_periods, array('empty'=>false));?>
				<?php echo $this->Form->select('end_time', $end_periods, array('empty'=>false));?>
			</td>
		</tr>
		<tr>
			<td>專案名稱：<?php echo $this->Form->select('project_id', $projects, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->textarea('booking_desc');?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>