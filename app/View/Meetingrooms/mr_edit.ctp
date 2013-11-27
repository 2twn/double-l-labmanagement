<div class="pageheader_div"><h1 id="pageheader">維護會議室資料</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('MeetingRoom', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>會議室代碼(不可變更)</td>
			<td>
				<?php 
					echo $this->Form->input('id', array('type'=>'text','readonly'=>true));
				?>
			</td>
		</tr>	
		<tr>
			<td>會議室名稱</td><td><?php echo $this->Form->input('mr_name');?></td>
		</tr>
		<tr>
			<td>會議室簡述</td><td><?php echo $this->Form->text('mr_desc');?></td>
		</tr>
		<tr>
			<td>容納人數</td><td><?php echo $this->Form->text('mr_capacity');?>人</td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>