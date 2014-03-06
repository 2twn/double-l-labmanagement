<div class="pageheader_div"><h1 id="pageheader">人員資料列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>

<table>
    <tr>
        <th>員工編號</th>
        <th>人員姓名</th>
        <th>登入名稱</th>
        <th>電子郵件</th>
        <th>部門</th>
        <th>群組</th>
        <th>有效</th>
        <th>建立時間</th>
        <th><?php echo $this->Html->link('新增人員', array('action' => 'user_edit'), array('class' => 'button')); ?></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['User']['employee_id']; ?></td>
        <td>
            <?php echo $item['User']['name']; ?>
        </td>
        <td>
            <?php echo $item['User']['username']; ?>
        </td>
        <td>
            <?php echo $item['User']['email']; ?>
        </td>
        <td>    
            <?php echo $item['Department']['dep_name']; ?>
        </td>
        <td>
            <?php echo $groups[$item['User']['group_id']]; ?>
        </td>        
        <td>
            <?php if ($item['User']['valid']) { echo 'Y'; } else {echo 'N';}; ?>
        </td>
        <td>
            <?php echo $item['User']['create_time']; ?>
        </td>
        <td>
            <?php 
				$delbtn = '生效';
				if ($item['User']['valid']) {
					echo $this->Html->link('修改', array('action' => 'user_edit', $item['User']['id']), array('class' => 'button'));
					$delbtn = '失效';
					echo '&nbsp';
				}
				echo $this->Form->postLink(
				$delbtn,
				array('action' => 'user_del', $item['User']['id']),
				array('class'=>'button','confirm' => '確認變更?'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
