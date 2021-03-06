<div class="pageheader_div"><h1 id="pageheader">人員資料列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增人員', array('action' => 'user_edit'), array('class' => 'button')); ?>
</div>
<table  class="fixreport">
    <tr>
        <th class="text10">員工編號</th>
        <th class="text15">人員姓名</th>
        <th class="text20">登入名稱</th>
        <th class="text30">電子郵件</th>
        <th class="text15">部門</th>
        <th class="text15">群組</th>
        <th class="state1">有效</th>
        <th class="timestamp">建立時間</th>
        <th class="command3"></th>
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
            <?php 
            	foreach ($item['UserRole'] as $role) {
            		echo $roles[$role['role_id']].'<br>';
            	}
            ?>
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
