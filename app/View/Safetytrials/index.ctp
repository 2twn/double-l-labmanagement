<div class="pageheader_div"><h1 id="pageheader">安定性樣品列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
    echo $this->Form->create('SafetyTrial',array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false)));
    echo $this->Form->select('status', $trial_status, array('empty'=>false));
    echo $this->Form->submit('查詢',array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false)));
    echo $this->Form->end(); 
?></div>

<table>
    <tr>
        <th>樣品批號</th>
        <th>樣品名稱</th>
        <th>所屬專案</th>
        <th>狀態</th>
        <th>樣品時間</th>
        <th>儲存位置</th>
        <th>建立時間</th>
        <th><?php echo $this->Html->link('新增', array('action' => 'edit'), array('class' => 'button')); ?></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['SafetyTrial']['trial_lot']; ?></td>
        <td>
            <?php echo $item['SafetyTrial']['trial_name']; ?>
        </td>
        <td>
            <?php echo $item['Project']['prj_name'];  ?>
        </td>
        <td>
            <?php echo $trial_status[$item['SafetyTrial']['status']];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['start_date'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['location'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['create_time'];  ?>
        </td>        
        <td>
            <?php echo $this->Html->link('修改', array('action' => 'edit', $item['SafetyTrial']['id']), array('class' => 'button'));?>    
        </td>
    </tr>
    <?php endforeach; ?>
</table>
