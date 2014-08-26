<div class="pageheader_div"><h1 id="pageheader">試藥資訊管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'reagent_edit'), array('class' => 'button')); ?>
<?php
    echo $this->Form->create('Reagent', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
    echo "代號或名稱";
    echo $this->Form->text('keyword');
    echo $this->Form->submit('查詢', array('div'=>false));
?>
</div>
<table class="fixreport">
    <tr>
        <th class="text20">試藥代號</th>
        <th class="text50">試藥名稱</th>
        <th class="text30">化學名稱</th>
        <th class="text5">等級</th>
        <th class="text40">說明</th>
        <th class="state">有效</th>
        <th class="timestamp">建立時間</th>        
        <th class="command"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Reagent']['id']; ?></td>
        <td><?php echo $item['Reagent']['name']; ?></td>
        <td><?php echo $item['Chemical']['name']; ?></td>
        <td><?php echo $item['Reagent']['reagent_level_id']; ?></td>
        <td><?php echo $item['Reagent']['memo']; ?></td>
        <td><?php echo $status[$item['Reagent']['status']]; ?></td>
        <td><?php echo $item['Reagent']['create_time']; ?></td>        
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'reagent_edit', $item['Reagent']['id']), array('class' => 'button'));
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
