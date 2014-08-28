<table>
<tr>
	<th class="command1">選擇</th><th class="text40">人員</th>
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
<tr>
	<td colspan="2" id="select_page_user">
	<?php for($i =1; $i<=$item_cnt;$i++): ?>
		<?php if ($page == $i)  { echo $page; }
		      else { echo $this->Html->link($i, 'javascript:void(0);',array('onclick'=>'search_user('.$i.');'));}
		 ?>
	<?php endfor;?>
	</td>
</tr>
</table>
