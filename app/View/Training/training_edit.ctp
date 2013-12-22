 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">教育訓練維護</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('Training', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>文件編號：</td>
		</tr>	
		<tr>
			<td>上課日期：<?php echo $this->Form->text('start_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td>開始時間：<?php echo $this->Form->text('b_start_time', array('size'=>8, 'style'=>'width:150px'));?>
			    結束時間：<?php echo $this->Form->text('b_end_time', array('size'=>8, 'style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td>會議室：<?php echo $this->Form->select('meeting_room_id', $meeting_rooms, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td>授課人員：</td>
		</tr>	
		<tr>
			<td>上課人員：<?php echo $this->Form->input('instructor', array('style'=>'width:150px'));?></td>
		</tr>	
		<tr>
			<td>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->text('training_desc', array('style'=>'width:450px'));?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>