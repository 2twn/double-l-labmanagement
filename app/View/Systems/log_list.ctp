<div class="pageheader_div"><h1 id="pageheader">專案資料列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
</div>
<table class="fixreport">
    <tr>
        <th class="command3">建立時間</th>
        <th class="text20">類別</th>
        <th class="text50">事件</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <?php echo $item['SystemLog']['create_time']; ?>
        </td>
    <td><?php echo $item['SystemLog']['type']; ?></td>
        <td>
            <?php echo $item['SystemLog']['log']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="5">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
