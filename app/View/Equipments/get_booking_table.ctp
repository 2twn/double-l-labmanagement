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
	<tr><th class="weekend">日</th><th>一</th><th>二</td><th>三</th><th>四</th><th>五</th><th class="weekend">六</th></tr>
	<?php foreach($week_table as $line): ?>
		<tr class="book_cell">
		<?php $week_day = 0;?>
		<?php foreach($line as $book_date => $book_info): ?>
			<td class="<?php echo $book_info['class']." "; ?><?php if (($week_day%7 == 0) || ($week_day%7 == 6)) { echo 'weekend '; } ?>">
				<table border=0>
					<tr><td><?php echo $book_date;?></td><tr>
					<?php foreach($book_info['booking'] as $booking): ?>
						<tr>
							<td title="<?php echo "專案代碼：".$booking['Project']['prj_code']."<br/>說明：".$booking['EquipBooking']['booking_desc'];?>">
								<a href="equip_booking_action/<?php echo $booking['EquipBooking']['id']; ?>"><?php echo substr($booking['EquipBooking']['book_start_time'],11,5)."-"
								          .substr($booking['EquipBooking']['book_end_time'],11,5);?></a>
							</td>
						<tr>
					<?php endforeach;?>
				</table>
			</td>
		<?php $week_day++;?>
		<?php endforeach;?>
		</tr>
	<?php endforeach;?>
</table>