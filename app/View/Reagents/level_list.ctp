<div class="pageheader_div"><h1 id="pageheader">等級管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>

<table>
    <tr>
        <th>等級</th>
        <th>說明</th>
        <th>有效</th>
        <th>建立時間</th>        
        <th><?php echo $this->Html->link('新增', array('action' => 'level_edit'), array('class' => 'button')); ?></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['ReagentLevel']['id']; ?></td>
        <td><?php echo $item['ReagentLevel']['memo']; ?></td>
        <td><?php echo $status[$item['ReagentLevel']['status']]; ?></td>
        <td><?php echo $item['ReagentLevel']['create_time']; ?></td>        
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'level_edit', $item['ReagentLevel']['id']), array('class' => 'button'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="7">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
