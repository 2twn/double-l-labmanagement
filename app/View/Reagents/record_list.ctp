<div class="pageheader_div"><h1 id="pageheader">試藥登錄及查詢</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'record_edit'), array('class' => 'button')); ?>
<?php
    echo $this->Form->create('ReagentRecord', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
    echo "試藥或廠商";
    echo $this->Form->text('keyword',array('value'=>$keyword));
    echo $this->Form->submit('查詢', array('div'=>false));
?>
</div>
<table class="fixreport">
    <tr>
        <th class="text10">試藥編號</th>
        <th class="text20">試藥名稱</th>
        <th class="text10">儲存位置</th>
        <th class="text20">製造商</th>
        <th class="text20">包裝</th>
        <th class="text20">原廠批號</th>
        <th class="date">登錄日期</th>
        <th class="date">有效日期</th>
        <th class="date">開封日期</th>
        <th class="date">使用期限</th>
<!--         <th class="date">建立時間</th>   -->      
        <th width="command1"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['ReagentRecord']['id']; ?></td>
        <td><?php echo $item['ReagentRecord']['name']; ?></td>
        <td><?php echo $item['ReagentLocation']['name']; ?></td>
        <td><?php echo $item['Company']['name']; ?></td>
        <td><?php echo $item['ReagentRecord']['package']; ?></td>
        <td><?php echo $item['ReagentRecord']['lot']; ?></td>
        <td><?php echo $item['ReagentRecord']['record_date']; ?></td>
        <td><?php echo $item['ReagentRecord']['valid_date']; ?></td>
        <td><?php echo $item['ReagentRecord']['open_date']; ?></td>
        <td><?php echo $item['ReagentRecord']['usage']; ?></td>
<!--         <td><?php echo $item['ReagentRecord']['create_time']; ?></td>   -->      
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'record_edit', $item['ReagentRecord']['id']), array('class' => 'button'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="11">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
