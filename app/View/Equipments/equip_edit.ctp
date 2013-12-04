 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">儀器維護</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('Equipment', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>儀器名稱：<?php echo $this->Form->input('equip_name', array('size'=>30, 'style'=>'width:150px'));?>(最多30碼英文字母或數字)</td>
		</tr>
		<tr>
			<td>儀器編號：
				<?php 
					if($this->request->data['Equipment']['id'] == null)
						echo $this->Form->text('id', array('size'=>8, 'style'=>'width:150px'));
					else
						echo $this->Form->text('id', array('readonly'=>true, 'size'=>8, 'style'=>'width:150px'));
				?>
				(最多8碼英文字母或數字)
			</td>
		</tr>			
		<tr>
			<td>下次校正日期：<?php echo $this->Form->text('maintain_time', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td>位置說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->textarea('location');?></td>
		</tr>
		<tr>
			<td>使用狀態：<?php echo $this->Form->select('status', $equip_status, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->textarea('equip_desc');?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>