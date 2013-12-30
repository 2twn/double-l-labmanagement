<div class="pageheader_div"><h1 id="pageheader">儀器預約列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>

<table>
    <tr>
        <th>預約代號</th>
        <th>儀器名稱</th>
        <th>儀器位置</th>
        <th>專案名稱</th>
		<th>開始時間</th>
		<th>結束時間</th>
        <th>建立時間</th>
        <th><?php echo $this->Html->link('新增預約', array('action' => 'equip_booking_action'), array('class' => 'button')); ?></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['EquipBooking']['id']; ?></td>
        <td>
            <?php echo $item['Equip']['equip_name']; ?>
        </td>
        <td>
            <?php echo $item['Equip']['location']; ?>
        </td>
        <td>
            <?php echo $item['Project']['prj_name']; ?>
        </td>
        <td>
            <?php echo $item['EquipBooking']['book_start_time']; ?>
        </td>
        <td>
            <?php echo $item['EquipBooking']['book_end_time']; ?>
        </td>
        <td>
            <?php echo $item['EquipBooking']['create_time']; ?>
        </td>
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'equip_booking_action', $item['EquipBooking']['id']), array('class' => 'button'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="8">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
