 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
	
	function add_document() {
		$sel_val = $("#TrainingDocs")[0].selectedIndex;
		$("#docs_tbl")[0].innerHTML = $("#docs_tbl")[0].innerHTML + "<tr><tr>"+$("#TrainingDocs")[0][$sel_val].text+"<input type=\"hidden\" name=\"data[Training][docs_id][]\" value=\""+$("#TrainingDocs")[0][$sel_val].value+"\" id=\"TrainingDocsId\"/></td></tr>"
	}
	
	function add_member() {
		$sel_val = $("#TrainingUsers")[0].selectedIndex;
		$("#users_tbl")[0].innerHTML = $("#users_tbl")[0].innerHTML + "<tr><tr>"+$("#TrainingUsers")[0][$sel_val].text+"<input type=\"hidden\" name=\"data[Training][users_id][]\" value=\""+$("#TrainingUsers")[0][$sel_val].value+"\" id=\"TrainingDocsId\"/></td></tr>"	
	}
</script>
<div class="pageheader_div"><h1 id="pageheader">教育訓練維護</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('Training', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>
			文件編號：<?php echo $this->Form->select('docs', $documents, array('empty'=>false));?><?php echo $this->Html->link('新增文件', 'javascript:add_document()',array('onclick'=>''));?>
			<table style="padding:0px;margin:0px" border=0 id="docs_tbl"></table>
			</td>
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
			<td>
			上課人員：<?php echo $this->Form->select('users', $users, array('empty'=>false));?><?php echo $this->Html->link('新增人員', 'javascript:add_member()',array('onclick'=>''));?>
			<table style="padding:0px;margin:0px" border=0 id="users_tbl"></table>
			</td>
		</tr>	
		<tr>
			<td>授課人員：<?php echo $this->Form->input('instructor', array('style'=>'width:150px'));?></td>
		</tr>	
		<tr>
			<td>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->text('training_desc', array('style'=>'width:450px'));?></td>
		</tr>
		<tr>
			<td colspan=2>
				<?php echo $this->Form->hidden('id');?>
				<?php echo $this->Form->submit('儲存');?>
			</td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>