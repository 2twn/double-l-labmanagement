 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">儀器預約</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php if ((!isset($this->request->data['EquipBooking']['valid'])) || ($this->request->data['EquipBooking']['valid'] <> 0)): ?>
<?php echo $this->Form->create('EquipBooking', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td colspan=3>儀器編號：
				<?php 
					echo $this->Form->hidden('id');
					if ((!isset($this->request->data['EquipBooking']['equip_id'])) || ($this->request->data['EquipBooking']['equip_id'] == null)) {
						echo $this->Form->select('equip_id', $equips, array('empty'=>false));
					} else {
						echo $this->Form->select('equip_id', $equips, array('empty'=>false, 'disabled' => true));
						echo $this->Form->hidden('equip_id');
					}
				?>
			</td>
		</tr>			
		<tr>
			<td style="width:250px">
				預約日期：
				起&nbsp;<?php echo $this->Form->text('start_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>10, 'style'=>'width:150px'));?>
			</td>
			<td>
				迄&nbsp;<?php echo $this->Form->text('end_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>10, 'style'=>'width:150px'));?>	
			</td>
			<td></td>
		</tr>
		<tr>
			<td style="width:250px">預約時段：
				起&nbsp;<?php echo $this->Form->select('start_time', $start_periods, array('empty'=>false));?>
			</td>
			<td>
				迄&nbsp;<?php echo $this->Form->select('end_time', $end_periods, array('empty'=>false));?>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan=3>專案代號：<?php echo $this->Form->select('project_id', $projects, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td colspan=3>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td colspan=3><?php echo $this->Form->textarea('booking_desc');?></td>
		</tr>
		<tr>
			<td colspan=3><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>
<?php else: ?>
	<table><tr>	<td>無此預約資料</td></tr></table>
<?php endif; ?>
