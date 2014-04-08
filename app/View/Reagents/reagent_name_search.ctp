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
	    <td >
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>