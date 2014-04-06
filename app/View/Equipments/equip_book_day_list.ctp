<h2>儀器預約列表（<?php echo $sel_date;?>）</h2>
<table>
    <tr>
        <th>預約代號</th>
        <th>儀器名稱</th>
        <th>儀器位置</th>
        <th>專案名稱</th>
		<th>開始時間</th>
		<th>結束時間</th>
        <th>建立時間</th>
    </tr>
    <?php if (empty($items)):?>
    <tr>
        <td colspan=8>無預約紀錄</td>
    </tr>
    <?php else:?>
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
    </tr>
    <?php endforeach; ?>
    <?php endif;?>
</table>