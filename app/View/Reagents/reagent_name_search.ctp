<table>
<tr>
	<th>試藥名稱</th>
</tr>
<?php foreach ($items as $item): ?>
<tr  name='reagent_item' value='<?php echo $item["Reagent"]["name"]?>'>
	<td>
	<?php echo $item["Reagent"]["name"];?>
	</td>
</tr>
<?php endforeach;?>
<tr>
	<td id="select_page_reagent">
	<?php for($i =1; $i<=$item_cnt;$i++): ?>
		<?php if ($page == $i)  { echo $page; }
		      else { echo $this->Html->link($i, 'javascript:void(0);',array('onclick'=>'search_reagent_name('.$i.');'));}
		 ?>
	<?php endfor;?>
	</td>
</tr>
</table>