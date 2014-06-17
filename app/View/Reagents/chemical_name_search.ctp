<table>
<?php foreach ($items as $item): ?>
<tr name='chemical_item' chemical_name='<?php echo $item["Chemical"]["name"]?>' chemical_id='<?php echo $item["Chemical"]["id"]?>'>
	<td>
	<?php echo $item["Chemical"]["name"];?>
	</td>
</tr>
<?php endforeach;?>
<!-- 	<tr>
	    <td >
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
 --></table>