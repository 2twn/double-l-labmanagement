<div class="pageheader_div"><h1 id="pageheader">文件維護</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', array('controller'=>'training', 'action' =>'document_list'), array('class' => 'button')); 
?></div>
<?php echo $this->Form->create('TrainingDocument', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<table>
		<tr>
			<td>文件編號：
				<?php 
					if($this->request->data['TrainingDocument']['id'] == null)
						echo $this->Form->text('id', array('style'=>'width:150px'));
					else
						echo $this->Form->text('id', array('readonly'=>true, 'style'=>'width:150px'));
				?>
			</td>
		</tr>			
		<tr>
			<td>文件名稱：<?php echo $this->Form->input('document_name', array('style'=>'width:150px'));?></td>
		</tr>
		<tr>
			<td>文件版本：<?php echo $this->Form->text('document_version', array('style'=>'width:50px'));?></td>
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