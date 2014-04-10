<table>
<tr>
	<th>選擇</th><th>人員</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
	<td>
	<?php echo $this->Form->checkbox('user_id_'.$item["User"]["id"], array('value'=>$item["User"]["id"],'class'=>'users_select') );?>
	<?php echo $this->Form->hidden('user_name_'.$item["User"]["id"], array('value'=>$item["User"]["name"],'class'=>'users_select_name') );?>
	</td>
	<td>
	<?php echo $item["User"]["name"];?>
	</td>
</tr>
<?php endforeach;?>
</table>