<div class="pageheader_div"><h1 id="pageheader">維護專案資料</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('Project', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>專案代碼(不可變更)</td>
			<td>
				<?php 
					if($this->request->data['Project']['id'] == null) {
						echo $this->Form->input('prj_code', array('type'=>'text'));
					}
					else {
						echo $this->Form->hidden('id');
						echo $this->Form->input('prj_code', array('type'=>'text','readonly'=>true));
					}
				?>
			</td>
		</tr>	
		<tr>
			<td>專案名稱</td><td><?php echo $this->Form->input('prj_name');?></td>
		</tr>
		<tr>
			<td>專案簡述</td><td><?php echo $this->Form->text('prj_desc');?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>