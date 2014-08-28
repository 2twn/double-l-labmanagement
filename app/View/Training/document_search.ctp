<table>
<tr>
	<th class="command1">選擇</th><th class="text40">文件名稱</th>
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
<tr>
	<td colspan="2" id="select_page_doc">
	<?php for($i =1; $i<=$item_cnt;$i++): ?>
		<?php if ($page == $i)  { echo $page; }
		      else { echo $this->Html->link($i, 'javascript:void(0);',array('onclick'=>'search_document('.$i.');'));}
		 ?>
	<?php endfor;?>
	</td>
</tr>
</table>
