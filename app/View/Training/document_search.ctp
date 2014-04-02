<table>
<tr>
	<th>選擇</th><th>文件名稱</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
	<td>
	<?php echo $this->Form->checkbox('doc_id_'.$item["TrainingDocument"]["id"], array('value'=>$item["TrainingDocument"]["id"],'class'=>'docs_select') );?>
	<?php echo $this->Form->hidden('doc_name_'.$item["TrainingDocument"]["id"], array('value'=>$item["TrainingDocument"]["document_name"],'class'=>'docs_select_name') );?>
	</td>
	<td>
	<?php echo $item["TrainingDocument"]["document_name"];?>
	</td>
</tr>
<?php endforeach;?>
</table>