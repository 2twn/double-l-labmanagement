<div class="pageheader_div"><h1 id="pageheader">儀器預約列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增預約', array('action' => 'equip_booking_action'), array('class' => 'button')); ?>
</div>
<table>
    <tr>
        <th class="text10">預約代號</th>
        <th class="text10">儀器代號</th>
        <th class="text20">儀器名稱</th>
        <th class="text10">專案代碼</th>
        <th class="text10">預約人員</th>
        <th>說明</th>
        <th class="timestamp2">開始時間</th>
		<th class="timestamp2">結束時間</th>
        <th class="timestamp2">建立時間</th>
        <th class="command2"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['EquipBooking']['id']; ?></td>
        <td>
            <?php echo $item['Equip']['equip_code']; ?>
        </td>
        <td>
            <?php echo $item['Equip']['equip_name']; ?>
        </td>
        <td>
            <?php echo $item['Project']['prj_code']; ?>
        </td>
        <td>
            <?php echo $item['User']['name']; ?>
        </td>
        <td width="300px">
            <?php echo $item['EquipBooking']['booking_desc']; ?>
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
				echo $this->Form->postLink(
						'刪除',
						array('action' => 'equip_booking_delete', $item['EquipBooking']['id']),
						array('class'=>'button','confirm' => '確認刪除?'));
				?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="9">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
