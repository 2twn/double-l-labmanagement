<style TYPE="text/css">
.book_cell {
	min-height:100px; 
	height:120px;
}

.weekend {
	background-color: pink;
}

.pre {
	background-color: #E0E0E0;
}

.future {
	background-color: #E0E0E0;
}
</style>
<table border=1>
	<tr>
		<th>時間</th>
		<?php foreach($equips as $equip):?>
			<th><?php echo $equip;?></th>
		<?php endforeach; ?>
	</tr>
	<?php for($i=0; $i<sizeof($start_periods);$i++): ?>
	<tr class="book_cell">
		<td><?php echo $start_periods[$i]."~".$end_periods[$i];?></td>
		<?php foreach($equips as $key=>$equip):?>
			<?php if(isset($items[$key][$start_periods[$i]])):?>
				<td class="weekend"><?php echo $key;?></td>
			<?php else:?>
				<td><?php echo $start_periods[$i];?></td>
			<?php endif;?>
		<?php endforeach; ?>
	</tr>
	<?php endfor;?>
</table>