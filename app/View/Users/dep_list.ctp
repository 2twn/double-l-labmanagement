<div class="pageheader_div"><h1 id="pageheader">部門資料列表</h1></div>
<div class="pagemenu_div">
<?php echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button'));?><br/>
</div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增部門', array('action' => 'dep_edit'), array('class' => 'button')); ?>
</div>
<table>
    <tr>
        <th>部門代號</th>
        <th>部門名稱</th>
        <th>有效</th>
        <th>建立時間</th>
        <th></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Department']['dep_code']; ?></td>
        <td>
            <?php echo $item['Department']['dep_name']; ?>
        </td>
        <td>
            <?php if ($item['Department']['valid']) { echo 'Y'; } else {echo 'N';}; ?>
        </td>
        <td>
            <?php echo $item['Department']['create_time']; ?>
        </td>
        <td>
            <?php 
				$delbtn = '生效';
				if ($item['Department']['valid']) {
					echo $this->Html->link('修改', array('action' => 'dep_edit', $item['Department']['id']), array('class' => 'button'));
					$delbtn = '失效';
					echo '&nbsp';
				}
				echo $this->Form->postLink(
				$delbtn,
				array('action' => 'dep_del', $item['Department']['id']),
				array('class'=>'button','confirm' => '確認變更?'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
