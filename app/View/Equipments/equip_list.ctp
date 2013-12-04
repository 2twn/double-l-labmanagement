<div class="pageheader_div"><h1 id="pageheader">儀器列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>

<table>
    <tr>
        <th>儀器代號</th>
        <th>儀器名稱</th>
		<th>下次校正日期</th>
		<th>位置說明</th>
        <th>建立時間</th>
        <th>使用狀態</th>
        <th><?php echo $this->Html->link('新增儀器', array('action' => 'equip_edit'), array('class' => 'button')); ?></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Equipment']['id']; ?></td>
        <td>
            <?php echo $item['Equipment']['equip_name']; ?>
        </td>
        <td>
            <?php echo $item['Equipment']['maintain_time']; ?>
        </td>
        <td>
            <?php echo $item['Equipment']['location']; ?>
        </td>
        <td>
            <?php echo $item['Equipment']['create_time']; ?>
        </td>
        <td>
            <?php echo $equip_status[$item['Equipment']['status']]; ?>
        </td>
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'equip_edit', $item['Equipment']['id']), array('class' => 'button'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
