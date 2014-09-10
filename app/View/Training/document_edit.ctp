<div class="pageheader_div"><h1 id="pageheader">文件維護</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', array('controller'=>'training', 'action' =>'document_list'), array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('TrainingDocument', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>文件編號：
				<?php 
					echo $this->Form->hidden('id');
					echo $this->Form->text('doc_code', array('maxlength'=>16,'size'=>15));
				?>
			</td>
		</tr>			
		<tr>
			<td>文件名稱：<?php echo $this->Form->input('document_name', array('maxlength'=>60,'size'=>61));?></td>
		</tr>
		<tr>
			<td>文件版本：<?php echo $this->Form->text('document_version', array('maxlength'=>3,'size'=>3));?></td>
		</tr>
		<tr>
			<td>說明：(最多30個中文字)</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->text('document_desc', array('style'=>'width:450px'));?></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>