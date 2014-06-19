<div class="pageheader_div"><h1 id="pageheader">等級管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'level_edit'), array('class' => 'button')); ?>
</div>
<table class="fixreport">
    <tr>
        <th class="text20">等級</th>
        <th>說明</th>
        <th class="state">有效</th>
        <th class="timestamp">建立時間</th>        
        <th class="command2"></th>
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
